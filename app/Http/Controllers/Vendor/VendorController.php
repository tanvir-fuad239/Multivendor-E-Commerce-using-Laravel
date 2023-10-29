<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class VendorController extends Controller
{
    
    // vendor dashboard
    public function vendor_dashboard(){

        return view('vendor.vendor_dashboard');

    }

    // vendor login 
    public function vendor_login(){

        return view('vendor.vendor_login');

    }

    // vendor profile 
    public function vendor_profile(){

        $vendor_id = Auth::user()->id;
        $vendor_info = DB::table('users')->where('id', $vendor_id)->first();
 
        return view('vendor.vendor_profile', compact('vendor_info'));

    }

    // vendor profile update 
    public function vendor_profile_update(Request $request){

        $vendor_id = Auth::user()->id;
        $vendor_info = DB::table('users')->where('id',$vendor_id)->first();

        $new_image = $request->file('photo');

        if($new_image){

            $custom_image_name = uniqid(). '.' . $new_image->getClientOriginalExtension();
            @unlink(public_path('uploads/vendor/images/' . $vendor_info->photo));
            $new_image->move(public_path('uploads/vendor/images/'), $custom_image_name);

        }

        else{

            $custom_image_name = $vendor_info->photo;

        }

        DB::table('users')->where('id',$vendor_id)->update([

            "name" => strtoupper($request->name),
            "email" => $request->email,
            "photo" => $custom_image_name,
            "phone" => $request->phone,
            "address" => $request->address

        ]);

        return redirect()->route('vendor.profile')->with('message','Vendor Profile Updated Successfully!');
    }

    // vendor change password 
    public function vendor_change_password(){

        return view('vendor.vendor_change_password');
    }

    // vendor update password 
    public function vendor_update_password(Request $request){

        if(!Hash::check($request->old_password, Auth::user()->password)){
            return redirect()->route('vendor.change.password')->with('error1', "Old password doesn't match!");
        }

        elseif($request->new_password == '' || $request->new_password == null){
            return redirect()->route('vendor.change.password')->with('error2', "New password can't be null or blank!");
        }

        elseif($request->new_password != $request->confirm_password){
            return back()->with('error3', "New password and confirm password don't match!");
        }

        else{
            DB::table('users')->where('id', Auth::user()->id)->update([
                "password" => Hash::make($request->new_password)
            ]);
            return redirect()->route('vendor.change.password')->with('success', "Vendor password updated successfully.");
        }

    }

    // vendor logout
    public function vendor_logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('vendor.login');
    }
}
