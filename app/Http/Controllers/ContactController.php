<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Models\Contact;
use Validator;
class ContactController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('contactForm');
    }
   
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
       $messages = [
            'name.required' =>'Please enter name here.',
            'email.required'=>'Please enter email here.',
            'subject.required'=>'Please subject here.',
            'message.required'=>'Please enter message here.',
            'email'=>'Please enter valid email.'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            // 'phone' => 'required|digits:10|numeric',
            'subject' => 'required',
            'message' => 'required'
        ],$messages);
  
       if ($validator->fails()) {
       
          return response()->json(['error'=>$validator->errors()],403);
       }
        Contact::create($request->all());
   
        return response()->json(['success' => 'Thank you for contacting us. We will get back to you shortly.']);
    }
}