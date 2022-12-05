<?php


namespace App\Services;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User as User;
use App\Services\ApiService as ApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ApiAuthService extends ApiService
{
    private object $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }
    public function createUser(UserRegisterRequest $request) :JsonResponse
    {
        $newUserDetails = $request->all();
        $newUserDetails['password'] = Hash::make($newUserDetails['password']);
        $newUser = $this->model->create($newUserDetails);
        $newUser->createToken('my api token')->accessToken;
        $this->setJsonError(false);
        $this->setJsonData($newUser);
        $this->setJsonMessage(__('User created.'));

        return $this->returnJsonResponse();
    }

    public function loginUser(UserLoginRequest $request) :JsonResponse
    {
        if(!Auth::attempt($request->only(['email', 'password']))){
            $this->setJsonError(true);
            $this->setJsonStatus(401);
            $this->setJsonMessage('Credentials doesnt match.');
            $this->setJsonData(null);
            return $this->returnJsonResponse();
        }
        $user = $this->model->where('email', $request->email)->first();
        $token = $user->createToken('my api token')->plainTextToken;
        $this->setJsonData($token);
        $this->setJsonError(false);
        $this->setJsonMessage('Logged In.');
        return $this->returnJsonResponse();
    }
}
