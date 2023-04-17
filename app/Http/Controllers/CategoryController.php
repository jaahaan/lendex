<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ActionLog;
use Auth;
class CategoryController extends Controller
{
    // public function index(){
    //     $category=Category::with('group')
    //     ->orderBy('catName', 'asc')
    //     ->get();

    //     return $category;
    // }
    public function categoryFiltered($id){
        $category=Category::where('group_id', $id)
        ->with('group')
        ->orderBy('catName', 'asc')
        ->get();

        return $category;
    }
    public function create(){

    }
    // public function store(Request $request){
    //     $request->validate([
    //         'catName' => 'required|string|max:255|unique:categories',
    //     ]);
    //     date_default_timezone_set('Asia/Dhaka');
    //     $created=Category::create($request->all());
    //     $settings=Category::where('id', $created->id)->with('group')->first();
    //     return $settings;
    // }
    public function show($id){
        //
    }
    public function edit($id){
        //
    }
    public function update(Request $request, $id){
        // $request->validate([
        //     'catName' => 'required|string|max:255|unique:categories',
        // ]);
        Category::where('id',$request->id)->update($request->all());
        $category=Category::where('id',$request->id)->with('group')->first();
        return $category;
    }
    // public function categoryUpdate(Request $request){
    //     // $request->validate([
    //     //     'catName' => 'required|string|max:255|unique:categories',
    //     // ]);
    //     Category::where('id',$request->id)->update($request->all());
    //     return $category=Category::where('id',$request->id)->with('group')->first();
    //     // return $category;
    // }
    // public function destroy($id)
    // {
    //     $group = Category::where('id','=',$id)
    //       ->first();
    //       if($group->count()){
    //         $group->delete();
    //         return response()->json(['msg'=>'success','status'=>$id]);
    //       } else {
    //         return response()->json(['msg'=>'error','status'=>$id]);
    //       }
    // }


    // Featured SubCategory
    public function show_featuredSubcategory(){
        $category=Category::with('group')->where('isFeatured',1)
        ->orderBy('catName', 'asc')
        ->get();

        return $category;
    }
    public function search_featuredSubcategory(Request $request){
        $category=Category::with('group')->where('isFeatured',0)->where('catName','like',"%$request->str%")
        ->orderBy('catName', 'asc')->limit(10)
        ->get();

        return $category;
    }

    public function update_featuredSubcategory(Request $request){
        Category::where('id',$request->new_id)->update([
            'isFeatured' =>1
        ]);
        $actionLogData=[
            'user_id'=>Auth::user()->id,
            'content'=> Auth::user()->name." Updated a Featured Subcategory",
            'item_id'=>$request->new_id,
            'action_type'=>'Updated',
            'table_name'=>'categories',
            'date'=>date('Y-m-d H:i:s'),
        ];
        ActionLog::create($actionLogData);
        return Category::where('id',$request->old_id)->update([
            'isFeatured' => 0
        ]);
        // return $category;
    }



    // Menu Featured SubCategory
    public function menu_show_featuredSubcategory($id){
        $category=Category::with('group')->where('menuId',$id)->where('isMenuFeatured',1)
        ->orderBy('catName', 'asc')
        ->get();

        return $category;
    }
    public function menu_search_featuredSubcategory(Request $request,$id){
        $category=Category::with('group')->where('menuId',$id)->where('isMenuFeatured',0)->where('catName','like',"%$request->str%")
        ->orderBy('catName', 'asc')->limit(10)
        ->get();

        return $category;
    }

    public function menu_update_featuredSubcategory(Request $request){
        Category::where('id',$request->new_id)->update([
            'isMenuFeatured' =>1
        ]);
        $actionLogData=[
            'user_id'=>Auth::user()->id,
            'content'=> Auth::user()->name." Updated a Menu Featured Subcategory",
            'item_id'=>$request->new_id,
            'action_type'=>'Updated',
            'table_name'=>'categories',
            'date'=>date('Y-m-d H:i:s'),
        ];
        ActionLog::create($actionLogData);
        return Category::where('id',$request->old_id)->update([
            'isMenuFeatured' => 0
        ]);
        // return $category;
    }
}
