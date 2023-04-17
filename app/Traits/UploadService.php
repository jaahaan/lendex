<?php

namespace App\Traits;
use App\Models\ActionLog;
use App\Models\TemporaryFile;

trait  UploadService {

    public function checkUploadFile($url,$table,$property,$item_id = 0,$scan=0){

        $image = TemporaryFile::where('full_url',$url)->first();
        if($image){
            $prevImage = TemporaryFile::where('table_name',$table)->where('property_name',$property)->where('location','!=',$image->location)->where('item_id',$item_id)->first();
            if($prevImage){
                if(file_exists(public_path().$prevImage->location)) unlink(public_path().$prevImage->location);
                TemporaryFile::where('id',$prevImage->id)->delete();
            }
            TemporaryFile::where('id',$image->id)->update([
                'table_name' => $table,
                'item_id' => $item_id,
                'property_name' => $property,
                'is_used' => 1,
            ]);
        }
        if($scan == 1){
            $files = TemporaryFile::where('is_used',0)->get();

            foreach($files as $file){
                if(file_exists(public_path().$file->location))  unlink(public_path().$file->location);
                TemporaryFile::where('id',$file->id)->delete();
            }
        }

        return true;
    }
    public function checkProductUploadFile($item_id,$url,$table,$property,$scan=0){

        $image = TemporaryFile::where('full_url',$url)->first();
        if($image){
            $prevImage = TemporaryFile::where('table_name',$table)->where('item_id',$item_id)->where('property_name',$property)->where('location','!=',$image->location)->first();
            if($prevImage){
                if(file_exists(public_path().$prevImage->location))  unlink(public_path().$prevImage->location);
                TemporaryFile::where('id',$prevImage->id)->delete();
            }
            TemporaryFile::where('id',$image->id)->update([
                'table_name' => $table,
                'item_id' => $item_id,
                'property_name' => $property,
                'is_used' => 1,
            ]);
        }
        if($scan == 1){
            $files = TemporaryFile::where('is_used',0)->get();

            foreach($files as $file){
                if(file_exists(public_path().$file->location)) unlink(public_path().$file->location);
                TemporaryFile::where('id',$file->id)->delete();
            }
        }

        return true;
    }
    public function removeProductUploadFile($item_id,$url,$table){

        $file = TemporaryFile::where('table_name',$table)->where('item_id',$item_id)->where('full_url',$url)->first();
        if($file){

            if(file_exists(public_path().$file->location)) unlink(public_path().$file->location);
            TemporaryFile::where('id',$file->id)->delete();
        }
        else {
            \Log::info('item_id: '.$item_id);
            \Log::info('url: '.$url);
            \Log::info('table: '.$table);
        }


        return true;
    }

}
