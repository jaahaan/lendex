<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMe;
use Validator;

class ContactMeController extends Controller
{
    public function getContactMe(Request $request){
        $search = $request->search;
        $ContactMe =  ContactMe::select();
        if($search){
            $ContactMe->where(function($query) use ($search){
                $query->where('name',$search)->orwhere('email','LIKE',"%$search%");
            });
        }
        
        return $ContactMe->orderby('id','desc')->get();
        return ContactMe::get();
    }

    public function addContactMe(Request $request){
        $validator = Validator::make($request->all(),[
            'name' =>'required',
            'email' =>'required',
            'comment' =>'required',

        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $ContactMe = ContactMe::create($request->all());
        
        return $ContactMe;
    }
    public function deleteContactMe(Request $request){
        $ContactMe = ContactMe::where('id',$request->id)->delete();
        return $ContactMe;
    }
}

