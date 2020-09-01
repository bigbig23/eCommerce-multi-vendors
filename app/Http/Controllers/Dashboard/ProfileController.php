<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function editProfile(){
        $admin= Admin::find(auth('admin')->user()->id);
        return view('dashboard.profile.edit', compact('admin'));
    }


   /* public function updateProfile(ProfileRequest $request){
        //return $request;

        //Saving this without password
          $admin = Admin::find(auth('admin')->user()->id);
            //$admin->update($request->only(['name','email']));

          if($request->filled('password') && $request->filled('password_confirmation')){
              if($request->password === $request->password_confirmation)
                  return $request->merge(['password'=> bcrypt($request->password)]);
          }
          //unset($request['id']); //to remove id, so that is not updated
          //unset($request['confirmed_password']);
          return $request;
        $admin->update($request->all());

        return redirect()->back()->with(['success'=>'تم التحديث بنجاح']);

    }*/




    public function updateProfile(ProfileRequest $request){
        //return $request;

        $data = $request->validated();

        if(empty($data['password']))  {
            unset($data['password']);
        }

        //return $data;
        $admin = Admin::find(auth('admin')->user()->id);
        $orginalpassword = $admin->password;
        $password = $request->password;


        if(array_key_exists('password', $data)) {
            // Password was filled update password
            if(Hash::check($request->oldpassword, $orginalpassword)){
                $admin->password = Hash::make($password);
                $admin->save();
                return redirect()->back()->with(['success'=>'the password has been updated successfully !']);
            }else{
                return redirect()->back()->with(['error'=>'the old password does not match ']);
            }
        }else{
            //Update without password
            $admin->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);
            return redirect()->back()->with(['success'=>'updated successfully !']);
        }
    }

}
