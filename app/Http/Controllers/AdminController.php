<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
     //Password change  page
    public function changePasswordPage(){
        return view('admin.account.passwordChange');
    }

     //Password change
     public function changePassword(Request $request){
        $this->checkPasswordChange($request);
        $dbPassword=(Auth::user()->password);

      if (Hash::check($request->oldPassword,$dbPassword)) {
          User::where('id',Auth::user()->id)->update(['password'=>Hash::make($request->newPassword)]);
            // Auth::logout();
            // return redirect()->route('auth#loginPage');
            return back()->with(['status'=>'Successful Password Updated']);

      }

        return back()->with(['notMatch'=>'Old password does not match.Try again!']);

    }

    //account info
     public function accountInfo(){
        $user = User::where('id',Auth::user()->id)->first();
        return view('admin.account.info',compact('user'));
    }

     //account updatepage
     public function editProfilePage(Request $request){
        //dd(Auth::user()->id);
        $user = User::where('id',Auth::user()->id)->first();
        //dd($user->toArray());
        return view('admin.account.editProfile',compact('user'));
    }

    //account update in db
    public function updateProfile(Request $request){

        $this->checkDataValidate($request);
        $updateData=$this->updateData($request);

        if ($request->hasFile('image')) {

            $oldName=User::select('image')->where('id',Auth::user()->id)->first()->toArray();
            $oldName=$oldName['image'];
            // dd($oldName);
            if($oldName !=null){
            Storage::delete('public/'.$oldName);
            }

           $fileName =uniqid().$request->file('image')->getClientOriginalName();
           $request->file('image')->storeAs('public', $fileName);
           $updateData['image']=$fileName;
        }

        User::where('id',Auth::user()->id)->update($updateData);
        return back()->with(['status'=>'Successful account updated']);
    }

    //admin list
     public function list(){
        $users=User::when(request('searchKey'),function($query){
                    $query->orWhere('name','like','%'.request('searchKey').'%');
                    $query->orWhere('email','like','%'.request('searchKey').'%');
                    $query->orWhere('phone','like','%'.request('searchKey').'%');
                    })
                    ->where('role','admin')
                    ->paginate(2);
                    $users->appends(request()->all());

        return view('admin.account.list',compact('users'));
     }

     public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['status'=>'Successful Admin Deleted']);
     }

     public function changeRole($id){
        $user=User::where('id',$id)->first();
       return view('admin.account.changeRole',compact('user'));
     }

     public function updateRole(Request $request,$id){
            User::where('id',$id)->update(['role'=>$request->role]);
            return redirect()->route('admin#list')->with(['status'=>'Successful Role Updated']);
     }

    private function checkDataValidate($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'address'=>'required',
            'image'=>'mimes:jpg,png,jpeg,bmp,tiff,webp|file',
        ])->validate();
    }

    private function updateData($request){
        return [
            'name' =>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'address'=>$request->address,
        ];
    }




}