<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;
use Validator;
class ServiceController extends Controller
{
    
    public function getService(Request $request){
      
        $search = $request->search;
        $id = $request->id;
        $Service =  Service::select('id','parent_id','title','icon','order_no');
        if($search){
            $Service->where(function($query) use ($search){
                $query->where('title','LIKE',"%$search%");
            });
        }
        if($id){
           return $Service->where('parent_id',$id)->orderby('order_no','asc')->get();
        }
        return $Service->where('parent_id',null)->orderby('order_no','asc')->get();

    }
    public function getParentService($id){
        $Service = Service::where('id',$id)->first();
        if($Service->parent_id){
            $data = Service::where('parent_id',$Service->parent_id)->orderby('order_no','asc')->get();
            return response()->json([
                 'data'=>$data,
                'parent_id'=>$Service->parent_id
            ]);
        }
        $data = Service::where('parent_id',null)->orderby('order_no','asc')->get();
        return response()->json([
           'data'=>$data,
           'parent_id'=>$Service->parent_id
       ]);
    }
    public function getServiceD(Request $request){
        return Service::where('parent_id', null)->orderby('order_no','asc')->get();
    }
    public function addService(Request $request){
        $validator = Validator::make($request->all(),[
            'title' =>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $Service = Service::create($request->all());
        $data = Service::where('id',$Service->id)->update([
            'order_no' => $Service->id,
        ]);

        return $Service;
    }

    public function getServiceDetail($id){
        return Service::where('id',$id)->first();
    }

    public function updateService(Request $request){
        $validator = Validator::make($request->all(),[
            'title' =>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $Service = Service::where('id',$request->id)->update($request->all());

        return $Service;
    }
    public function deleteService(Request $request){
        $data = Service::where('parent_id',$request->id)->delete();
        $Service = Service::where('id',$request->id)->delete();
        return $Service;
    }
    public function resetServicePosition(Request $request){
        $data = $request->all();
        $new_arr = [];

        foreach($data as $item){
            Service::where('id',$item['id'])->update(['order_no'=>$item['order_no']]);
        }
        return 'updated successful';
    }
}
