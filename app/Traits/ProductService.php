<?php

namespace App\Traits;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\ActionLog;
use App\Models\MainProduct;
use App\Models\ProductVariationImage;

use Illuminate\Support\Facades\DB;

trait  ProductService {

    public function addNoVariationSingleProduct($input,$allImages,$user){

        $admin_id=$user->id;
        
        $input['stock']=$input['openingQuantity'];

        $created=Product::create($input);
        MainProduct::where('id',$created->mproductId)->update([
            'stock' =>  DB::raw("stock + $created->stock"),
        ]);

        // images upload
        foreach($allImages as $image){
            $imageOb = [
                'mproductId' => $created->mproductId,
                'productId' => $created->id,
                'url' => $image['url'],
            ];
            ProductVariationImage::create($imageOb);
        }
            
        //set barcode
        $barCode=$created->id;
        $data=array(
            'barCode' => $barCode,
            'averageBuyingPrice' => $input['openingUnitPrice']
        );
        $date=date("Y-m-d");
        Product::where('id',$created->id)->update($data);
        $purchase=Purchase::create([
            'admin_id' => $admin_id,
            'product_id' => $created->id,
            'quantity' => $input['openingQuantity'],
            'unitPrice' => $input['openingUnitPrice'],
            'date' => $date,
        ]);
        $actionLogData=[
            'user_id'=>$user->id,
            'content'=> $user->name." Created a new Variation Product ".$input['productName'],
            'item_id'=>$created->id,
            'action_type'=>'Created',
            'table_name'=>'products',
            'date'=>date('Y-m-d H:i:s'),
        ];
        ActionLog::create($actionLogData);


        // $settings=Product::where('id', $created->id)->with('group','category','brand')->first();
        return "Done";
    }
    
}