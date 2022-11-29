<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HompageBanner;
use App\Models\HompageAdvertisement;

use App\Models\FooterBanner;
use App\Models\FooterAdvertisement;

use App\Models\SocialMedia;
use App\Models\FooterManagement;

class PagemanagementController extends Controller
{
    public function hompageBanner()
    {
        $banner = HompageBanner::get()->toArray();
        return response()->json(['banner'=>$banner]);

    }
    public function homepageAdvertisement()
    {
        $advertisement = HompageAdvertisement::get()->toArray();
        return response()->json(['advertisement'=>$advertisement]);
    }
    
    public function footerBanner()
    {
        $banner = FooterBanner::get()->toArray();
        return response()->json(['banner'=>$banner]);
    }
    public function footerAdvertisement()
    {
        $advertisement = FooterAdvertisement::get()->toArray();
        return response()->json(['advertisement'=>$advertisement]);
    }

    public function socialMediaManagement()
    {
        $socialMedia = SocialMedia::get()->toArray();
        return response()->json(['socialMedia'=>$socialMedia]);
    }

    public function footerManagement()
    {
        $footerManagement = FooterManagement::first()->toArray();
        return response()->json(['footerManagement'=>$footerManagement]);
    }
}
