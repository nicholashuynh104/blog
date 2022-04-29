<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\validator;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required','max:100','min:5'],
            'email' => ['required','email'],
            'comment' => ['required'],
        ]);
        if ($validation->fails()) {
            return response()->json([
                'success' => true,
                'message' => $validation->errors()->all(),
            ]);
        } else {
            $result = Comment::create([
                'post_id' => $id,
                'email' => $request->email,
                'name' => $request->name,
                'comment' => $request->comment
            ]);
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Comment Successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Some Problem'
                ]);
            }
        }
    }

    public function getComment()
    {
        try {
            $comment = Comment::orderBy('id', 'desc')->get();
            return response()->json([
                'success' => true,
                'comment' => $comment
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'comment' => $e->getMessage()
            ]);
        }
    }

    public function getTotalComments()
    {
        try {
            $comment = Comment::count();
            return response()->json([
                'success' => true,
                'comment' => $comment
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'comment' => $e->getMessage()
            ]);
        }
    }
}
