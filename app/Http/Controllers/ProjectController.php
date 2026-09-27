<?php

namespace App\Http\Controllers;

use App\Models\PortfolioItem;
use App\Models\Profile;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $tech = $request->string('tech')->toString();

        $projects = PortfolioItem::published()
            ->filterByTech($tech)
            ->ordered()
            ->paginate(9)
            ->withQueryString();

        $technologies = PortfolioItem::published()
            ->pluck('technologies')
            ->flatten()
            ->unique()
            ->sort()
            ->values();

        return view('projects.index', [
            'projects' => $projects,
            'technologies' => $technologies,
            'activeTech' => $tech,
            'profile' => Profile::current(),
            'setting' => Setting::current(),
        ]);
    }

    public function show(PortfolioItem $project): View
    {
        if (! $project->published) {
            abort(404);
        }

        $project->load([]);

        return view('projects.show', [
            'project' => $project,
            'previous' => $project->adjacent(false),
            'next' => $project->adjacent(true),
            'profile' => Profile::current(),
            'setting' => Setting::current(),
        ]);
    }
}