<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function getProject(Request $request){
        $search = $request->search;
        $id = $request->id;
        $Project =  Project::select();
        if($search){
            $Project->where(function($query) use ($search){
                $query->where('title',$search)->orwhere('subtitle','LIKE',"%$search%")->orwhere('projectName','LIKE',"%$search%");
            });
        }
        
        return $Project->orderby('id','desc')->get();
        return Project::get();
    }
    public function addProject(Request $request){
        $validator = Validator::make($request->all(),[
            'image' => 'required',
            'title' =>'required',
            'subtitle' =>'required',
            'projectName' =>'required',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $Project = Project::create($request->all());
        
        return $Project;
    }

    public function getProjectDetail($id){
        return Project::where('id',$id)->first();
    }

    public function updateProject(Request $request){
        $validator = Validator::make($request->all(),[
            'title' =>'required',
            'subtitle' =>'required',
            'projectName' =>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $Project = Project::where('id',$request->id)->update($request->all());

        return $Project;
    }
    public function deleteProject(Request $request){
        $Project = Project::where('id',$request->id)->delete();
        return $Project;
    }
}
