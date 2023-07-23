<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // user contact page
    public function contactPage(){
        return view('user.contact.contact');
    }

    // user contact
    public function contact(Request $request){
        // dd($request->all());
        $this->checkValidation($request);
        $data=$this->getData($request);
        Contact::create($data);
        return back()->with(['status'=>'Successful Sending']);
    }

    // admin contact list
    public function list(){
        $lists=Contact::get();
        return view('admin.contact.list',compact('lists'));
    }

    //ajax admin delete user contact if btndelete click
      public function ajaxDelete(Request $request){
        // logger($request->all());
       Contact::where('id',$request->contactId)->delete();
        return response()->json( 200, );
    }

    //ajax admin edit user contactMessage, if btnEdit click
    public function ajaxEdit(Request $request){
        // logger($request->all());
        $message=Contact::where('id',$request->contactId)->update(['message'=>$request->contactMessage]);
        return response()->json($message, 200);
    }

    //form validation
    private function checkValidation($request){

        $validateData=[
            'name'=>'required',
            'email'=>'required',
            'message'=>'required',
        ];
        Validator::make($request->all(),$validateData)->validate();
    }

     //form data
    private function getData($request){
        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
        ];
        return $data;
    }
}