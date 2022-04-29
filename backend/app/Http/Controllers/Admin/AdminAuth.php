<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminAuth extends Controller
{
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => ['required','string'],
            'password' => ['required','string','min:8']
        ]);
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->all(),
            ]);
        }
        $users = User::where('name', $request->name)->first();
        if (!$users) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid username or password',
            ]);
        } else {
            if (!Hash::check($request->password,$users->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid username or password',
                ]);
            } else {
                $token = $users->createToken('token')->plainTextToken;
                return response()->json([
                    'success' => true,
                    'message' => 'Login Successfully',
                    'token' => $token
                ]);
            }
        }
    }

    public function admin(Request $request)
    {
        $users = $request->user();
        return response()->json([$users]);
    }

    public function logout(Request $request)
    {
        $id = $request->user()->id;
        auth()->user()->tokens()->where('tokenable_id',$id)->delete();
    }
}
