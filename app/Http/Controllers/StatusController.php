<?php

namespace App\Http\Controllers;

use Auth;
use RuntimeException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image as Image;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

use App\Models\Tag;
use App\Models\User;
use App\Models\Brand;
use App\Models\Status;
use App\Models\Setting;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Category;
use App\Models\ProductTag;
use App\Models\MainProduct;
use App\Models\ProductImage;
use App\Models\TemporaryFile;
use App\Models\ProductVariation;
use App\Models\ProductVariationValues;
use App\Models\ActionLog;
class StatusController extends Controller
{
    public function index(){
        \Log::info("from index status");
      $data = Setting::where('id',1)->first();
      $user_id = Auth::user()->id;
      $user = User::where('id',$user_id)->with('role')->first();
      return view('welcome', ['setting' => $data,'user' => $user]);
    }
    public function login(){
        if(Auth::check() == false ) return view('auth.login');
        else return redirect('/');
    }
    public function password(){
       return Hash::make('123456');
    }
    public function showStatus(){
      return Status::all();
    }
    public function storeStaus(Request $request){
      $data = [
         ['name' => 'Order Places'],
         ['name' => 'Processing'],
         ['name' => 'Preparing for ship'],
         ['name' => 'Shipped'],
         ['name' => 'Delivered'],
         ['name' => 'Canceled'],
      ];
      \Log::info($data);
      return Status::insert($data);
    }
    public function addStatus (Request $request){
     $data = $request->all();
     $status = Status::create($data);
     $actionLogData=[
        'user_id'=>Auth::user()->id,
        'content'=> Auth::user()->name." Created a new Status ".$status->name,
        'item_id'=>$status->id,
        'action_type'=>'Created',
        'table_name'=>'statuses',
        'date'=>date('Y-m-d H:i:s'),
    ];
    ActionLog::create($actionLogData);
     date_default_timezone_set('Asia/Dhaka');
      return $status;
    }
     public function updateStatus(Request $request , $id){
        $data = $request->all();
        $actionLogData=[
            'user_id'=>Auth::user()->id,
            'content'=> Auth::user()->name." Updated a Status ".$data['name'],
            'item_id'=>$id,
            'action_type'=>'Updated',
            'table_name'=>'statuses',
            'date'=>date('Y-m-d H:i:s'),
        ];
        ActionLog::create($actionLogData);
        return Status::where('id',$request->id)->update($request->all());
   }
   public function deleteStatus(Request $request,$id){
        $data = $request->all();
        $actionLogData=[
            'user_id'=>Auth::user()->id,
            'content'=> Auth::user()->name." Deleted a Status ".$data['name'],
            'item_id'=>$id,
            'action_type'=>'Deleted',
            'table_name'=>'statuses',
            'date'=>date('Y-m-d H:i:s'),
        ];
        ActionLog::create($actionLogData);
        return Status::where('id',$id)->delete();
   }
   public function ims1(Request $request,$id){

        // $path = 'https://finesse.dreamsgallerybd.com/uploads/XjTqTmnVmO6qdxMQVztUibNXlwmtmmMZ8ns3Q5q6.jpg';
        // $filename = basename($path);
        // Image::make($path)->resize(800, 800, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save(public_path('uploads/' . $filename));

        // return $filename;


        $baseUrl = env('APP_URL');
        $data = Http::get('https://finesseapi.dreamsgallerybd.com/app/ims/2');
        $allMainProducts = json_decode(($data));
        $AllMainProductsData = [];


        foreach ($allMainProducts as  $mainProduct) {
            // $mainProduct= $allMainProducts;
            $allOldImages = ($mainProduct->images)? json_decode($mainProduct->images) : [];
            $subcategory = Category::where('catName',$mainProduct->allcategory->catName)->first();
            $brand = Brand::where('name',$mainProduct->allbrand->name)->first();

            $path = $mainProduct->productImage;
            $thumnailImg = basename($path);
            Image::make($path)->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('thumbnail/' . $thumnailImg));

            $productImage= "$baseUrl/thumbnail/$thumnailImg";











            $mainProductOb = [
                'menuId'=> $subcategory->menuId,
                'groupId'=> $subcategory->group_id,
                'categoryId'=> $subcategory->id,
                'brandId'=> $brand->id,
                'productName'=> $mainProduct->productName,
                'model'=> $mainProduct->model,
                'description'=> json_decode($mainProduct->description),
                'brief_description'=> $mainProduct->brief_description ? $mainProduct->brief_description :'<p>Here Goes Product Description</p>',
                'sellingPrice'=> $mainProduct->sellingPrice,
                'averageBuyingPrice'=> 0,
                'productImage'=> $productImage,
                'images'=> null,

                'created_at'=>now(),
                'updated_at'=>now(),
            ];
            if(sizeof($mainProduct->variationproducts)>0){
                $mainProductOb['unit']= $mainProduct->variationproducts[0]->unit;
            }
            // array_push($AllMainProductsData,$mainProductOb);
            $createdProduct = MainProduct::create($mainProductOb);
            TemporaryFile::create([
                'full_url'=> $productImage,
                'location' =>"/thumbnail/$thumnailImg",
                'table_name' => 'main_products',
                'property_name' => 'productImage',
                'is_used' => 1,
                'item_id' => $createdProduct->id,
            ]);

            $mainImg = basename($path);
            Image::make($path)->save(public_path('uploads/' . $mainImg));
            $mainImgUrl= "$baseUrl/uploads/$mainImg";
            $mainImgOb = [
                'productId' => $createdProduct->id,
                'url' => $mainImgUrl
            ];
            $created_image = ProductImage::create($mainImgOb);
            TemporaryFile::create([
                'full_url'=> $mainImgUrl,
                'location' =>"/upload/$mainImg",
                'table_name' => 'product_images',
                'property_name' => 'url',
                'is_used' => 1,
                'item_id' => $created_image->id,
            ]);
            // $allOldImages = json_decode($mainProduct->images);
            if(sizeof($allOldImages)>0){
                foreach ($allOldImages as $img) {
                    $path = $img->url;
                    $mainImg = basename($path);
                    Image::make($path)->save(public_path('uploads/' . $mainImg));
                    $mainImgUrl= "$baseUrl/uploads/$mainImg";
                    $ob = [
                        'productId' => $createdProduct->id,
                        'url' => $mainImgUrl
                    ];
                    $created_image = ProductImage::create($ob);
                    TemporaryFile::create([
                        'full_url'=> $mainImgUrl,
                        'location' =>"/uploads/$mainImg",
                        'table_name' => 'product_images',
                        'property_name' => 'url',
                        'is_used' => 1,
                        'item_id' => $created_image->id,
                    ]);
                }
            }
            if(sizeof($mainProduct->variationproducts)>0){


                foreach($mainProduct->variationproducts as $variationproduct){
                    $variations = json_decode($variationproduct->variation);
                    $variationproductOb= [
                        'menuId'=> $subcategory->menuId,
                        'groupId'=> $subcategory->group_id,
                        'categoryId'=> $subcategory->id,
                        'brandId'=> $brand->id,
                        'mproductId'=> $createdProduct->id,
                        'productName'=> $variationproduct->productName,
                        'model'=> $variationproduct->model,
                        'unit'=> $variationproduct->unit,
                        'variation'=> $variations,

                        'sellingPrice'=> $variationproduct->sellingPrice,
                        'averageBuyingPrice'=> $variationproduct->averageBuyingPrice,

                        'productImage'=> null,
                        'images'=> null,

                        'date'=>now(),
                        'created_at'=>now(),
                        'updated_at'=>now(),
                    ];

                    $product = Product::create($variationproductOb);

                    foreach ($variations as $key => $value) {
                        $pvariation = ProductVariation::firstOrCreate([
                            'mproductId'=> $createdProduct->id,
                            'name'=> $key,
                        ]);
                        ProductVariationValues::firstOrCreate([
                            'mproductId'=> $createdProduct->id,
                            'pvariationId'=> $pvariation->id,
                            // 'productId'=> $product->id,
                            'name'=> $pvariation->name,
                            'value'=> $value,
                        ]);
                    }



                }
            }



            if(sizeof($mainProduct->tags)>0){
                foreach($mainProduct->tags as $tagValue){
                    $tagName = $tagValue->tag->name;
                    $tagModel = Tag::firstOrCreate(['name'=>$tagName]);
                    $tagOb= [
                        'tagId'=>$tagModel->id,
                        'productId'=>$createdProduct->id
                    ];
                    ProductTag::create($tagOb);

                }
            }
        }


