<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FaqCategory;
use App\Models\Faq;

class FaqController extends Controller
{
    public function faqCategories(){
        $faq_categories = FaqCategory::get()->toArray();
        return view('admin.faqs.faq_categories')->with(compact('faq_categories'));
    }
    public function addEditFaqCategory(Request $request,$id=null){
        if ($id == "") {
           $title = "Add Faq Category";
           $faq_category = new FaqCategory;
           $message = "Faq Category added Successfully!";
        }else{
           $title = "Edit Faq Category";
           $faq_category = FaqCategory::find($id);
           $message = "Faq Category updated Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'name' => 'required',
                'order' => 'required',
            ];
            $customMessages = [
                'name.required' => 'Category Name is required!',
                'order.required' => 'Category Order is required!',
            ];
            $this->validate($request,$rules,$customMessages);

            $faq_category->name = $data['name'];
            $faq_category->order = $data['order'];
            $faq_category->status = 1;
            $faq_category->save();
            return redirect('admin/faq-categories')->with('success_message',$message);
        }
        return view('admin.faqs.add_edit_faq_category')->with(compact('title','faq_category'));
    }
    public function updateFaqCategoryStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status']=="Active") {
                $status = 2;
            }else{
                $status = 1;
            }
            FaqCategory::where('id',$data['faq_category_id'])->update(['status'=>$status]);

            return response()->json(['status'=>$status,'faq_category_id'=>$data['faq_category_id']]);
        }
    }
    public function deleteFaqCategory($id){
        FaqCategory::where('id',$id)->delete();
        $message = "Faq Category has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }

    public function faqs(){
        $faqs = Faq::with('category')->get()->toArray();
        //dd($faqs);
        return view('admin.faqs.faqs')->with(compact('faqs'));
    }
    public function addEditFaq(Request $request,$id=null){
        if ($id == "") {
           $title = "Add Faq";
           $faq = new Faq;
           $message = "Faq added Successfully!";
        }else{
           $title = "Edit Faq";
           $faq = Faq::find($id);
           $message = "Faq updated Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'question' => 'required',
                'answer' => 'required',
                'category_id' => 'required',
            ];
            $customMessages = [
                'question.required' => 'Question is required!',
                'answer.required' => 'Answer is required!',
                'category_id.required' => 'Category is required!',

            ];
            $this->validate($request,$rules,$customMessages);

            $faq->question = $data['question'];
            $faq->answer = $data['answer'];
            $faq->category_id = $data['category_id'];
            $faq->status = 1;
            $faq->save();
            return redirect('admin/faqs')->with('success_message',$message);
        }

        $categories = FaqCategory::where('status',1)->select('id','name')->get()->toArray();
        return view('admin.faqs.add_edit_faq')->with(compact('title','faq','categories'));
    }
    public function updateFaqStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status']=="Active") {
                $status = 2;
            }else{
                $status = 1;
            }
            Faq::where('id',$data['faq_id'])->update(['status'=>$status]);

            return response()->json(['status'=>$status,'faq_id'=>$data['faq_id']]);
        }
    }
    public function deleteFaq($id){
        Tax::where('id',$id)->delete();
        $message = "Brand has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }
}
