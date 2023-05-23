<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ServiceTitle;
use App\Models\SpecialSkill;
use App\Models\StatisticsCount;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\TrustedCompany;
use App\Models\AboutMe;
use App\Models\ContactMe;
use Validator;

class HomeController extends Controller
{
    public function getUserInfo(Request $request){
        $data = User::first();
        $formattedData = [];
        unset($data['email_verified_at']);
        unset($data['isActive']);
        unset($data['passwordToken']);
        unset($data['expired_at']);
        unset($data['updated_at']);
        unset($data['created_at']);
        array_push($formattedData, $data);
        return $formattedData;

        // return response()->json([
        //     'success'=> true,
        //     'data'=>$formattedData,
        // ],200);
    }
    public function downloadAttachment(Request $request, $url){
        return response()->download(public_path('attachments/'. $url));
    }
    public function getServices(Request $request){
        $data = ServiceTitle::with('points')->orderBy('order_no', 'asc')->get();
        $formattedData = [];
        foreach($data as $value){
            unset($value['updated_at']);
            unset($value['created_at']);
            array_push($formattedData, $value);
        }
        return $formattedData;
        // return response()->json([
        //     'success'=> true,
        //     'data'=>$formattedData,
        // ],200);
    }

    public function getSpecialSkills(Request $request){
        $data = SpecialSkill::orderBy('order_no', 'asc')->get();
        $formattedData = [];
        foreach($data as $value){
            unset($value['updated_at']);
            unset($value['created_at']);
            array_push($formattedData, $value);
        }
        return $formattedData;
    }

    public function getStatisticsCount(Request $request){
        $data = StatisticsCount::first();
        $formattedData = [];
        $formattedData = [];
        unset($data['updated_at']);
        unset($data['created_at']);
        array_push($formattedData, $data);
        return $formattedData;
    }

    public function getProjects(Request $request){
        $data = Project::orderBy('id', 'desc')->get();
        $formattedData = [];
        foreach($data as $value){
            unset($value['description']);
            unset($value['clients']);
            unset($value['duration']);
            unset($value['date']);
            unset($value['updated_at']);
            unset($value['created_at']);
            array_push($formattedData, $value);
        }
        return $formattedData;
    }
    public function getProjectDetails(Request $request, $id){
        $data = Project::where('id', $id)->first();
        
        return $data;
    }

    public function getTestimonials(Request $request){
        $data = Testimonial::orderBy('id', 'desc')->get();
        $formattedData = [];
        foreach($data as $value){
            unset($value['updated_at']);
            unset($value['created_at']);
            array_push($formattedData, $value);
        }
        return $formattedData;
    }

    public function getTrustedCompanies(Request $request){
        $data = TrustedCompany::orderBy('id', 'desc')->get();
        $formattedData = [];
        foreach($data as $value){
            unset($value['updated_at']);
            unset($value['created_at']);
            array_push($formattedData, $value);
        }
        return $formattedData;
    }

    public function getEducations(Request $request){
        $data = AboutMe::where('type', 'education')->orderBy('start_date', 'desc')->get();
        $formattedData = [];
        foreach($data as $value){
            unset($value['updated_at']);
            unset($value['created_at']);
            array_push($formattedData, $value);
        }
        return $formattedData;
    }
    public function getExperiences(Request $request){
        $data = AboutMe::where('type', 'experience')->orderBy('start_date', 'desc')->get();
        $formattedData = [];
        foreach($data as $value){
            unset($value['updated_at']);
            unset($value['created_at']);
            array_push($formattedData, $value);
        }
        return $formattedData;
    }

    public function addContactMe(Request $request){
        $validator = Validator::make($request->all(),
        [
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $data = ContactMe::create($request->all());
        
        return $data;
    }
}

