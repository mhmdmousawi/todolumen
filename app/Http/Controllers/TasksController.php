<?php

namespace App\Http\Controllers;

use App\DTOFactories\TaskRequestDTOFactory;
use App\DTOFactories\TaskResponseDTOFactory;
use App\DTOFactories\TaskUpdateRequestDTOFactory;
use App\Http\Filters\TasksFilter;
use App\Models\Task;
use App\Models\User;
use App\Providers\TaskProvider;
use App\Services\TaskCreator;
use App\Services\TaskUpdater;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    use ValidationTrait;

    /**
     * @var TaskRequestDTOFactory
     */
    private $taskRequestDTOFactory;

    /**
     * @var TaskUpdateRequestDTOFactory
     */
    private $taskUpdateRequestDTOFactory;

    /**
     * @var TaskResponseDTOFactory
     */
    private $taskResponseDTOFactory;

    /**
     * @var TaskCreator
     */
    private $taskCreator;

    /**
     * @var TaskUpdater
     */
    private $taskUpdater;

    /**
     * @var TaskProvider
     */
    private $taskProvider;

    /**
     * @var User
     */
    private $loggedInUser;

    public function __construct(
        TaskRequestDTOFactory $taskRequestDTOFactory,
        TaskUpdateRequestDTOFactory $taskUpdateRequestDTOFactory,
        TaskResponseDTOFactory $taskResponseDTOFactory,
        TaskCreator $taskCreator,
        TaskUpdater $taskUpdater,
        TaskProvider $taskProvider
    ) {
        $this->taskRequestDTOFactory = $taskRequestDTOFactory;
        $this->taskUpdateRequestDTOFactory = $taskUpdateRequestDTOFactory;
        $this->taskResponseDTOFactory = $taskResponseDTOFactory;
        $this->taskCreator = $taskCreator;
        $this->taskUpdater = $taskUpdater;
        $this->taskProvider = $taskProvider;

        $this->loggedInUser = auth()->user();
    }

    public function create(Request $request): JsonResponse
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:65535',
            'category_id' => 'nullable|int|exists:category,id'
        ]);

        $taskRequestDTO = $this->taskRequestDTOFactory->create($request);

        $taskResponseDTO = $this->taskResponseDTOFactory->create(
            $this->taskCreator->create(
                $this->loggedInUser, $taskRequestDTO
            )
        );

        return $this->view($taskResponseDTO, Response::HTTP_CREATED);
    }

    public function viewTask(int $id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return $this->createGenericErrorView("No task with this id", Response::HTTP_BAD_REQUEST);
        }

        if ($task->user_id !== $this->loggedInUser->id) {
            return $this->createGenericErrorView(
                "Task does not belong to you",
                Response::HTTP_UNAUTHORIZED
            );
        }

        $taskResponseDTO = $this->taskResponseDTOFactory->create($task);

        return $this->view($taskResponseDTO, Response::HTTP_OK);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return $this->createGenericErrorView("No task with this id", Response::HTTP_BAD_REQUEST);
        }

        if ($task->user_id !== $this->loggedInUser->id) {
            return $this->createGenericErrorView(
                "Task does not belong to you",
                Response::HTTP_UNAUTHORIZED
            );
        }

        $validator = Validator::make($request->all(), Task::rules());
        if ($validator->fails()) {
            return $this->createValidationErrorView($validator->errors());
        }

        $taskRequestDTO = $this->taskUpdateRequestDTOFactory->update($request);

        $taskResponseDTO = $this->taskResponseDTOFactory->create(
            $this->taskUpdater->update($task, $taskRequestDTO)
        );

        return $this->view($taskResponseDTO, Response::HTTP_OK);
    }

    public function list(TasksFilter $filter): JsonResponse
    {
        return $this->view(
            $this->taskResponseDTOFactory->createDTOs(
                $this->taskProvider->provideByUserAndFilter($this->loggedInUser, $filter)
            )
            , Response::HTTP_OK
        );
    }
}
