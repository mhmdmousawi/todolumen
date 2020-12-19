<?php

namespace App\Http\Controllers;

use App\DTOFactories\CategoryRequestDTOFactory;
use App\DTOFactories\CategoryResponseDTOFactory;
use App\Exceptions\UnableToRemoveCategoryException;
use App\Models\Category;
use App\Models\User;
use App\Services\CategoryCreator;
use App\Services\CategoryRemoveService;
use App\Services\CategoryUpdater;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    use ValidationTrait;

    /**
     * @var CategoryRequestDTOFactory
     */
    private $categoryRequestDTOFactory;

    /**
     * @var CategoryResponseDTOFactory
     */
    private $categoryResponseDTOFactory;

    /**
     * @var CategoryCreator
     */
    private $categoryCreator;

    /**
     * @var CategoryUpdater
     */
    private $categoryUpdater;

    /**
     * @var CategoryRemoveService
     */
    private $categoryRemoveService;

    /**
     * @var User
     */
    private $loggedInUser;

    public function __construct(
        CategoryRequestDTOFactory $categoryRequestDTOFactory,
        CategoryResponseDTOFactory $categoryResponseDTOFactory,
        CategoryCreator $categoryCreator,
        CategoryUpdater $categoryUpdater,
        CategoryRemoveService $categoryRemoveService
    ) {
        $this->categoryRequestDTOFactory = $categoryRequestDTOFactory;
        $this->categoryResponseDTOFactory = $categoryResponseDTOFactory;
        $this->categoryCreator = $categoryCreator;
        $this->categoryUpdater = $categoryUpdater;
        $this->categoryRemoveService = $categoryRemoveService;

        $this->loggedInUser = auth()->user();
    }

    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), Category::rules());

        if ($validator->fails()) {
            return $this->createValidationErrorView($validator->errors());
        }

        $categoryRequestDTO = $this->categoryRequestDTOFactory->create($request);

        $categoryResponseDTO = $this->categoryResponseDTOFactory->create(
            $this->categoryCreator->create(
                $this->loggedInUser, $categoryRequestDTO
            )
        );

        return $this->view($categoryResponseDTO, Response::HTTP_CREATED);
    }

    public function viewCategory(int $id): JsonResponse
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->createGenericErrorView("No Category with this id", Response::HTTP_BAD_REQUEST);
        }

        if ($category->user_id !== $this->loggedInUser->id) {
            return $this->createGenericErrorView(
                "Category does not belong to you",
                Response::HTTP_UNAUTHORIZED
            );
        }

        $categoryResponseDTO = $this->categoryResponseDTOFactory->create($category);

        return $this->view($categoryResponseDTO, Response::HTTP_OK);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->createGenericErrorView("No Category with this id", Response::HTTP_BAD_REQUEST);
        }

        if ($category->user_id !== $this->loggedInUser->id) {
            return $this->createGenericErrorView(
                "Category does not belong to you",
                Response::HTTP_UNAUTHORIZED
            );
        }

        $validator = Validator::make($request->all(), Category::rules());
        if ($validator->fails()) {
            return $this->createValidationErrorView($validator->errors());
        }

        $categoryRequestDTO = $this->categoryRequestDTOFactory->create($request);

        $categoryResponseDTO = $this->categoryResponseDTOFactory->create(
            $this->categoryUpdater->update($category, $categoryRequestDTO)
        );

        return $this->view($categoryResponseDTO, Response::HTTP_OK);
    }

    public function delete(int $id): JsonResponse
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->createGenericErrorView("No Category with this id", Response::HTTP_BAD_REQUEST);
        }

        if ($category->user_id !== $this->loggedInUser->id) {
            return $this->createGenericErrorView(
                "Category does not belong to you",
                Response::HTTP_UNAUTHORIZED
            );
        }

        try {
            $this->categoryRemoveService->remove($category);
        } catch (UnableToRemoveCategoryException $exception) {
            return $this->createGenericErrorView(
                "You cannot delete a category who has tasks attached to it",
                Response::HTTP_FORBIDDEN
            );
        }

        return $this->view(null, Response::HTTP_NO_CONTENT);
    }

    public function list(): JsonResponse
    {
        $categories = Category::query()
            ->where('user_id', $this->loggedInUser->id)
            ->get()
            ->all();

        return $this->view(
            $this->categoryResponseDTOFactory->createDTOs($categories)
            , Response::HTTP_OK
        );
    }
}
