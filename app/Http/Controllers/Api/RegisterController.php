<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request) {
        $message = "success";

        if (User::where('email', '=', $request->email)->exists()) {
            $data['errors'] = ["User email already exist"];
            return response()->json($data, 422);
        }

        try {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->date_of_birth = $request->dob;
            $user->country = $request->country;
            $user->save();
        } catch (\Exception $e) {
            $data['errors'] = [$e->getMessage()];
            return response()->json($data, 400);
        }

        $data = [
            'message' => $message
        ];

        return response()->json($data, 201);
    }
}
