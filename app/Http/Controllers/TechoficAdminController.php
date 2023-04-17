<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSearch;
use App\Models\ActionLog;
use App\Models\Archived;
use App\Models\Invoice;
use App\Models\Paymentsheet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class TechoficAdminController extends Controller
{
    //
    public function allAdmins(Request $request){
        $search = $request->search;
        $store_id = $request->store_id;
        $limit = $request->limit ? $request->limit : 10;

        $data=User::select('id','name','email','username','contact','userType')->where('is_archived',0)->where('userType','!=','Customer');
        if($search) {

            $data->where(function ($query) use ($search){
                $query->orWhere('name',  'like', "%$search%")
                    ->orWhere('email',  'like', "%$search%")
                    ->orWhere('username', 'like', "%$search%");
            });
        }
        if($store_id){
            $data->where(function($query) use ($store_id){
                $query->where('store_id',$store_id)
                ->orWhere('userType','Admin');
            });
        }


        return $data->limit($limit)->get();

    }

    public function userList(Request $request)
    {
        $pageSize = $request->pageSize ? $request->pageSize : 20;
        $search = $request->search;
        $userType = $request->userType;

        $data=User::with('store')->where('is_archived',0);
        if($userType) $data->where('userType','Customer');
        else $data->where('userType','!=','Customer');
        if($search) {

            $data->where(function ($query) use ($search){
                $query->orWhere('name',  'like', "%$search%")
                    ->orWhere('email',  'like', "%$search%")
                    ->orWhere('username', 'like', "%$search%")
                    ->orWhere('contact', 'like', "%$search%")
                    ->orWhere('userType', 'like', "%$search%");
            });
        }

        return $data->paginate($pageSize);

    }

    public function getSingleUser($id){
        return User::where('id',$id)->first();
    }

    public function newUser(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'username'=>'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $user = User::create($request->all());
        $actionLogData=[
            'user_id'=>Auth::user()->id,
            'content'=> Auth::user()->name." Created a new user ".$request->username,
            'item_id'=>$user->id,
            'action_type'=>'Created',
            'table_name'=>'users',
            'date'=>date('Y-m-d H:i:s'),
        ];
        ActionLog::create($actionLogData);
        // $user=new User;
        // $user->name=$request->input('name');
        // $user->email=$request->input('email');
        // $user->userType=$request->input('userType');
        // $user->username=$request->input('username');
        // $user->password=bcrypt($request->input('password'));
        // $user->save();
        return $user;
    }

    public function userUpdate(Request $request)
    {
        $actionLogData=[
            'user_id'=>Auth::user()->id,
            'content'=> Auth::user()->name." Updated a user ".$request->username,
            'item_id'=>$request->id,
            'action_type'=>'Updated',
            'table_name'=>'users',
            'date'=>date('Y-m-d H:i:s'),
        ];
        ActionLog::create($actionLogData);
        return User::where('id',$request->id)->update($request->all());
    }


    public function userRemove(Request $request, $id)
    {
        $data=$request->all();
        $user_id = Auth::user()->id;
        $user = User::select('id','password','username')->where('id',$user_id)->first();
        if(!Hash::check($data['password'], $user->password)){
            return response()->json([
                'message' => 'Password does not match',
                'status' => false
            ],422);
        }
        $invoice = Invoice::where('admin_id',$id)->get();
        $paymentsheet = Paymentsheet::where('admin_id',$id)->get();
        if(count($invoice)>0 || count($paymentsheet)>0){
            $archived_data=[
                'name'=>$request->username,
                'table_name'=>'users',
                'item_id'=>$id
            ];
            Archived::create($archived_data);
            $user=User::where('id',$id)->update([
                'is_archived'=>1
            ]);
            $actionLogData=[
                'user_id'=>Auth::user()->id,
                'content'=> Auth::user()->name." Archived a user ".$request->username,
                'item_id'=>$id,
                'action_type'=>'Archived',
                'table_name'=>'users',
                'date'=>date('Y-m-d H:i:s'),
            ];
            ActionLog::create($actionLogData);
            return response()->json(['msg'=>'success','status'=>$request->id]);
        }else{
            $group = User::where('id','=',$id)
              ->first();
            $group->delete();
            $actionLogData=[
                'user_id'=>Auth::user()->id,
                'content'=> Auth::user()->name." Deleted a user ".$request->username,
                'item_id'=>$id,
                'action_type'=>'Deleted',
                'table_name'=>'users',
                'date'=>date('Y-m-d H:i:s'),
            ];
            ActionLog::create($actionLogData);
            // return $group;
            return response()->json(['msg'=>'success','status'=>$request->id]);
        }
    }

    public function userPasswordChange(Request $request) {
        $validator = Validator::make($request->all(),[
            'password' => 'required|string|min:6',
            'old_password' => 'required',
		]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $data = $request->all();

        $user_id = Auth::user()->id;

        $user = User::select('id','password')->where('id',$user_id)->first();
        if(!Hash::check($data['old_password'], $user->password)){
            return response()->json([
                'message' => 'Old Password does not match',
                'status' => false
            ],402);
        }

		$password = Hash::make($request->password);
		$user = User::where('id', $user_id)->update([
			'password' => $password
		]);
		if($user == 1){

            return response()->json([
                'msg'=>'success',
            ]);
		}
		return response()->json([
            'message'=>'Something went wrong!',
        ],402);

	}
    public function userSearches(Request $request){
        $page = $request->page;
        $pageSize = $request->pageSize;
        $str=  $request->str;
        $data = UserSearch::with('user');
        if($str){
            $data->where('str','LIKE',"%$str%");
        }
        return $data->paginate($pageSize);
    }
    public function deleteSearches($date1,$date2){
        return UserSearch::whereBetween('created_at',[$date1,$date2])->delete();
    }
}
