<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::orderBy('id','DESC')->with('category')->get();
            if ($posts) {
                return response()->json([
                    'success' => true,
                    'posts' => $posts,
                ]);
            }
        } catch(Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'title' => ['required', 'string', 'max:100', 'min:10', 'unique:posts'],
                'description' => ['required', 'string', 'max:100', 'min:10'],
                'cat_id' => ['required'],
                'image' => ['required'],
            ]);
    
            if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validation->errors()->all(),
                ]);
            } else {
                $filename = $request->file('image')->store('posts','public') ?: '';
                $result = Post::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => $filename,
                    'cat_id' => $request->cat_id,
                    'views' => 0
                ]);
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Post Added Successfully',
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Some Problem',
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit($id)
    {
        try {
            $post = Post::findOrFail($id);
            return response()->json([
                'success' => true,
                'post' => $post
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Post::findOrFail($id);
            $validation = Validator::make($request->all(), [
                'title' => ['required', 'string', 'max:100', 'min:10', 'unique:posts'],
                'description' => ['required', 'string', 'max:100', 'min:10'],
                'cat_id' => ['required'],
            ]);
    
            if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validation->errors()->all(),
                ]);
            } else {
                $destination = public_path('storage\\'.$post->image);
                if ($request->file('new_image')) {
                    if(File::exists($destination)) {
                        File::delete($destination);
                    }
                    $filename = $request->file('new_image')->store('post','public');
                } else {
                    $filename = $request->old_image;
                }
                $post->title = $request->title;
                $post->description = $request->description;
                $post->image = $filename;
                $post->cat_id = $request->cat_id;
                $result = $post->save();
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Post Updated Successfully',
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Some Problem',
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $destination = public_path('storage\\'. $post->image);
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $result = $post->delete();
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Post Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Some Problem',
            ]);
        }
    }

    public function search($search)
    {
        try {
            $posts = Post::where('title','LIKE','%'.$search.'%')->orderBy('id','DESC')->with('category')->get();
            if ($posts) {
                return response()->json([
                    'success' => true,
                    'posts' => $posts,
                ]);
            }
        } catch(Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
