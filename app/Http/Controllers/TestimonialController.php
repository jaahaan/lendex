<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Validator;

class TestimonialController extends Controller
{
    public function getTestimonial(Request $request){
        $search = $request->search;
        $Testimonial =  Testimonial::select();
        if($search){
            $Testimonial->where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%")->orwhere('company','LIKE',"%$search%")->orwhere('rating','LIKE',"%$search%");
            });
        }
        
        return $Testimonial->orderby('id','desc')->get();
    }

    public function addTestimonial(Request $request){
        $validator = Validator::make($request->all(),[
            'company' =>'required',
            'name' => 'required',
            'designation' =>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $Testimonial = Testimonial::create($request->all());
        
        return $Testimonial;
    }

    public function getTestimonialDetail($id){
        return Testimonial::where('id',$id)->first();
    }

    public function updateTestimonial(Request $request){
        $validator = Validator::make($request->all(),[
            'company' =>'required',
            'name' => 'required',
            'designation' =>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $Testimonial = Testimonial::where('id',$request->id)->update($request->all());

        return $Testimonial;
    }
    public function deleteTestimonial(Request $request){
        $Testimonial = Testimonial::where('id',$request->id)->delete();
        return $Testimonial;
    }
}
