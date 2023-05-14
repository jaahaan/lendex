<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutMe;
use Validator;

class AboutMeController extends Controller
{
    public function getEducation(Request $request){
        $search = $request->search;
        $Education =  AboutMe::where('type', 'education')->select();
        if($search){
            $Education->where(function($query) use ($search){
                $query->where('institute','LIKE',"%$search%")->orWhere('degree','LIKE',"%$search%")->orWhere('fieldOfStudy','LIKE',"%$search%");
            });
        }
        
        return $Education->orderby('start_date','desc')->get();
    }
    public function getExperience(Request $request){
        $search = $request->search;
        $Experience =  AboutMe::where('type', 'experience')->select();
        if($search){
            $Experience->where(function($query) use ($search){
                $query->where('institute','LIKE',"%$search%")->orwhere('degree','LIKE',"%$search%");
            });
        }
        
        return $Experience->orderby('start_date','desc')->get();
    }
    public function addAboutMe(Request $request){
        $validator = Validator::make($request->all(),[
            'institute' =>'required',
            'degree' =>'required',
            'start_date' =>'required',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $data = AboutMe::create($request->all());
        
        return $data;
    }

    public function getAboutMeDetail($id){
        return AboutMe::where('id',$id)->first();
    }

    public function updateAboutMe(Request $request){
        $validator = Validator::make($request->all(),[
            'institute' =>'required',
            'degree' =>'required',
            'start_date' =>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $data = AboutMe::where('id',$request->id)->update($request->all());

        return $data;
    }
    public function deleteAboutMe(Request $request){
        $data = AboutMe::where('id',$request->id)->delete();
        return $data;
    }
}
