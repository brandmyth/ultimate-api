<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HompageBanner;
use App\Models\HompageAdvertisement;

use App\Models\FooterBanner;
use App\Models\FooterAdvertisement;

use App\Models\SocialMedia;
use App\Models\FooterManagement;


use Image;

class PagemanagementController extends Controller
{
// Home banner
    public function hompageBanner(){
        $banner = HompageBanner::get()->toArray();
        return view('admin.pagemanagement.home-page-banner.hompageBanner')->with(compact('banner'));
    }
    public function addEditHompageBanner(Request $request,$id=null){
        if ($id == "") {
           $title = "Add Homepge Banner";
           $banner = new HompageBanner;
           $message = "Banner added Successfully!";
        }else{
           $title = "Edit Homepge Banner";
           $banner = HompageBanner::find($id);
           $message = "Banner updated Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'title' => 'required',
            ];
            $customMessages = [
                'title.required' => 'Title is required!',
            ];
            $this->validate($request,$rules,$customMessages);

            //Upload Category Image
            if ($request->hasFile('banner_image')) {
                $image_tmp = $request->file('banner_image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imgName = rand(111,99999) . '.' . $extension;
                    $imagePath = 'frontend/images/banner_images/'.$imgName;
                    Image::make($image_tmp)->save($imagePath);
                    $banner->banner_image = $imgName;
                }
            }
            else {
                $banner->banner_image = "";
            }

            $banner->title = $data['title'];
            $banner->sub_title = $data['sub_title'];
            $banner->link = $data['link'];
            $banner->status = 1;
            $banner->save();
            return redirect('admin/homepage-banner')->with('success_message',$message);
        }
        return view('admin.pagemanagement.home-page-banner.add_edit_homepage_banner')->with(compact('title','banner'));
    }
    public function deleteHomepageBanner($id){
        HompageBanner::where('id',$id)->delete();
        $message = "Banner has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }

// Home Banner Advertisement
    public function homepageAdvertisement(){
        $advertisement = HompageAdvertisement::get()->toArray();
        return view('admin.pagemanagement.home-page-advertisement.homepageAdvertisement')->with(compact('advertisement'));
    }
    public function addEditHompageAdvertisement(Request $request,$id=null){
        if ($id == "") {
           $title = "Add Homepge Advertisement";
           $advertisement = new HompageAdvertisement;
           $message = "Banner added Successfully!";
        }else{
           $title = "Edit Homepge Banner";
           $advertisement = HompageAdvertisement::find($id);
           $message = "Banner updated Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'title' => 'required',
            ];
            $customMessages = [
                'title.required' => 'Title is required!',
            ];
            $this->validate($request,$rules,$customMessages);

            //Upload Category Image
            if ($request->hasFile('advertisement_image')) {
                $image_tmp = $request->file('advertisement_image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imgName = rand(111,99999) . '.' . $extension;
                    $imagePath = 'frontend/images/advertisement_images/'.$imgName;
                    Image::make($image_tmp)->save($imagePath);
                    $advertisement->advertisement_image = $imgName;
                }
            }
            else {
                $advertisement->advertisement_image = "";
            }

            $advertisement->title = $data['title'];
            $advertisement->sub_title = $data['sub_title'];
            $advertisement->url = $data['url'];
            $advertisement->status = 1;
            $advertisement->save();
            return redirect('admin/homepage-advertisement')->with('success_message',$message);
        }
        return view('admin.pagemanagement.home-page-advertisement.add_edit_homepage_advertisement')->with(compact('title','advertisement'));
    }
    public function deleteHomepageAdvertisement($id){
        HompageBanner::where('id',$id)->delete();
        $message = "Banner has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }


// Footer
    // Footer Banner

    public function footerBanner(){
        $banner = FooterBanner::get()->toArray();
        return view('admin.pagemanagement.footer-banner.footerBanner')->with(compact('banner'));
    }
    public function addEditFooterBanner(Request $request,$id=null){
        if ($id == "") {
           $title = "Add Footer Banner";
           $banner = new FooterBanner;
           $message = "Banner added Successfully!";
        }else{
           $title = "Edit Footer Banner";
           $banner = FooterBanner::find($id);
           $message = "Banner updated Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'title' => 'required',
            ];
            $customMessages = [
                'title.required' => 'Title is required!',
            ];
            $this->validate($request,$rules,$customMessages);

            //Upload Footer Image
            if ($request->hasFile('banner_image')) {
                $image_tmp = $request->file('banner_image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imgName = rand(111,99999) . '.' . $extension;
                    $imagePath = 'frontend/images/footer_banner_images/'.$imgName;
                    Image::make($image_tmp)->save($imagePath);
                    $banner->banner_image = $imgName;
                }
            }
            else {
                $banner->banner_image = "";
            }

            $banner->title = $data['title'];
            $banner->sub_title = $data['sub_title'];
            $banner->url = $data['url'];
            $banner->status = 1;
            $banner->save();
            return redirect('admin/footer-banner')->with('success_message',$message);
        }
        return view('admin.pagemanagement.footer-banner.add_edit_footer_banner')->with(compact('title','banner'));
    }
    public function deleteFooterBanner($id){
        FooterBanner::where('id',$id)->delete();
        $message = "Banner has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }

// Footer Advertisement
    public function footerAdvertisement(){
        $advertisement = FooterAdvertisement::get()->toArray();
        return view('admin.pagemanagement.footer-advertisement.footerAdvertisement')->with(compact('advertisement'));
    }
    public function addEditFooterAdvertisement(Request $request,$id=null){
        if ($id == "") {
           $title = "Add Footer Advertisement";
           $advertisement = new FooterAdvertisement;
           $message = "Added Successfully!";
        }else{
           $title = "Edit Footer Banner";
           $advertisement = FooterAdvertisement::find($id);
           $message = "Updated Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'title' => 'required',
            ];
            $customMessages = [
                'title.required' => 'Title is required!',
            ];
            $this->validate($request,$rules,$customMessages);

            //Upload Category Image
            if ($request->hasFile('advertisement_image')) {
                $image_tmp = $request->file('advertisement_image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imgName = rand(111,99999) . '.' . $extension;
                    $imagePath = 'frontend/images/footer_advertisement_images/'.$imgName;
                    Image::make($image_tmp)->save($imagePath);
                    $advertisement->advertisement_image = $imgName;
                }
            }
            else {
                $advertisement->advertisement_image = "";
            }

            $advertisement->title = $data['title'];
            $advertisement->sub_title = $data['sub_title'];
            $advertisement->url = $data['url'];
            $advertisement->status = 1;
            $advertisement->save();
            return redirect('admin/footer-advertisement')->with('success_message',$message);
        }
        return view('admin.pagemanagement.footer-advertisement.add_edit_footer_advertisement')->with(compact('title','advertisement'));
    }
    public function deleteFooterAdvertisement($id){
        FooterAdvertisement::where('id',$id)->delete();
        $message = "Advertisement has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }

//Social Media Management
    public function socialMediaManagement(){
        $socialMedia = SocialMedia::get()->toArray();
        return view('admin.pagemanagement.social-media.social_media')->with(compact('socialMedia'));
    }
    public function addEditSocialMedia(Request $request,$id=null){
        if ($id == "") {
           $title = "Add Social Icon";
           $socialMedia = new SocialMedia;
           $message = "Added Successfully!";
        }else{
           $title = "Edit Social Icon";
           $socialMedia = SocialMedia::find($id);
           $message = "Updated Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'title' => 'required',
            ];
            $customMessages = [
                'title.required' => 'Title is required!',
            ];
            $this->validate($request,$rules,$customMessages);

            //Upload Category Image
            if ($request->hasFile('social_icon')) {
                $image_tmp = $request->file('social_icon');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imgName = rand(111,99999) . '.' . $extension;
                    $imagePath = 'frontend/images/social_icons/'.$imgName;
                    Image::make($image_tmp)->save($imagePath);
                    $socialMedia->social_icon = $imgName;
                }
            }
            else {
                $socialMedia->social_icon = "";
            }

            $socialMedia->title = $data['title'];
            $socialMedia->sub_title = $data['sub_title'];
            $socialMedia->url = $data['url'];
            $socialMedia->status = 1;
            $socialMedia->save();
            return redirect('admin/social-media')->with('success_message',$message);
        }
        return view('admin.pagemanagement.social-media.add_edit_social_media')->with(compact('title','socialMedia'));
    }
    public function deleteSocialmedia($id){
        SocialMedia::where('id',$id)->delete();
        $message = "Social icon has been deleted successfully!";
        return redirect()->back()->with('success_message',$message);
    }


