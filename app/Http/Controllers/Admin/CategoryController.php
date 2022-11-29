<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Section;
use Image;

class CategoryController extends Controller
{
    public function categories(){
        $categories = Category::with(['section','parentcategory'])->get()->toArray();
        return view('admin.categories.categories')->with(compact('categories'));
    }
    public function addEditCategory(Request $request,$id=null){
        if ($id == "") {
           $title = "Add Category";
           $category = new Category;
           $categories = array();
           $message = "Category added Successfully!";
        }else{
           $title = "Edit Category";
           $category = Category::find($id);
           $categories = Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$category['section_id']])->get();
           $message = "Category updated Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            // dd($data);
            $rules = [
                'category_name' => 'required',
                'section_id' => 'required',
                'url' => 'required',
            ];
            $customMessages = [
                'category_name.required' => 'Category Name is required!',
                'section_id.required' => 'Section ID is required!',
                'url.required' => 'Category URL is required!',
            ];
            $this->validate($request,$rules,$customMessages);

            
            if ($data['category_discount']=="") {
                $data['category_discount'] = 0;
            }
        
            //Upload Category Image
            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imgName = rand(111,99999).'.'.$extension;
                    $imagePath = 'frontend/images/category_images/'.$imgName;
                    Image::make($image_tmp)->save($imagePath);
                    $category->category_image = $imgName;
                }
            }
            if (!empty($category->category_image)) {
                $category->category_image = $category->category_image;
            }
            

            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->category_bg_color = $data['category_bg_color'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();
            return redirect('admin/categories')->with('success_message',$message);
        }
        //get all Sections
        $sections = Section::get()->toArray();
        return view('admin.categories.add_edit_category')->with(compact('title','category','sections','categories'));
    }
    public function appendCategoriesLevel(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            $categories = Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$data['section_id']])->get()->toArray();
            return view('admin.categories.append_categories_level')->with(compact('categories'));
        }
    }
    public function updateCategoryStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status']=="Active") {
                $status = 0;
            }else{
                $status = 1;
            }
            Category::where('id',$data['category_id'])->update(['status'=>$status]);

            return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
        }
    }
    public function deleteCategory($id){
        Category::where('id',$id)->delete();
        $message = "Category has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }

    public function deleteCategoryImage($id){
        //Get Category Image
        $category_image = Category::select('category_image')->where('id',$id)->first();

        //Get Image Path
        $category_image_path = 'frontend/images/category_images/';
        
        //Delete Image if exists
        if (file_exists($category_image_path.$category_image->category_image)) {
            unlink($category_image_path.$category_image->category_image);
        }

        //Delete Image from Category
        Category::where('id',$id)->update(['category_image'=>'']);

        $message = "Category Image has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }
}
