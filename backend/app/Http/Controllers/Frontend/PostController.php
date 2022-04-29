<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        try {
            $post = Post::orderBy('id','desc')->get();
            return response()->json([
                'success' => true,
                'post' => $post
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'post' => $e->getMessage()
            ]);
        }
    }

    public function getTotalPost()
    {
        try {
            $post = Post::count();
            return response()->json([
                'success' => true,
                'post' => $post
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'post' => $e->getMessage()
            ]);
        }
    }

    public function viewPost()
    {
        try {
            $post = Post::with('category')->where('views','>',0)->orderBy('id','desc')->get();
            return response()->json([
                'success' => true,
                'post' => $post
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'post' => $e->getMessage()
            ]);
        }
    }

    public function getPostById($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->increment('views',1);
            return response()->json([
                'success' => true,
                'post' => $post
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'post' => $e->getMessage()
            ]);
        }
    }

    public function getPostByCategory($id)
    {
        try {
            $post = Post::where('id',$id)->orderBy('id','desc')->get();
            return response()->json([
                'success' => true,
                'post' => $post
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'post' => $e->getMessage()
            ]);
        }
    }

    public function searchPost($search)
    {
        try {
            $post = Post::where('title','LIKE','%'.$search.'%')->orderBy('id','desc')->get();
            return response()->json([
                'success' => true,
                'post' => $post
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'post' => $e->getMessage()
            ]);
        }
    }
}
