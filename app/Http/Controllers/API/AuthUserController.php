<?php

namespace App\Http\Controllers\API;

use App\Exceptions\Handler;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use Exception;

class AuthUserController extends BaseAPIController
{

    public function register(Request $request)
    {

       // return dd($request->all());
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',

            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;
            $success['email'] = $user->email;
            $success['phone'] = $user->phone;

            return $this->sendResponse($success, 'User register successfully.');
        } catch (Exception $ex) {
            return $this->catchError($ex);
        }
    }

    public function login(Request $request)
    {
        try {
            if (Auth::attempt(['email' => $request->email,
                'password' => $request->password])) {
                $user = Auth::user();
                $success['token'] = $user->createToken('MyApp')->plainTextToken;
                $success['name'] = $user->name;
                $success['email'] = $user->email;
                $success['phone'] = $user->phone;
                $success['image'] = $user->image;

                return $this->sendResponse($success, 'User login successfully.');
            } else {
                return $this->sendError('Unauthorised.', ['error' => 'Unauthorised'], 403);
            }
        } catch (Exception $err) {
            return $this->sendError($err->getMessage(), [], 500);

        }
    }

}
