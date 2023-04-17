<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Paymentsheet;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\Gallery;
use App\Models\User;
use Auth;
use Hash;
class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public $Base_Url = ;
    //public $Base_Url ='http://127.0.0.1:8000';
    public function index(){
        $settings=Setting::first();
        return $settings;
    }
    public function authUser(){
        $user = Auth::user();
        return $user;
    }
    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $curPassword = $request->input('curPassword');
        $newPassword = $request->input('newPassword');

        if (Hash::check($curPassword, $user->password)) {
            $user_id = $user->id;
            $opassword = Hash::make($newPassword);
             User::where('id',$user->id)->update([
                 'password' => $opassword
             ]); 

            return response()->json(["result"=>true]);
        }
        else
        {
            return response()->json(["result"=>false]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Dhaka');
        $created=Setting::create($request->all());
         return response()->json([
                 'msg' => 'Inserted',
                 'status' => $created
            ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        \Log::info('worked');
        //return Setting::where('id',$request->id)->update($request->all());
    }
  


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // file upload


    public function setup()
    {
        date_default_timezone_set('Asia/Dhaka');
        $date=date("Y-m-d");
        Paymentsheet::create([
            'amount' => 0,
            'paymentFor' => 'cash',
            'admin_id' => 1,
            'type' => 'incoming',
            'date'=> $date,
        ]);
        $customer=Customer::create([
            'customerName' => 'CASH',// incoming is profit, outgoing expense, due => due for supplier , due for customer 
            'contact'=> '016',//  customer mean, I am selling to customer, supllier mean buying from suplier 
        ]);
        $supplier=Supplier::create([
            'supplierName' => 'CASH',// incoming is profit, outgoing expense, due => due for supplier , due for customer 
        ]);

        $s=Setting::create([
            'companyName' => 'Dreams Gallery',
        ]);

        return $s;


    }
}
