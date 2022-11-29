<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerAddress;
use Illuminate\Support\Str;
use App\Models\Token;
use Hash;
use DateTime;

class CustomerController extends Controller
{
    public function registerCustomer(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'customer_name' => 'required|max:255',
                'customer_email' => 'required|email|unique:customers',
                'customer_password' => 'required|min:6',
                'customer_contact' => 'required|min:11|max:14|regex:/^(?:\+?88)?01[13-9]\d{8}$/',
                'customer_gender' => 'required',
                'customer_dob' => 'required',
            ];
            $customMessages = [
                'customer_name.required' => 'Name is required!',
                'customer_email.required' => 'Email is required!',
                'customer_email.email' => 'Valid Email is required!',
                'customer_email.unique' => 'Email already exists!',
                'customer_password.required' => 'Password is required!',
                'customer_contact.regex' => 'Valid Phone Number Required!',
                'customer_contact.required' => 'Contact number is required!',
                'customer_gender.required' => 'Gender is required!',
                'customer_dob.required' => 'Date of Birth is required!',
            ];
            $this->validate($request, $rules, $customMessages);

            $customer = new Customer;
            $customer->customer_name = $data['customer_name'];
            $customer->customer_email = $data['customer_email'];
            $customer->customer_password = Hash::make($data['customer_password']);
            $customer->status = 1;
            $customer->customer_contact = $data['customer_contact'];
            $customer->customer_dob = $data['customer_dob'];
            $customer->customer_gender = $data['customer_gender'];

            $customer->save();

            $message = 'Registration Successful!';
            return response()->json(['customer' => $customer, 'success_message' => $message]);
        }
    }

    public function login(Request $request)
    {
        $customer = Customer::where('customer_email', $request->customer_email)->first();
        
        if($customer){
            if (Hash::check($request->customer_password, $customer->customer_password) && $customer->status==1) {
                $token = new Token();
                $token->customer_id = $customer->id;
                $token->token = Str::random(64);
                $token->created_at = new DateTime();
                $token->save();
    
                $customValue = array();
                $customValue['token_id'] = $token['id'];
                $customValue['token'] = $token['token'];
                $customValue['customer_id'] = $customer->id;
                $customValue['customer_name'] = $customer->customer_name;
                return $customValue;
            }
        }
        return "Username Or Password Dosen't Match";
    }

    public function logout(Request $request)
    {
        $token = Token::where('id', $request->token_id)->first();
        if ($token) {
            if ($token->expired_at == null) {
                $token->expired_at = new DateTime();
                $token->save();
                return "Successfully Logged Out";
            } else {
                return "You Already Logged Out";
            }
        } else {
            return "You Already Logged Out";
        }
    }

    public function getEditCustomer(Request $request, $id = null)
    {
        $customValue = array();
        if ($id != null) {
            $customer = Customer::with('addresses')->find($id);
            if($customer->status==1){
                
            $customValue['customer_id'] = $customer->id;
            $customValue['customer_name'] = $customer->customer_name;
            $customValue['customer_email'] = $customer->customer_email;
            $customValue['customer_contact'] = $customer->customer_contact;
            $customValue['customer_dob'] = $customer->customer_dob;
            $customValue['customer_gender'] = $customer->customer_gender;
            $customValue['customer_addresses'] = $customer->addresses;
            }
            else{
                $message = 'User Is Blocked! Contact Admin';
            return response()->json(['failed_message' => $message]);
            }
        } 
        
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'customer_name' => 'required|max:255',
                'customer_email' => 'required|email|unique:customers,customer_email,' . $data['id'],
                'customer_contact' => 'required|min:11|max:14|regex:/^(?:\+?88)?01[13-9]\d{8}$/',
                'customer_gender' => 'required',
                'customer_dob' => 'required',
            ];
            $customMessages = [
                'customer_name.required' => 'Name is required!',
                'customer_email.required' => 'Email is required!',
                'customer_email.email' => 'Valid Email is required!',
                'customer_email.unique' => 'Email already exists!',
                'customer_contact.regex' => 'Valid Phone Number Required!',
                'customer_contact.required' => 'Contact number is required!',
                'customer_gender.required' => 'Gender is required!',
                'customer_dob.required' => 'Date of Birth is required!',
            ];
            $this->validate($request, $rules, $customMessages);

            $customer = Customer::find($data['id']);
            if($customer->status==1){
            $customer->customer_name = $data['customer_name'];
            $customer->customer_email = $data['customer_email'];
            $customer->customer_contact = $data['customer_contact'];
            $customer->customer_dob = $data['customer_dob'];
            $customer->customer_gender = $data['customer_gender'];

            $customer->save();

            $message = 'Profile Update Successful!';
            return response()->json(['success_message' => $message]);
            }
            else{
                $message = 'User Is Blocked! Contact Admin';
            return response()->json(['failed_message' => $message]);
            }
        }
        
        return response($customValue);
    }

    public function changePassPost(Request $request)
    {
        $this->validate(
            $request,
            [
                'id' => ['required'],
                'current_password' => ['required'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            []
        );
        // if ((User::where('email', '=', $request->email)->exists()) && User::where('password', '=', Hash::make($request->currentpass))->exists()) {
        $customer = Customer::find($request->id);
        if(Hash::check($request->current_password, $customer->customer_password)){
            $customer->customer_password = Hash::make($request->password);
            $customer->save();
            $message = 'Password changed successfully!';
            return response()->json(['success_message' => $message]);
        }
        // 
        $message = 'Password change failed!!';
        return response()->json(['failed_message' => $message]);
    }

    public function getCustomerAddresses($customer_id)
    {
        $customerAddresses = CustomerAddress::where('customer_id', $customer_id)->get();
        if (empty($customerAddresses[0])) {
            $message = 'You did not added any address yet!';
            return response()->json(['error_message' => $message]);
        }
        $allAddresses = collect();
        foreach ($customerAddresses as $address) {
            $customValue['id'] = $address->id;
            $customValue['country'] = $address->country;
            $customValue['city'] = $address->city;
            $customValue['region'] = $address->region;
            $customValue['area'] = $address->area;
            $customValue['address'] = $address->address;
            $allAddresses->add($customValue);
        }
        
        return response($allAddresses);
    }
    public function addCustomerAddress(Request $request, $customer_id)
    {
        $this->validate(
            $request,
            [
                'country' => ['required'],
                'city' => ['required'],
                'region' => ['required'],
                'area' => ['required'],
                'address' => ['required'],
            ],
            []
        );
            
            $customerAddress = new CustomerAddress();
            $customerAddress->customer_id= $customer_id;
            $customerAddress->country= $request->country;
            $customerAddress->city= $request->city;
            $customerAddress->region= $request->region;
            $customerAddress->area= $request->area;
            $customerAddress->address= $request->address;
            $customerAddress->save();
        
            $message = 'Address Added Successfully!';
            return response()->json(['message' => $message]);
    }
}
