<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatisticsCount;
use Validator;

class StatisticsCountController extends Controller
{
    public function getStatisticsCount(Request $request){
        return StatisticsCount::get();
    }

    public function addStatisticsCount(Request $request){
        $StatisticsCount = StatisticsCount::where('id',$request->id)->update($request->all());
        $StatisticsCount = StatisticsCount::create($request->all());
        return $StatisticsCount;
    }

    public function getStatisticsCountDetail($id){
        return StatisticsCount::where('id',$id)->first();
    }

    public function updateStatisticsCount(Request $request){
        
        $StatisticsCount = StatisticsCount::where('id',$request->id)->update($request->all());

        return $StatisticsCount;
    }
    public function deleteStatisticsCount(Request $request){
        $StatisticsCount = StatisticsCount::where('id',$request->id)->delete();
        return $StatisticsCount;
    }
}
