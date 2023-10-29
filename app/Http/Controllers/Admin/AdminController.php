<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
 

class AdminController extends Controller
{
    
    // admin dashboard
    public function admin_dashboard(){

        return view('admin.admin_dashboard');

    }

    // admin login 
    public function admin_login(){

        return view('admin.admin_login');

    }

    // admin profile 
    public function admin_profile(){

        $admin_id = Auth::user()->id;
        $admin_info = DB::table('users')->where('id',$admin_id)->first();

        return view('admin.admin_profile', compact('admin_info'));

    }
    
    // admin profile update 
    public function admin_profile_update(Request $request){

        $admin_id = Auth::user()->id;
        $admin_info = DB::table('users')->where('id',$admin_id)->first();

        $new_image = $request->file('photo');

        if($new_image){

            $custom_image_name = uniqid() . '.' .$new_image->getClientOriginalExtension();
            @unlink(public_path('uploads/admin/images/' . $admin_info->photo));
            $new_image->move(public_path('uploads/admin/images/'), $custom_image_name);

        }

        else{

            $custom_image_name = $admin_info->photo;

        }

        DB::table('users')->where('id', $admin_id)->update([

            "name" => strtoupper($request->name),
            "email" => $request->email,
            "photo" => $custom_image_name,
            "phone" => $request->phone,
            "address" => $request->address

        ]);

        return redirect()->route('admin.profile')->with('message','Admin Profile Updated Successfully!');


         

    }

    // admin change password 
    public function admin_change_password(){

        return view('admin.admin_change_password');

    }

    // admin update password 
    public function admin_update_password(Request $request){
        
        if(!Hash::check($request->old_password, Auth::user()->password)){
            return redirect()->route('admin.change.password')->with('error1', "Old password doesn't match!");
        }

        elseif($request->new_password == '' || $request->new_password == null){
            return redirect()->route('admin.change.password')->with('error2', "New password can't be null or blank!");
        }

        elseif($request->new_password != $request->confirm_password){
            return redirect()->route('admin.change.password')->with('error3', "New password and confirm password don't match!");
        }

        else{
            DB::table('users')->where('id', Auth::user()->id)->update([
                "password" => Hash::make($request->new_password)
            ]);
            return redirect()->route('admin.change.password')->with('success', "Admin password updated successfully.");
        }
    }

    // admin logout 
    public function admin_logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
