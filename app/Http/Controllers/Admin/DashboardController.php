<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\PortfolioItem;
use App\Models\Skill;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'projects' => PortfolioItem::count(),
            'publishedProjects' => PortfolioItem::published()->count(),
            'skills' => Skill::count(),
            'unreadMessages' => Contact::unread()->count(),
            'messages' => Contact::latest()->limit(5)->get(),
        ]);
    }
}