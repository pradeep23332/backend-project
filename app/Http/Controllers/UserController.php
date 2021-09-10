<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  //
    function register(Request $req)
    {
        $staff= new Staff;
        $staff->name= $req->input('name');
        $staff->phone= $req->input('phone');
        $staff->stafftype= $req->input('stafftype');
        $staff->email= $req->input('email');
        $staff->password= Hash::make( $req->input('password'));
        $staff->save();
        return  $staff;
    }
    function login(Request $req )
    {
      $staff= Staff::where ('email',$req->email)->first();
      if(!$staff || !Hash::check($req->password,$staff->password))
      {
         return ["error"=>"Email or password is not match"];
      } 
      else{
        if ($staff->stafftype=="nurse")
        {
          $role = 'nurse';
        }
        else if ($staff->stafftype=="metron")
        {
          $role = 'metron';
        }
        else if ( $staff->stafftype=="attendant")
        {
          $role = 'attendant';
        }
        else if ( $staff->stafftype=="pharmacist")
        {
          $role = 'pharmacist';
        }
        else if( $staff->stafftype=="accountant")
        {      
          $role = 'accountant';
        }
        else if ($staff->stafftype=="receptionist")
        {
          $role = 'receptionist';
        }
        else if( $staff->stafftype=="labtechnician")
        {
          $role = 'labtechnician';
        }
        else if( $staff->stafftype=="radiologist")
        {
          $role = 'radiologist';
        }
        else {
          $role = 'eservice';
        }

        
        return response()->json([
          'staff'=>$staff,
          'role'=>$role,
        ]);
        
      }
    
    }
    
    function update (Request $request) {
      
      $staff = Staff::where('id', $request->id)
        ->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email
        ]);

        $neww = Staff::find($request->id);
        
        return response()->json([
          'staff'=>$neww,
          'role'=>$neww->stafftype
        ]);
    }

    function del ($id) {

      $del = Staff::find($id);

      if ($del->id) {

        $del->delete();
      } else {
        $del = 'null';
      }

      return $del;
    }
}
    
    
    

