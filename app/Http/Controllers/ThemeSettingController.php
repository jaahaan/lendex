<?php

namespace App\Http\Controllers;

use App\Models\ThemeSetting;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class ThemeSettingController extends Controller
{
    public function getThemeSetting(){
        // return 'hello world';
        return ThemeSetting::first();
    }
    public function themeSettingUpdate(Request $request){
        $validator = Validator::make($request->all(),[
            'theme_colour'=>'required',
            'background_color'=>'required',
            'font_color'=>'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $data=[
            'theme_colour'=>$request->theme_colour,
            'background_color'=>$request->background_color,
            'font_color'=>$request->font_color
        ];
        return ThemeSetting::where('id',$request->id)->update($data);
    }
}
