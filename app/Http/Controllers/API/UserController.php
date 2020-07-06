<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function index()
    {
        return User::where('role_id', '2')->get();
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //the input field has name='username' in form
        $username = $request->username;

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            //user sent their email
            Auth::attempt(['email' => $username, 'password' => $request->password]);
        } else {
            //they sent their username instead
            Auth::attempt(['username' => $username, 'password' => $request->password]);
        }

        //was any of those correct ?
        if (Auth::check()) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyEshop')->accessToken;
            $success['user'] = Auth::user();
            return response()->json(['success' => $success], 200);
        } else {
            return response()->json(['error'=>'Wrong username/password combination.'], 401);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(UserStoreRequest $request)
    {
        $validated = $request->validated();


        $role_id = Role::where('name', 'user')->first()->id;

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role_id = $role_id;
        $user->save();

        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return response()->json(['success'=>$success], 200);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $dataValidated = $request->validated();
        $user = User::find($id);

        $user->name = $dataValidated['name'];
        $user->email = $dataValidated['email'];
        $user->username = $dataValidated['username'];
        if (isset($dataValidated['password'])) {
            $user->password = $dataValidated['password'];
        }

        $user->save();

        return response()->json(['success'=> $dataValidated], 200);
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        $role = User::find(Auth::user()->id);
        $user['role'] = Role::find($role->role_id)->name;
        return response()->json(['success' => $user], 200);
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json(['data' => $user], 200);
    }

    public function destroy($id)
    {
        if ($user = User::find($id)) {
            $user->delete();
            return response()->json('User deleted successfully', 200);
        }
        return response()->json('Product not found', 404);
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json('Logged out successfully', 200);
    }
}
