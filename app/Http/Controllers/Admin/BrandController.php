<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function brands(){
        $brands = Brand::get()->toArray();
        return view('admin.brands.brands')->with(compact('brands'));
    }
    public function addEditBrand(Request $request,$id=null){
        if ($id == "") {
           $title = "Add Brand";
           $brand = new Brand;
           $message = "Brand added Successfully!";
        }else{
           $title = "Edit Brand";
           $brand = Brand::find($id);
           $message = "Brand updated Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $customMessages = [
                'name.required' => 'Brand Name is required!',
                'name.regex' => 'Valid Name is required!',
            ];
            $this->validate($request,$rules,$customMessages);

            $brand->name = $data['name'];
            $brand->status = 1;
            $brand->save();
            return redirect('admin/brands')->with('success_message',$message);
        }
        return view('admin.brands.add_edit_brand')->with(compact('title','brand'));
    }
    public function updateBrandStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status']=="Active") {
                $status = 0;
            }else{
                $status = 1;
            }
            Brand::where('id',$data['brand_id'])->update(['status'=>$status]);

            return response()->json(['status'=>$status,'brand_id'=>$data['brand_id']]);
        }
    }
    public function deleteBrand($id){
        Brand::where('id',$id)->delete();
        $message = "Brand has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }
}
