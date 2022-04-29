<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Exception;
use Illuminate\Support\Facades\validator;

class AdminContactController extends Controller
{
    public function getContact()
    {
        try {
            $contact = Contact::orderBy('id', 'desc')->get();
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
        $result = Contact::findOrFail($id)->delete();
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Contact Delete Successfully'
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Some Problem'
            ]);
        }
    }
}
