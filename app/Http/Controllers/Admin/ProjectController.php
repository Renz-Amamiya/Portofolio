<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectRequest;
use App\Models\PortfolioItem;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __construct(private ImageUploadService $images)
    {
    }

    public function index(): View
    {
        $projects = PortfolioItem::ordered()->paginate(15);

        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('admin.projects.create', ['project' => new PortfolioItem]);
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['order'] = $data['order'] ?? (PortfolioItem::max('order') + 1);

        if ($request->hasFile('image')) {
            $data['image'] = $this->images->store($request->file('image'), 'projects');
        }

        $data['gallery'] = $this->storeGallery($request);

        PortfolioItem::create($data);
        Cache::forget('projects');

        return redirect()->route('admin.projects.index')->with('success', 'Project created.');
    }

    public function edit(PortfolioItem $project): View
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, PortfolioItem $project): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->images->replace($project->image, $request->file('image'), 'projects');
        }

        if ($request->hasFile('gallery')) {
            $this->deleteGallery($project);
            $data['gallery'] = $this->storeGallery($request);
        }

        $project->update($data);
        Cache::forget('projects');

        return redirect()->route('admin.projects.index')->with('success', 'Project updated.');
    }

    public function destroy(PortfolioItem $project): RedirectResponse
    {
        $this->images->delete($project->image);
        $this->deleteGallery($project);

        $project->delete();
        Cache::forget('projects');

        return back()->with('success', 'Project deleted.');
    }

    public function toggle(Request $request, PortfolioItem $project): RedirectResponse
    {
        $project->update(['published' => $request->boolean('published')]);
        Cache::forget('projects');

        return back()->with('success', $project->published ? 'Project published.' : 'Project unpublished.');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:portfolio_items,id'],
        ]);

        foreach ($request->ids as $position => $id) {
            PortfolioItem::where('id', $id)->update(['order' => $position + 1]);
        }

        Cache::forget('projects');

        return back()->with('success', 'Order updated.');
    }

    private function storeGallery(ProjectRequest $request): array
    {
        $paths = [];
        foreach ($request->file('gallery', []) as $file) {
            $paths[] = $this->images->store($file, 'projects');
        }

        return $paths;
    }

    private function deleteGallery(PortfolioItem $project): void
    {
        foreach ($project->gallery ?? [] as $path) {
            $this->images->delete($path);
        }
    }
}