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
      return $staff;
    }
}
    
    
    

