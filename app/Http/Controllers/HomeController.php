<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Education;
use App\Models\Experience;
use App\Models\PortfolioItem;
use App\Models\Profile;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\SocialLink;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $profile = Profile::current();
        $setting = Setting::current();

        return view('home', [
            'profile' => $profile,
            'setting' => $setting,
            'featuredProjects' => PortfolioItem::published()->featured()->ordered()->limit(4)->get(),
            'experiences' => Experience::ordered()->limit(4)->get(),
            'skills' => Skill::ordered()->get(),
            'certificates' => Certificate::ordered()->limit(4)->get(),
            'socials' => SocialLink::ordered()->get(),
            'education' => Education::ordered()->first(),
        ]);
    }
}