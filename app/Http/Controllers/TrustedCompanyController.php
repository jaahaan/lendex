<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrustedCompany;

class TrustedCompanyController extends Controller
{
    public function getTrustedCompany(Request $request){
        $search = $request->search;
        $id = $request->id;
        $TrustedCompany =  TrustedCompany::select();
        
        return $TrustedCompany->orderby('id','desc')->get();
    }
    public function addTrustedCompany(Request $request){
        
        $TrustedCompany = TrustedCompany::create($request->all());
        
        return $TrustedCompany;
    }

    public function getTrustedCompanyDetail($id){
        return TrustedCompany::where('id',$id)->first();
    }

    public function updateTrustedCompany(Request $request){
        
        $TrustedCompany = TrustedCompany::where('id',$request->id)->update($request->all());

        return $TrustedCompany;
    }
    public function deleteTrustedCompany(Request $request){
        $TrustedCompany = TrustedCompany::where('id',$request->id)->delete();
        return $TrustedCompany;
    }
}