        // return MainProduct::where('id','>',0)->with(['products'=>function($query){
        //     $query->select('id','mproductId','productName','variation');
        // }])->with('variations.values','productImages')->first();
        return MainProduct::where('id','>',0)->count();
   }
   public function boarcodeUpdate(Request $request){

        // $path = 'https://finesse.dreamsgallerybd.com/uploads/XjTqTmnVmO6qdxMQVztUibNXlwmtmmMZ8ns3Q5q6.jpg';
        // $filename = basename($path);
        // Image::make($path)->resize(800, 800, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save(public_path('uploads/' . $filename));

        // return $filename;


        $baseUrl = env('APP_URL');
        $data = Http::get('https://finesseapi.dreamsgallerybd.com/app/ims/2');
        $allMainProducts = json_decode(($data));
        $AllMainProductsData = [];


        foreach ($allMainProducts as  $mainProduct) {



            if(sizeof($mainProduct->variationproducts)>0){


                foreach($mainProduct->variationproducts as $variationproduct){
                    $variations = json_decode($variationproduct->variation);


                     Product::where([
                        'productName'=> $variationproduct->productName,
                        'model'=> $variationproduct->model,
                        'variation'=> $variationproduct->variation,
                    ])->update([
                        'barCode'=> $variationproduct->barCode
                    ]);





                }
            }
        }


        // return MainProduct::where('id','>',0)->with(['products'=>function($query){
        //     $query->select('id','mproductId','productName','variation');
        // }])->with('variations.values','productImages')->first();
        return MainProduct::where('id','>',0)->count();
   }
   public function addDgCustomer(Request $request){

        $data = Http::get('https://dreamsgallerybd.com/app/get/customer/all');
        $allMainCustomer = json_decode(($data));
        // return $allMainCustomer;
        $AllMainProductsData = [];


        foreach ($allMainCustomer as  $customerValue) {



            Customer::create([
                 'customerName'=> $customerValue->customerName ,
                 'address'=> $customerValue->address ,
                 'contact'=> $customerValue->contact ,
                'email'=> $customerValue->email ,
                 'zone'=> $customerValue->zone ,
                'barcode'=> $customerValue->barcode ,
                'cityId'=> $customerValue->cityId ,
                'areaId'=> $customerValue->areaId ,
                'zoneId'=> $customerValue->zoneId ,
                'facebook'=> $customerValue->facebook ,
                'instagram'=> $customerValue->instagram ,
                'postCode'=> $customerValue->postCode ,
            ]);
        }


        // return MainProduct::where('id','>',0)->with(['products'=>function($query){
        //     $query->select('id','mproductId','productName','variation');
        // }])->with('variations.values','productImages')->first();
        return Customer::where('id','>',0)->count();
   }
   public function addDgUser(Request $request){

        $data = Http::get('https://dreamsgallerybd.com/app/get/user/all');
        $allMainCustomer = json_decode(($data));
        // return $allMainCustomer;
        $AllMainProductsData = [];


        foreach ($allMainCustomer as  $customerValue) {



            $user = User::create([
                'name'=> $customerValue->name ,
                'email'=> $customerValue->email ,
                'password'=> $customerValue->password ,
                'userType'=> $customerValue->userType ,
                'username'=> $customerValue->username ,
                'contact'=> $customerValue->contact ,
                'store_id'=> 0
            ]);

            $customer = Customer::where('contact',$customerValue->contact)->update([
                'userId'=>$user->id
            ]);




        }


        // return MainProduct::where('id','>',0)->with(['products'=>function($query){
        //     $query->select('id','mproductId','productName','variation');
        // }])->with('variations.values','productImages')->first();
        return User::where('id','>',0)->count();
   }


    public function list(Request $request){
        $query =  MainProducts::withCount('products');

        // $query->whereDoesntHave('products');


        $data = $query->limit(10)->get();
        return $data;
    }
    public function newTest(Request $request){


        Bugsnag::notifyException(new RuntimeException("Test error"));

        return 'Test Error';
    }
}
