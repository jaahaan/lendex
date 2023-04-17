<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Stroage;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class HomeController extends Controller
{
    public function getUser(Request $request){
        $user = User::where('id', Auth::user()->id)->first();
        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }
    public function updateInfo(Request $request){
        $user = User::where('id',Auth::user()->id)->update($request->all());
        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    
    // //upload attachment
    // public function uploadAttachment(Request $request)
    // {
    //     // $this->validate($request, [
    //     //     'file' => 'required|mimes:jpeg,jpg,png,pdf,pptx',
    //     // ]);
    //     // $fileName = time() . '.' . $request->file->extension();
    //     $fileName = time() . '_' . $request->file->getClientOriginalName();
    //     $request->file->move('attachments', $fileName);
    //     return $fileName;
    // }

    // public function deleteAttachment(Request $request)
    // {
    //     $fileName = $request->Name;
    //     \Log::info($fileName);
    //     $this->deleteFileFromServer($fileName, false);
    //     return 'done';
    // }
    // public function deleteFileFromServer($fileName, $hasFullPath = false)
    // {
    //     if (!$hasFullPath) {
    //         $filePath = public_path('attachments') .'\\'. $fileName;
    //         \Log::info($filePath);
    //     }
    //     if (file_exists($filePath)) {
    //         @unlink($filePath);
    //     }
    //     return;
    // }
    //image upload
    public function upload(Request $request)
    {
        // $this->validate($request, [
        //     'file' => 'required|mimes:jpeg,jpg,png',
        // ]);
        // $fileName = time() . '_' . $request->file->getClientOriginalName();
        // $request->file->move('images', $fileName);
        // return $fileName;
        $fileName = time() . '_' . $request->file->getClientOriginalName();
        $request->file->move('attachments', $fileName);
        return $fileName;
    }
    public function deleteImage(Request $request)
    {
        $fileName = $request->imageName;
        $this->deleteImageFromServer($fileName, false);
        return 'done';
    }
    public function deleteImageFromServer($fileName, $hasFullPath = false)
    {
        if (!$hasFullPath) {
            $filePath = public_path('attachments') .'\\'. $fileName;
            \Log::info($filePath);
        }
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
        return;
    }
}
