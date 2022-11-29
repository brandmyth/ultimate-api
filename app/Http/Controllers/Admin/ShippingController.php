<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingRule;

class ShippingController extends Controller
{
    public function shippingRules(){
        $shipping_rules = ShippingRule::get()->toArray();
        //dd($faqs);
        return view('admin.shipping_rules.shipping_rules')->with(compact('shipping_rules'));
    }
    public function addEditShippingRule(Request $request,$id=null){
        if ($id == "") {
           $title = "Add ShippingRule";
           $shipping_rule = new ShippingRule;
           $message = "ShippingRule added Successfully!";
        }else{
           $title = "Edit ShippingRule";
           $shipping_rule = ShippingRule::find($id);
           $message = "ShippingRule updated Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'name' => 'required',
                'price' => 'required',
            ];
            $customMessages = [
                'name.required' => 'Name is required!',
                'price.required' => 'Price is required!',

            ];
            $this->validate($request,$rules,$customMessages);

            $shipping_rule->name = $data['name'];
            $shipping_rule->price = $data['price'];
            $shipping_rule->status = 1;
            $shipping_rule->save();
            return redirect('admin/shipping-rules')->with('success_message',$message);
        }
        return view('admin.shipping_rules.add_edit_shipping_rule')->with(compact('title','shipping_rule'));
    }
    public function updateShippingRuleStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status']=="Active") {
                $status = 0;
            }else{
                $status = 1;
            }
            ShippingRule::where('id',$data['rule_id'])->update(['status'=>$status]);

            return response()->json(['status'=>$status,'rule_id'=>$data['rule_id']]);
        }
    }
    public function deleteShippingRule($id){
        ShippingRule::where('id',$id)->delete();
        $message = "Shipping Rule has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }
}
