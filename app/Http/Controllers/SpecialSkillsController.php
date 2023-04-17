<?php

namespace App\Http\Controllers;
use App\Models\SpecialSkill;

use Illuminate\Http\Request;
use Validator;
class SpecialSkillsController extends Controller
{
    public function getSkills(Request $request){
        
        $search = $request->search;
        $SpecialSkill =  SpecialSkill::select('id','title','percentage','order_no');
        if($search){
            $SpecialSkill->where(function($query) use ($search){
                $query->where('title','LIKE',"%$search%");
            });
        }
        
        return $SpecialSkill->orderby('order_no','asc')->get();

    }
    public function addSkill(Request $request){
        $validator = Validator::make($request->all(),[
            'title' =>'required',
            'percentage' =>'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $SpecialSkill = SpecialSkill::create($request->all());
        $data = SpecialSkill::where('id',$SpecialSkill->id)->update([
            'order_no' => $SpecialSkill->id,
        ]);
        return $SpecialSkill;
    }
    public function deleteSkill(Request $request){
        
        $data = SpecialSkill::where('id',$request->id)->delete();
        return $data;
    }
    public function getSkillDetail($id){
        return SpecialSkill::where('id',$id)->first();
    }
    public function updateSkill(Request $request){
        $validator = Validator::make($request->all(),[
            'title' =>'required',
            'percentage' =>'required',
        ]);
        $data = SpecialSkill::where('id',$request->id)->update($request->all());
        return $data;
    }

    public function resetSkillPosition(Request $request){
        $data = $request->all();
        $new_arr = [];

        foreach($data as $item){
            SpecialSkill::where('id',$item['id'])->update(['order_no'=>$item['order_no']]);
        }
        return 'updated successful';
    }
}
