<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Exception;
use Illuminate\Support\Facades\validator;

class ContactController extends Controller
{
    public function store (Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => ['required','max:100','min:5'],
            'email' => ['required','email'],
            'subject' => ['required'],
            'message' => ['required']
        ]);
        if ($validation->fails()) {
            return response()->json([
                'success' => true,
                'message' => $validation->errors()->all(),
            ]);
        } else {
            $result = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message
            ]);
            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Contact Successfully Admin will response you via email'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Some Problem'
                ]);
            }
        }
    }

    public function getContact()
    {
        try {
            $contact = Contact::orderBy('id','desc')->get();
            return response()->json([
                'success' => true,
                'contact' => $contact
            ]);
        }catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'contact' => $e->getMessage()
            ]);
        }
    }

    public function getTotalContact()
    {
        try {
            $contact = Contact::count();
            return response()->json([
                'success' => true,
                'contact' => $contact
            ]);
        }catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'contact' => $e->getMessage()
            ]);
        }
    }
}
