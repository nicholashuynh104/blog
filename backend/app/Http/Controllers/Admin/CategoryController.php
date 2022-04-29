<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\validator;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::orderBy('id', 'desc')->get();
            if ($categories) {
                return response()->json([
                    'success' => true,
                    'category' => $categories
                ]);
            }
        } catch(Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function getTotalCategory()
    {
        try {
            $categories = Category::count();
            if ($categories) {
                return response()->json([
                    'success' => true,
                    'category' => $categories
                ]);
            }
        } catch(Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validation = Validator::make($request->all(),[
                'category_name' => ['required','string','max:20','min:10','unique:categories']
            ]);
            if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validation->errors()->all()
                ]);
            } else {
                $result = Category::create([
                    'category_name' => $request->category_name
                ]);
                if ($result) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Category Added Successfully'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Some Problem'
                    ]);
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        try {
            return response()->json([
                'success' => false,
                'category' => $category,
            ]);

        }catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validation = Validator::make($request->all(), [
            'category_name' => [
                'required', 'string', 'max:20', 'min:10', 'unique:categories'
            ]
        ]);
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validation->errors()->all()
            ]);
        } else {
            $category->category_name = $request->category_name;
            $result = $category->save();
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Category Updated Successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Some Problem'
                ]);
            }
        }
    }

    public function delete($id)
    {
        try {
            $result = Category::findOrFail($id)->delete();
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Category Deleted Successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Some Problem'
                ]);
            }
        } catch(Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function search($search)
    {
        try {
            $categories = Category::where('category_name','LIKE','%'.$search.'%')->orderBy('id', 'desc')->get();
            if ($categories) {
                return response()->json([
                    'success' => true,
                    'category' => $categories
                ]);
            }
        } catch(Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}
