<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscribe;
use Exception;
use Illuminate\Support\Facades\validator;


class SubscribeController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validation = Validator::make($request->all(),[
                'email' => ['required','email']
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'success' => true,
                    'message' => $validation->errors()->all()
                ]);
            } else {
                $subscribe = Subscribe::create([
                    'email' => $request->email,
                ]);
                if ($subscribe) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Subscribe Successfully'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Subscribe Fail'
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
