<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function getBlog(Request $request){
        $search = $request->search;
        $id = $request->id;
        $Blog =  Blog::select();
        if($search){
            $Blog->where(function($query) use ($search){
                $query->where('title',$search)->orwhere('subtitle','LIKE',"%$search%")->orwhere('projectName','LIKE',"%$search%");
            });
        }
        
        return $Blog->orderby('id','desc')->get();
        return Blog::get();
    }
    public function addBlog(Request $request){
        $validator = Validator::make($request->all(),[
            'image' => 'required',
            'title' =>'required',
            'subtitle' =>'required',
            'projectName' =>'required',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $Blog = Blog::create($request->all());
        
        return $Blog;
    }

    public function getBlogDetail($id){
        return Blog::where('id',$id)->first();
    }

    public function updateBlog(Request $request){
        $validator = Validator::make($request->all(),[
            'title' =>'required',
            'subtitle' =>'required',
            'projectName' =>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $Blog = Blog::where('id',$request->id)->update($request->all());

        return $Blog;
    }
    public function deleteBlog(Request $request){
        $Blog = Blog::where('id',$request->id)->delete();
        return $Blog;
    }
}
