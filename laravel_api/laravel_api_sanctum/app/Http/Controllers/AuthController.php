<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $employee = Employee::findOrFail($request['employee_id']);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);
        $user->roles()->attach($request['roles']);
        $employee->user_id = $user->id;
        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'roles' => $user->roles,
            'token' => $token
        ];



        return response($response, 201);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $user->roles;
        $response = [
            'user' => $user,
            'roles' => Role::all(),
        ];
        return response($response, 201);
    }

    public function changePassword(Request $request, $id)
    {
        $fields = $request->validate([
            'newPassword' => 'required|string|confirmed',
            'oldPassword' => 'required|string'
        ]);
        $user = User::findOrFail($id);
        if (!$user || !Hash::check($fields['oldPassword'], $user->password)) {
            return response([
                'message' => 'Invalid Old Password'
            ], 401);
        }

        $user->password = bcrypt($fields['newPassword']);
        $user->save();

        $response = [
            'user' => $user,
            'message' => 'Change Password Succesful'
        ];
        return response($response, 201);
    }

    public function update(Request $request, $id)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'roles' => 'required',
            'email' => 'required|string',
        ]);
        $user = User::findOrFail($id);

        $user->name = $fields['name'];
        $user->email = $fields['email'];
        $user->roles()->sync($fields['roles'] === null ? [] : $fields['roles']);
        $user->save();

        $response = [
            'user' => $user,
            'roles' => $user->roles,
        ];
        return response($response, 201);
    }
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string'
        ]);


        $credentials = request(['name', 'password']);
        if (!Auth::attempt($credentials)) {
            return response([
                'message' => 'Invalid login'
            ], 401);
        }
        $user = User::where('name', $request['name'])->first();


        $token = $user->createToken('myapptoken')->plainTextToken;
        $response = [
            'user' => $user,
            'roles' => $user->roles,
            'token' => $token
        ];

        return response($response, 200);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logged out'
        ], 200);
    }
}
