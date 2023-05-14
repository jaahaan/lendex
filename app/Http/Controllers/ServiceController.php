<?php

namespace App\Http\Controllers;
use App\Models\ServiceTitle;
use App\Models\ServicePoint;

use Illuminate\Http\Request;
use Validator;

class ServiceController extends Controller
{
    public function getServiceTitle(Request $request){
        
        $search = $request->search;
        $ServiceTitle =  ServiceTitle::select();
        if($search){
            $ServiceTitle->where(function($query) use ($search){
                $query->where('title','LIKE',"%$search%");
            });
        }
        
        return $ServiceTitle->orderby('order_no','asc')->get();

    }
    public function addServiceTitle(Request $request){
        $validator = Validator::make($request->all(),[
            'icon' =>'required',
            'title' =>'required',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $ServiceTitle = ServiceTitle::create($request->all());
        $data = ServiceTitle::where('id',$ServiceTitle->id)->update([
            'order_no' => $ServiceTitle->id,
        ]);
        return $ServiceTitle;
    }
    public function deleteServiceTitle(Request $request){
        
        $data = ServiceTitle::where('id',$request->id)->delete();
        return $data;
    }
    public function getServiceTitleDetail($id){
        return ServiceTitle::where('id',$id)->first();
    }
    public function updateServiceTitle(Request $request){
        $validator = Validator::make($request->all(),[
            'icon' =>'required',
            'title' =>'required',
        ]);
        $data = ServiceTitle::where('id',$request->id)->update($request->all());
        return $data;
    }

    public function resetServiceTitlePosition(Request $request){
        $data = $request->all();
        $new_arr = [];

        foreach($data as $item){
            ServiceTitle::where('id',$item['id'])->update(['order_no'=>$item['order_no']]);
        }
        return 'updated successful';
    }



    public function getServicePoint(Request $request){
        
        $search = $request->search;
        $ServicePoint =  ServicePoint::with('title');
        if($search){
            $ServicePoint->where(function($query) use ($search){
                $query->where('point','LIKE',"%$search%");
            });
        }
        
        return $ServicePoint->orderby('order_no','asc')->get();

    }
    public function addServicePoint(Request $request){
        $validator = Validator::make($request->all(),[
            'point' =>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $ServicePoint = ServicePoint::create($request->all());
        $data = ServicePoint::where('id',$ServicePoint->id)->update([
            'order_no' => $ServicePoint->id,
        ]);
        return $ServicePoint;
    }
    public function deleteServicePoint(Request $request){
        
        $data = ServicePoint::where('id',$request->id)->delete();
        return $data;
    }
    public function getServicePointDetail($id){
        return ServicePoint::where('id',$id)->first();
    }
    public function updateServicePoint(Request $request){
        $validator = Validator::make($request->all(),[
            'point' =>'required',
        ]);
        $data = ServicePoint::where('id',$request->id)->update($request->all());
        return $data;
    }

    public function resetServicePointPosition(Request $request){
        $data = $request->all();
        $new_arr = [];

        foreach($data as $item){
            ServicePoint::where('id',$item['id'])->update(['order_no'=>$item['order_no']]);
        }
        return 'updated successful';
    }
}
