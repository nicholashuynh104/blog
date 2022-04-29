<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class AdminCommentController extends Controller
{
    public function index()
    {
        try {
            $contact = Comment::orderBy('id', 'desc')->get();
            return response()->json([
                'success' => true,
                'contact' => $contact
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'contact' => $e->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        $result = Comment::findOrFail($id)->delete();
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Comment Delete Successfully'
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Some Problem'
            ]);
        }
    }
}
