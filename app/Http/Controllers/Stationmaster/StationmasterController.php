<?php

namespace App\Http\Controllers\Stationmaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Stationmaster;
use Illuminate\Support\Facades\Auth;

class StationmasterController extends Controller
{
    function check(Request $request){
        //Validate Inputs
        $request->validate([
           'email'=>'required|email|exists:stationmasters,email',
           'password'=>'required|min:5|max:30'
        ],[
            'email.exists'=>'This email is not exists in stationmasters table'
        ]);

        $creds = $request->only('email','password');

        if( Auth::guard('stationmaster')->attempt($creds) ){
            return redirect()->route('stationmaster.home');
        }else{
            return redirect()->route('stationmaster.login')->with('fail','Incorrect credentials');
        }
   }

    function logout(){
        Auth::guard('stationmaster')->logout();
        return redirect('/');
    }

}
