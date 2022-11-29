<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Tax;
use App\Models\ProductsAttribute;
use App\Models\ProductsImage;
use App\Models\ProductCollection;


class ProductController extends Controller
{

    public function getCategories(){
        $categories = Section::where('status',1)->with(['categories'=>function($query){
            $query->select('id','section_id','category_name','category_image','category_discount','url','category_bg_color');
        }])->select('id','name')->get()->toArray();
        return response()->json(['categories'=>$categories]);
    }
    public function getProducts(){
        $products = Product::with(['images'=>function($query){
            $query->select('id','product_id','image');
        },'section'=>function($query){
            $query->select('id','name');
        },'category'=>function($query){
            $query->select('id','category_name');
        },'productcollection'=>function($query){
            $query->select('id','name','discount_type','discount_amount','start_date','end_date','status');
        },'tax'=>function($query){
            $query->select('id','title','percentage');
        }])->get()->toArray();
        return response()->json(['products'=>$products]);
    }
    public function getCategoryProduct($id){
        $products = Product::where('category_id',$id)->with(['images'=>function($query){
            $query->select('id','product_id','image');
        },'section'=>function($query){
            $query->select('id','name');
        },'category'=>function($query){
            $query->select('id','category_name');
        }])->get()->toArray();
        return response()->json(['products'=>$products]);
    }
    public function getProduct($id){
        $product = Product::where('id',$id)->with(['images'=>function($query){
            $query->select('id','product_id','image');
        },'section'=>function($query){
            $query->select('id','name');
        },'category'=>function($query){
            $query->select('id','category_name');
        },'productcollection'=>function($query){
            $query->select('id','name','discount_type','discount_amount','start_date','end_date','status');
        },'tax'=>function($query){
            $query->select('id','title','percentage');
        }])->get()->toArray();
        return response()->json(['product'=>$product]);
    }
    public function getpopular()
    {
        $popular = Product::where('is_popular', '=', 'Yes')->take(8)->get()->toArray();
        return response()->json(['popular'=>$popular]);
    }
    public function getfeatured()
    {
        $featured = Product::where('is_featured', '=', 'Yes')->get()->toArray();
        return response()->json(['featured'=>$featured]);
    }
    
    public function getbestseller()
    {
        $bestseller = Product::where('is_bestseller', '=', 'Yes')->get()->toArray();
        return response()->json(['bestseller'=>$bestseller]);
    }
    public function getdealsday()
    {
        $dealsday = Product::where('is_dealsday', '=', 'Yes')->take(8)->get()->toArray();
        return response()->json(['dealsday'=>$dealsday]);
    }
}