//Main footer



    public function footerManagement(){
        $footerManagement = FooterManagement::get()->toArray();
        return view('admin.pagemanagement.footer-management.footerManagement')->with(compact('footerManagement'));
    }
    
    public function addEditManageFooter(Request $request,$id=null){
        if ($id == "") {
           $title = "Add Footer Content";
           $footerManagement = new FooterManagement;
           $message = "Added Successfully!";
        }else{
           $title = "Edit Footer Content";
           $footerManagement = FooterManagement::first();
           $message = "Updated Successfully!";
        }
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'address' => 'required',
            ];
            $customMessages = [
                'address.required' => 'Address is required!',
            ];
            $this->validate($request,$rules,$customMessages);

            //Upload Logo
            if ($request->hasFile('hotline_logo')) {
                $image_tmp = $request->file('hotline_logo');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imgName = rand(111,99999) . '.' . $extension;
                    $imagePath = 'frontend/images/social_icons/'.$imgName;
                    Image::make($image_tmp)->save($imagePath);
                    $footerManagement->hotline_logo = $imgName;
                }
            }
            else {
                // $footerManagement->hotline_logo = "";
                // $footerManagement->hotline_logo =  $data['hotline_logo'];

            }
            
            $footerManagement->address = $data['address'];
            $footerManagement->office_contact = $data['office_contact'];
            $footerManagement->email = $data['email'];
            $footerManagement->working_hour = $data['working_hour'];
            $footerManagement->copyright_description = $data['copyright_description'];
            $footerManagement->hotline_no = $data['hotline_no'];
            $footerManagement->hotline_description = $data['hotline_description'];


            $footerManagement->save();
            return view('admin.pagemanagement.footer-management.add_edit_footer_management')->with('success_message',$message)->with(compact('title','footerManagement'));
        }
        return view('admin.pagemanagement.footer-management.add_edit_footer_management')->with(compact('title','footerManagement'));
    }

    
    // public function deleteHotlineLogo($id){
    //     FooterManagement::where('id',$id)->delete();
    //     $message = "Social icon has been deleted successfully!";
    //     return redirect()->back()->with('success_message',$message);
    // }

    // public function footerCpoyright(){
    //     return view('admin.pagemanagement.footer-management.add_edit_footer_management');
    // }
}
