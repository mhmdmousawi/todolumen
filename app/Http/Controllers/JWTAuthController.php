<?php

namespace App\Http\Controllers;

use App\DTOFactories\User\Response\UserResponseDTOFactory;
use App\DTOs\User\Request\UserRequestDTO;
use App\Services\User\UserCreator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class JWTAuthController extends Controller
{
    /**
     * @var UserCreator
     */
    private $userCreator;

    /**
     * @var UserResponseDTOFactory
     */
    private $userResponseDTOFactory;

    public function __construct(UserCreator $userCreator, UserResponseDTOFactory $userResponseDTOFactory)
    {
        $this->userCreator = $userCreator;
        $this->userResponseDTOFactory = $userResponseDTOFactory;
    }

    public function register(Request $request): JsonResponse
    {
        // @TODO refactot to receive a DTO and validate it
        $this->validate($request, [
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'birthday' => 'int'
        ]);
        $userRequestDTO = UserRequestDTO::fromRequest($request);

        $userResponseDTO = $this->userResponseDTOFactory->create(
            $this->userCreator->create($userRequestDTO)
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

        if (!$token = Auth::attempt($credentials)) {
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

    public function refresh() {
        try {
            $token = Auth::guard('api')->refresh();
        } catch (Exception $e) {
            return $this->createGenericErrorView('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }
}
