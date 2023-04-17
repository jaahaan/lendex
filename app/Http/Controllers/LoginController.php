<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
class LoginController extends Controller
{
    public function login(Request $request) {

        $validator = Validator::make($request->all(),[
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }



		if (Auth::attempt(['username' => $request->username, 'password' => $request->password ])) {
            $user = User::where('username',$request->username)->first();
			// return redirect("/");
            return response()->json([
                'success'=>true,
                'user'=>$user
            ],200);
		 }
		 else{

			// return redirect()->back()->with('error','Password is incorrect!');
            return response()->json([
                'success'=>false,
                'message'=>'Password is incorrect!'
            ],402);
		 }

	}
    public function forgetPassword(Request $request) {
		$user = User::where('username', $request->username)->first();
		if($user == null){
			return redirect()->back()->with('error','Username not found!');
		}
		if($user->userType != 'Admin' && $user->userType != "Editor"){
			return redirect()->back()->with('error','You are not autorized to admin site!');
		}
		$code = rand( 1000 , 9999 );
		$url = "http://66.45.237.70/api.php";
		$data= array(
        'username'=>env('SMS_USER'),
        'password'=>env('SMS_PASS'),
		'number'=>$user->contact,
		'message'=>"Your Finesse OTP is $code"
		);
		$ch = curl_init(); // Initialize cURL
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$smsresult = curl_exec($ch);

		$p = explode("|",$smsresult);
		$sendstatus = $p[0];
		if($sendstatus != 1101){
			return redirect()->back()->with('error','Something Went Wrong!');
		}
		User::where('username',$request->username)->update([
			'passwordToken' => $code
		]);

		$data['username'] = $request->username;
		$data['code'] = $code;
		return redirect('/check-OTP')->with('data', $data)->with('msg',"An OTP is send to your contact number $user->contact !");

	}
    public function changePassword(Request $request) {
		\Log::info('$request');
		\Log::info($request);
		$user = User::where('username', $request->username)->where('passwordToken',$request->code)->first();
		if($user == null){
			$dataa['username'] = $request->username;
			$dataa['code'] = $request->code;
			return redirect('/check-OTP')->with('data', $dataa)->with('error','Invalid Code!');
		}
		User::where('username',$request->username)->update([
			'passwordToken' => null
		]);

		$data['username'] = $request->username;
		return redirect('/reset-password')->with('data', $data)->with('msg',"Please Reset your password!");

	}
    public function resetpassword(Request $request) {
		\Log::info('$request-resetpassword');
		\Log::info($request);
		$this->validate($request, [
            'password' => 'required|string|min:6|confirmed',
		]);

		$password = Hash::make($request->password);
		$user = User::where('username', $request->username)->update([
			'password' => $password
		]);
		if($user == 1){

			return redirect('/login')->with('msg','Password change successfully! Please login with your new password.');
		}
		$data['username'] = $request->username;
		return redirect('/reset-password')->with('data', $data)->with('error',"Something Went Wrong!");

	}
}
