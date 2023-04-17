<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicePlaning;
use Illuminate\Support\Facades\Validator;

class ServicePlaningController extends Controller
{
    public function getServicePlaning(Request $request){
        $search = $request->search;
        $id = $request->id;
        $ServicePlaning =  ServicePlaning::with('service')->select();
        if($search){
            $ServicePlaning->where(function($query) use ($search){
                $query->where('service_id',$search)->orwhere('type','LIKE',"%$search%");
            });
        }
        
        $data =  $ServicePlaning->orderby('id','desc')->get();

        $formattedData = [];
        foreach($data as $value){
            
            $value['title'] = $value->service->title;
            
            unset($value['service']);
            
            array_push($formattedData, $value);
            
        }
        
        return $formattedData;
    }
    public function addServicePlaning(Request $request){
        $validator = Validator::make($request->all(),[
            'service_id' =>'required',
            'type' =>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $ServicePlaning = ServicePlaning::create($request->all());
        
        return $ServicePlaning;
    }

    public function getServicePlaningDetail($id){
        return ServicePlaning::where('id',$id)->first();
    }

    public function updateServicePlaning(Request $request){
        $validator = Validator::make($request->all(),[
            'service_id' =>'required',
            'type' =>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $ServicePlaning = ServicePlaning::where('id',$request->id)->update($request->all());

        return $ServicePlaning;
    }
    public function deleteServicePlaning(Request $request){
        $ServicePlaning = ServicePlaning::where('id',$request->id)->delete();
        return $ServicePlaning;
    }
}
