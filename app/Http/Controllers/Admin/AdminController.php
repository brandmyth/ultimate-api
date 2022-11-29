<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Image;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Country;
use App\Models\Category;
use App\Models\Product;
use Session;

class AdminController extends Controller
{
    public function dashboard(){
    	$order_total_count = Order::count();
    	$order_day_count = Order::whereDate('order_date', date('y-m-d'))->get()->count();

    	$category_total_count = Category::count();
    	$total_customers = Customer::count();
    	$total_products = Product::count();
    	return view('admin.dashboard')->with(compact('order_total_count', 'order_day_count', 'category_total_count', 'total_customers', 'total_products'));
    }
    public function addAdmin(Request $request){
    	$title = "Add Admin / Staff";
        
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
		        'name' => 'required|regex:/^[\pL\s\-]+$/u',
		        'mobile' => 'required|numeric',
		        'email' => 'required|email|unique:admins',
			];
			$customMessages = [
		        'name.required' => 'Name is required!',
		        'name.regex' => 'Valid Name is required!',
		        'mobile.required' => 'Mobile is required!',
		        'mobile.numeric' => 'Valid Mobile is required!',
		        'email.required' => 'Email is required!',
		        'email.email' => 'Valid Email is required!',
		        'email.unique' => 'Email already exists!',
		    ];
            $this->validate($request,$rules,$customMessages);

            $admin = new Admin;
            $admin->name = $data['name'];
            $admin->email = $data['email'];
            $admin->type = $data['type'];
            $admin->mobile = $data['mobile'];
            $admin->vendor_id = 0;
            $admin->password = Hash::make($admin->type.'12345');
            $admin->status = 1;
            $admin->save();

            //update message
            $message = ucfirst($admin->type). 'added Successfully! Default Password is '.$admin->type.'12345';
            return redirect('admin/admins/'.$admin->type)->with('success_message',$message);
        }

        return view('admin.admins.add_admin')->with(compact('title'));
    }
    public function updateAdminPassword(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
    	
	    	//check if Current password entered by admin is correct
	    	if (Hash::check($data['current_password'],Auth::guard('admin')->user()->password)) {
	    		//check if New password matches with Confirm Password
	    		if ($data['confirm_password']==$data['new_password']) {
	    			Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
	    			return redirect()->back()->with('success_message','Your Password has been updated!');
	    		}else{
	    			return redirect()->back()->with('error_message','New Password and Confirm Password does not match!');
	    		}
	    	}else{
	    		return redirect()->back()->with('error_message','Your Current Password is Incorrect!');
	    	}
    	}
    	$adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first()->toArray();
    	return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }

    public function checkAdminPassword(Request $request){
    	$data = $request->all();
    	if (Hash::check($data['current_password'],Auth::guard('admin')->user()->password)) {
    		return "true";
    	}else{
    		return "false";
    	}
    }

    public function updateAdminDetails(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();

    		$rules = [
		        'name' => 'required|regex:/^[\pL\s\-]+$/u',
		        'mobile' => 'required|numeric',
			];
			$customMessages = [
		        'name.required' => 'Name is required!',
		        'name.regex' => 'Valid Name is required!',
		        'mobile.required' => 'Mobile is required!',
		        'mobile.numeric' => 'Valid Mobile is required!',
		    ];
		    $this->validate($request,$rules,$customMessages);

		    //Upload Admin Photo
		    if ($request->hasFile('photo')) {
		    	$image_tmp = $request->file('photo');
		    	if ($image_tmp->isValid()) {
		    		$extension = $image_tmp->getClientOriginalExtension();
		    		$imgName = rand(111,99999).'.'.$extension;
		    		$imagePath = 'admin/images/photos/'.$imgName;
		    		Image::make($image_tmp)->save($imagePath);
		    	}
		    }else if (!empty($data['current_image'])) {
		    	$imgName = $data['current_image'];
		    }else {
		    	$imgName = "";
		    }

		    Admin::where('id',Auth::guard('admin')->user()->id)->update(['name'=>$data['name'],'mobile'=>$data['mobile'],'image'=>$imgName]);
		    return redirect()->back()->with('success_message','Admin Details has been updated Successfully!');
		}
    	return view('admin.settings.update_admin_details');
    }
    
    public function login(Request $request){

    	if($request->isMethod('post')){
    		$data = $request->all();

    		$rules = [
		        'email' => 'required|email|max:255',
		        'password' => 'required',
			];
		    $customMessages = [
		        'email.required' => 'Email is required!',
		        'email.email' => 'Valid Email Address is required!',
		        'password.required' => 'Password is required',
		    ];
		    $this->validate($request,$rules,$customMessages);

    		if (Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password'],'status'=>1])) {
    			return redirect('admin/dashboard');
    		}else{
    			return redirect()->back()->with('error_message','Invalid Email or Password');
    		}
    	}
    	return view('admin.login');
    }

    public function admins($type){
    	
    	$admins = Admin::query();
    	if ($type != "all") {
    		$admins = $admins->where('type',$type);
    		$title = ucfirst($type)."s";
    	}
    	else{
    		$title = "All Admins / Staffs";
    	}
    	$admins = $admins->get()->toArray();


    	return view('admin.admins.admins')->with(compact('admins','title'));
    }
    public function updateAdminStatus(Request $request){
    	if ($request->ajax()) {
    		$data = $request->all();
    		if ($data['status']=="Active") {
    			$status = 0;
    		}else{
    			$status = 1;
    		}
    		Admin::where('id',$data['admin_id'])->update(['status'=>$status]);

    		return response()->json(['status'=>$status,'admin_id'=>$data['admin_id']]);
    	}
    }
    public function logout(){
    	Auth::guard('admin')->logout();
    	return redirect('admin/login');
    }
}
