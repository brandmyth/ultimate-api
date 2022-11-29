<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingRule;
use App\Models\ShippingZone;
use App\Models\Faq;
use App\Models\FaqCategory;


class GeneralController extends Controller
{
    public function getShippingCharges(){
        $shipping_charges = ShippingRule::where('status',1)->select('id','name','price')->get()->toArray();
        return response()->json(['shipping_charges'=>$shipping_charges]);
    }
    public function getShippingZones(){
        $shipping_zones = ShippingZone::where('status',1)->select('id','area_name','shipping_rule_id')->get()->toArray();
        return response()->json(['shipping_zones'=>$shipping_zones]);
    }
    public function getFaqs(){
        $faqs = FaqCategory::where('status',1)->with(['faqs'=>function($query){
            $query->where('status',1)->select('id','question','answer','category_id');
        }])->select('id','name','order')->get()->toArray();
        return response()->json(['faqs'=>$faqs]);
    }
}
