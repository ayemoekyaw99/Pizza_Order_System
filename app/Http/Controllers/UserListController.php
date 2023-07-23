<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserListController extends Controller
{
  //users lists
  public function list(){
    $users=User::where('role','user')->get();
    //dd($users->toArray());
     return view('admin.user.list',compact('users'));
  }

  //change role with ajax
  public function changeRole(Request $request){
    //logger($request->all());
      logger($request->user_id);
    $users=User::where('id',$request->user_id)->update(['role'=>$request->role]);
    return response()->json($users, 200, );
  }

  //delete user with ajax
  public function deleteUser(Request $request){
    //  logger($request->all());
    User::where('id',$request->user_id)->where('role',$request->role)->delete();
  }

  //edit user profile
  public function editUser(Request $request,$id){
    $user =User::where('id',$id)->first();
   return  view('admin.user.edit',compact('user'));
  }

  //update user info in db
   public function updateUser(Request $request){
    // dd($request->all());
    // dd($request->userId);
    $this->checkValidation($request);
    $data=$this->getData($request);


        if($request->hasFile('image')){

            $dbImage=User::select('image')->where('id',$request->userId)->first();
            // dd($dbImage->toArray());
            // dd($dbImage['image']);
            $dbImage=$dbImage['image'];

            if($dbImage!=null){
                Storage::delete(['public/'.$dbImage]);
            }
            $fileName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/',$fileName);
            $data['image']=$fileName;
        }
        $user=User::where('id',$request->userId)->update($data);
        return redirect()->route('user#list')->with(['status'=>'Successful  Updated']);
  }

//validation check
    private function checkValidation($request){
        $validateData=[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'gender'=>'required',

        ];
        Validator::make($request->all(),$validateData)->validate();
    }


// get form data
private function getData($request){
    $data=[
        'name'=>$request->name,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'address'=>$request->address,
        'gender'=>$request->gender,
    ];
    return $data;
}

}