<?php

namespace App\Http\Controllers;

use App\DTOFactories\User\UserRequestDTOFactory;
use App\DTOFactories\User\UserResponseDTOFactory;
use App\Models\User;
use App\Services\UserCreator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class JWTAuthController extends Controller
{
    use ValidationTrait;

    /**
     * @var UserCreator
     */
    private $userCreator;

    /**
     * @var UserResponseDTOFactory
     */
    private $userResponseDTOFactory;

    /**
     * @var UserRequestDTOFactory
     */
    private $userRequestDTOFactory;

    public function __construct(
        UserCreator $userCreator,
        UserResponseDTOFactory $userResponseDTOFactory,
        UserRequestDTOFactory $userRequestDTOFactory
    ) {
        $this->userCreator = $userCreator;
        $this->userResponseDTOFactory = $userResponseDTOFactory;
        $this->userRequestDTOFactory = $userRequestDTOFactory;
    }

    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), User::rules());
        if ($validator->fails()) {
            return $this->createValidationErrorView($validator->errors());
        }

        $userResponseDTO = $this->userResponseDTOFactory->create(
            $this->userCreator->create(
                $this->userRequestDTOFactory->create($request)
            )
        );

        return $this->view($userResponseDTO, Response::HTTP_CREATED);
    }

    public function login(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials, true)) {
            return $this->createGenericErrorView('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    public function logout(): JsonResponse
    {
        try {
            Auth::guard('api')->logout();
        } catch (Exception $e) {
            return $this->createGenericErrorView('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return $this->view(null, Response::HTTP_NO_CONTENT);
    }

    public function refresh()
    {
        try {
            $token = Auth::guard('api')->refresh();
        } catch (Exception $e) {
            return $this->createGenericErrorView('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    public function forgetPassword(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
        ]);

        Password::sendResetLink(['email' => $request->input('email')]);

        return $this->view(
            ['message' => "Email has successfully been sent, please check your inbox."],
            Response::HTTP_OK
        );
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users',
            'password' => 'required|confirmed',
            'token' => 'required|string'
        ]);

        $emailPasswordStatus = Password::reset(
            $request->only(['email', 'password', 'token']),
            function ($user, $password) {
                $user->password = app('hash')->make($password);
                $user->save();
        });

        if (Password::INVALID_TOKEN === $emailPasswordStatus) {
            return $this->createGenericErrorView('Invalid token!', Response::HTTP_UNAUTHORIZED);
        }

        return $this->view(
            ['message' => "Password successfully changed"],
            Response::HTTP_OK
        );
    }
}
