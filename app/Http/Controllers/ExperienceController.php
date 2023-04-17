<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;
use Validator;

class ExperienceController extends Controller
{
    public function getExperience(Request $request){
        $search = $request->search;
        $Experience =  Experience::select();
        if($search){
            $Experience->where(function($query) use ($search){
                $query->where('institute',$search)->orwhere('degree','LIKE',"%$search%")->orwhere('fieldOfStudy','LIKE',"%$search%");
            });
        }
        
        return $Experience->orderby('start_date','desc')->get();
        return Experience::get();
    }

    public function addExperience(Request $request){
        $validator = Validator::make($request->all(),[
            'company' =>'required',
            'designation' =>'required',
            'start_date' =>'required',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $Experience = Experience::create($request->all());
        
        return $Experience;
    }

    public function getExperienceDetail($id){
        return Experience::where('id',$id)->first();
    }

    public function updateExperience(Request $request){
        $validator = Validator::make($request->all(),[
            'company' =>'required',
            'designation' =>'required',
            'start_date' =>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $Experience = Experience::where('id',$request->id)->update($request->all());

        return $Experience;
    }
    public function deleteExperience(Request $request){
        $Experience = Experience::where('id',$request->id)->delete();
        return $Experience;
    }
}
