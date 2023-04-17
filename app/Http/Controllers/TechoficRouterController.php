<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Router;
use App\Models\Product;
use App\Models\ActionLog;
class TechoficRouterController extends Controller
{
    public function index(){
        return Router::all();
    }

    public function sidebar(){
        return Router::with('menus.menus')->where('parent_id',null)->get();
    }
    public function autorizedSidebar(){
        $user_id=Auth::user()->id;
        $allrouters =  Router::with('menus.menus')->where('parent_id',null)->orderby('order_no','asc')->get();
        return $allrouters;
        
    }

    public function getRouter(Request $request){
        $search = $request->search;
        $id = $request->id;
        $pageSize = $request->pageSize ? $request->pageSize : 10;
        $router =  Router::select('id','parent_id','type','title','name','path','icon','is_show','order_no');
        if($search){
            $router->where(function($query) use ($search){
                $query->where('type',$search)->orwhere('title','LIKE',"%$search%")->orwhere('name','LIKE',"%$search%");
            });
        }
        if($id){
           return $router->where('parent_id',$id)->orderby('order_no','asc')->get();
        }
        return $router->where('parent_id',null)->orderby('order_no','asc')->get();

        // return $router->paginate($pageSize);
    }

    public function getParentRoute($id){
        $router = Router::where('id',$id)->first();
        if($router->parent_id){
            $data = Router::where('parent_id',$router->parent_id)->orderby('order_no','asc')->get();
            return response()->json([
                 'data'=>$data,
                'parent_id'=>$router->parent_id
            ]);
        }
        $data = Router::where('parent_id',null)->orderby('order_no','asc')->get();
        return response()->json([
           'data'=>$data,
           'parent_id'=>$router->parent_id
       ]);
    }

    public function getRouterDetail($id){
        return Router::where('id',$id)->first();
    }
    public function getParentMenu(Request $request){
        return Router::where('type','submenu')->get();
    }
    public function addRouter(Request $request){
        $validator = Validator::make($request->all(),[
            'type' => 'required',
            'title' =>'required',
            'name'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $router = Router::create($request->all());
        $update = Router::where('id',$router->id)->update(['order_no'=>$router->id]);
        
        return $router;
    }
    public function updateRouter(Request $request){
        $validator = Validator::make($request->all(),[
            'type' => 'required',
            'title' =>'required',
            'name'=>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $router = Router::where('id',$request->id)->update($request->all());

        return $router;
    }

    public function resetRoutesPosition(Request $request){
        $data = $request->all();
        $new_arr = [];

        foreach($data as $item){
            Router::where('id',$item['id'])->update(['order_no'=>$item['order_no']]);
        }
        return 'updated successful';
    }

    public function deleteRouter(Request $request,$id){
        $data = $request->all();
        $user_id = Auth::user()->id;
        $user = User::select('id','password','username')->where('id',$user_id)->first();
        if(!Hash::check($data['password'], $user->password)){
            return response()->json([
                'message' => 'Password does not match',
                'status' => false
            ],422);
        }
        $router = Router::where('id',$id)->delete();
        
        return $router;
    }

    // get Central Search
    public function getCentralSearch(Request $request){
        $search = $request->search;
        $type = $request->type? $request->type : 'Pages';

        if($type == 'Pages'){
            $user_id=Auth::user()->id;

            $isAdmin = (Auth::user()->userType == "Admin" || Auth::user()->user_role_id == 1) ? true : false ;
            $userRoutes = [];
            $allrouters =  Router::where('type','menu')->where('title','like',"%$search%");

            if($isAdmin == false){
                $user = User::where('id',$user_id)->with('role')->first();
                $userRoutes = $user->role->authorize_routes;
                $allrouters->whereIn('name',$userRoutes);
            }
            $data = $allrouters->orderby('order_no','asc')->limit(8)->get();
            return $data;
        }
            $search = $request->search;
            $query =  Product::with('menu', 'group','category','brand','mainproduct')->where('is_archived',0);

            if($search){

                $query->where(function ($queryy) use ($search){
                    $queryy->Where('productName', 'like', "%$search%");
                        $queryy->orWhere('model', 'like', "%$search%");
                });
            }
            $data = $query->limit(10)->get();
            return $data;
    }
}
