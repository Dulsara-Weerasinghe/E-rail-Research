<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etablet_Request;
use DB;

class eTabletController extends Controller
{
    public function storeTablet(Request $request) {

        $tablet = new Etablet_Request;

        $tablet->req_station=$request->req;
        $tablet->des_station=$request->des;
        $tablet->status=$request->status;
        $tablet->save();

        return back()->with('msg', 'Request sent successfully.');
        //dd($request->all());
    }

    public function getRequest($station) {
        $tablet = DB::table('etablet__requests')
            ->select('id', 'req_station', 'des_station', 'status', 'created_at')
            ->where('des_station', '=', $station)
            ->get();
    
        return view('dashboard.stationmaster.etablet-approval')->with('data', $tablet);
    }


    public function updateTablet($id) {
        $affectedRows = DB::table('etablet__requests')->where('id', $id)->update([
            'status' => '1',
        ]);
    
        if ($affectedRows > 0) {
            return back()->with('message', 'The Tablet was accepted successfully.');
        } else {
            return back()->with('error', 'Failed to update the Tablet.');
        }
    }
    
    public function viewStatus($station) {
        $tablet = DB::table('etablet__requests')
            ->select('id', 'req_station', 'des_station', 'status', 'created_at')
            ->where('des_station', '=', $station)
            ->get();
    
        return view('dashboard.stationmaster.etablet-request')->with('data', $tablet);
    }
    
}