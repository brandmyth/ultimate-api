<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tax;

class TaxController extends Controller
{
    public function taxes(){
        $taxes = Tax::get()->toArray();
        //dd($faqs);
        return view('admin.taxes.taxes')->with(compact('taxes'));
    }
    public function addEditTax(Request $request,$id=null){
        if ($id == "") {
           $title = "Add Tax";
           $tax = new Tax;
           $message = "Tax added Successfully!";
        }else{
           $title = "Edit Tax";
           $tax = Tax::find($id);
           $message = "Tax updated Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'title' => 'required',
                'percentage' => 'required',
            ];
            $customMessages = [
                'title.required' => 'Title is required!',
                'percentage.required' => 'Percentage is required!',

            ];
            $this->validate($request,$rules,$customMessages);

            $tax->title = $data['title'];
            $tax->percentage = $data['percentage'];
            $tax->priority = $data['priority'];
            $tax->status = 1;
            $tax->save();
            return redirect('admin/taxes')->with('success_message',$message);
        }

        return view('admin.taxes.add_edit_tax')->with(compact('title','tax'));
    }
    public function updateTaxStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status']=="Active") {
                $status = 0;
            }else{
                $status = 1;
            }
            Tax::where('id',$data['tax_id'])->update(['status'=>$status]);

            return response()->json(['status'=>$status,'tax_id'=>$data['tax_id']]);
        }
    }
    public function deleteTax($id){
        Tax::where('id',$id)->delete();
        $message = "Tax has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }
}
