<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SatisfiedClient;
use Validator;

class SatisfiedClientController extends Controller
{
    public function getSatisfiedClient(Request $request){
        $search = $request->search;
        $SatisfiedClient =  SatisfiedClient::select();
        if($search){
            $SatisfiedClient->where(function($query) use ($search){
                $query->where('name',$search)->orwhere('company','LIKE',"%$search%")->orwhere('rating','LIKE',"%$search%");
            });
        }
        
        return $SatisfiedClient->orderby('id','desc')->get();
        return SatisfiedClient::get();
    }

    public function addSatisfiedClient(Request $request){
        $validator = Validator::make($request->all(),[
            'company' =>'required',
            'name' => 'required',
            'designation' =>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $SatisfiedClient = SatisfiedClient::create($request->all());
        
        return $SatisfiedClient;
    }

    public function getSatisfiedClientDetail($id){
        return SatisfiedClient::where('id',$id)->first();
    }

    public function updateSatisfiedClient(Request $request){
        $validator = Validator::make($request->all(),[
            'company' =>'required',
            'name' => 'required',
            'designation' =>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $SatisfiedClient = SatisfiedClient::where('id',$request->id)->update($request->all());

        return $SatisfiedClient;
    }
    public function deleteSatisfiedClient(Request $request){
        $SatisfiedClient = SatisfiedClient::where('id',$request->id)->delete();
        return $SatisfiedClient;
    }
}

