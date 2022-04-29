<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscribe;
use Exception;

class AdminSubscribeController extends Controller
{
    public function index()
    {
        try {
            $subscribe = Subscribe::get();
            return response()->json([
                'success' => true,
                'subscribes' => $subscribe
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'subscribes' => $e->getMessage()
            ]);
        }
    }

    public function getTotalSubscribe()
    {
        try {
            $subscribe = Subscribe::count();
            return response()->json([
                'success' => true,
                'subscribes' => $subscribe
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'subscribes' => $e->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            $result = Subscribe::findOrFail($id)->delete();
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => "UnSubscribe Successfully"
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "UnSubscribe Fail"
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
