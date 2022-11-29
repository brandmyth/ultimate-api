<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{
    public function sections(){
        $sections = Section::get()->toArray();
        return view('admin.sections.sections')->with(compact('sections'));
    }
    public function addEditSection(Request $request,$id=null){
        if ($id == "") {
           $title = "Add Section";
           $section = new Section;
           $message = "Section added Successfully!";
        }else{
           $title = "Edit Section";
           $section = Section::find($id);
           $message = "Section updated Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'name' => 'required',
            ];
            $customMessages = [
                'name.required' => 'Section Name is required!',
            ];
            $this->validate($request,$rules,$customMessages);

            $section->name = $data['name'];
            $section->status = 1;
            $section->save();
            return redirect('admin/sections')->with('success_message',$message);
        }
        return view('admin.sections.add_edit_section')->with(compact('title','section'));
    }
    public function updateSectionStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status']=="Active") {
                $status = 0;
            }else{
                $status = 1;
            }
            Section::where('id',$data['section_id'])->update(['status'=>$status]);

            return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
        }
    }
    public function deleteSection($id){
        Section::where('id',$id)->delete();
        $message = "Section has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }
}
