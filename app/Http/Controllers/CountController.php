<?php

namespace App\Http\Controllers;
use App\Models\Count;
use Validator;
use Illuminate\Http\Request;

class CountController extends Controller
{
    public function getCount(Request $request){
        $search = $request->search;
        $Count =  Count::select();
        if($search){
            $Count->where(function($query) use ($search){
                $query->where('institute',$search)->orwhere('degree','LIKE',"%$search%")->orwhere('fieldOfStudy','LIKE',"%$search%");
            });
        }
        
        return $Count->get();
        return Count::get();
    }

    public function addCount(Request $request){
        
        $Count = Count::where('id',$request->id)->update($request->all());
        
        $Count = Count::create($request->all());
        
        return $Count;
    }

    public function getCountDetail($id){
        return Count::where('id',$id)->first();
    }

    public function updateCount(Request $request){
        
        $Count = Count::where('id',$request->id)->update($request->all());

        return $Count;
    }
    public function deleteCount(Request $request){
        $Count = Count::where('id',$request->id)->delete();
        return $Count;
    }
}
