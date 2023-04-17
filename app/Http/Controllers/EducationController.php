<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;
use Validator;

class EducationController extends Controller
{
    public function getEducation(Request $request){
        $search = $request->search;
        $Education =  Education::select();
        if($search){
            $Education->where(function($query) use ($search){
                $query->where('institute',$search)->orwhere('degree','LIKE',"%$search%")->orwhere('fieldOfStudy','LIKE',"%$search%");
            });
        }
        
        return $Education->orderby('start_date','desc')->get();
        return Education::get();
    }

    public function addEducation(Request $request){
        $validator = Validator::make($request->all(),[
            'institute' =>'required',
            'degree' =>'required',
            'start_date' =>'required',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $Education = Education::create($request->all());
        
        return $Education;
    }

    public function getEducationDetail($id){
        return Education::where('id',$id)->first();
    }

    public function updateEducation(Request $request){
        $validator = Validator::make($request->all(),[
            'institute' =>'required',
            'degree' =>'required',
            'start_date' =>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $Education = Education::where('id',$request->id)->update($request->all());

        return $Education;
    }
    public function deleteEducation(Request $request){
        $Education = Education::where('id',$request->id)->delete();
        return $Education;
    }
}
