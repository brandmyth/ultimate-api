<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Subscriber;
use Hash;

class CusromerController extends Controller
{
    public function customers(){
        $customers = Customer::get()->toArray();
        //dd($customers);
        return view('admin.customers.customers')->with(compact('customers'));
    }
    public function addCustomer(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'customer_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'customer_contact' => 'required|numeric',
                'customer_email' => 'required|email|unique:customers',
            ];
            $customMessages = [
                'name.required' => 'Name is required!',
                'name.regex' => 'Valid Name is required!',
                'customer_contact.required' => 'Contact no is required!',
                'customer_contact.numeric' => 'Valid Mobile is required!',
                'customer_email.required' => 'Email is required!',
                'customer_email.email' => 'Valid Email is required!',
                'customer_email.unique' => 'Email already exists!',
            ];
            $this->validate($request,$rules,$customMessages);

            $customer = new Customer;
            $customer->customer_name = $data['customer_name'];
            $customer->customer_email = $data['customer_email'];
            $customer->customer_contact = $data['customer_contact'];
            $customer->customer_gender = $data['customer_gender'];
            $customer->customer_dob = $data['customer_dob'];
            $customer->customer_password = Hash::make($customer->type.'12345');
            $customer->status = 1;
            $customer->save();
            return Redirect()->back()->with('success_message');
        }

        // return view('admin.admins.add_admin')->with(compact('title'));
    }
















    public function viewCustomerDetails($id){
        $customerDetails = Customer::with('addresses')->where('id',$id)->first();
        $customerDetails = json_decode(json_encode($customerDetails),true);
        return view('admin.customers.view_customer_details')->with(compact('customerDetails'));
    }
    public function updateCustomerStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status']=="Active") {
                $status = 0;
            }else{
                $status = 1;
            }
            Customer::where('id',$data['customer_id'])->update(['status'=>$status]);

            return response()->json(['status'=>$status,'customer_id'=>$data['customer_id']]);
        }
    }
    public function deleteCustomer($id){
        Customer::where('id',$id)->delete();
        $message = "Customer has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }
    public function subscribers(){
        $subscribers = Subscriber::get()->toArray();
        //dd($customers);
        return view('admin.customers.subscribers')->with(compact('subscribers'));
    }
    public function updateSubscriberStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status']=="Active") {
                $status = 0;
            }else{
                $status = 1;
            }
            Subscriber::where('id',$data['subscriber_id'])->update(['status'=>$status]);

            return response()->json(['status'=>$status,'subscriber_id'=>$data['subscriber_id']]);
        }
    }
    public function deleteSubscriber($id){
        Subscriber::where('id',$id)->delete();
        $message = "Subscriber has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }
}
