<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ExperienceRequest;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    public function index(): View
    {
        return view('admin.experiences.index', [
            'experiences' => Experience::ordered()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.experiences.create', ['experience' => new Experience]);
    }

    public function store(ExperienceRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['order'] = $data['order'] ?? (Experience::max('order') + 1);

        Experience::create($data);
        Cache::forget('experiences');

        return redirect()->route('admin.experiences.index')->with('success', 'Experience created.');
    }

    public function edit(Experience $experience): View
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(ExperienceRequest $request, Experience $experience): RedirectResponse
    {
        $experience->update($request->validated());
        Cache::forget('experiences');

        return redirect()->route('admin.experiences.index')->with('success', 'Experience updated.');
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();
        Cache::forget('experiences');

        return back()->with('success', 'Experience deleted.');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:experiences,id'],
        ]);

        foreach ($request->ids as $position => $id) {
            Experience::where('id', $id)->update(['order' => $position + 1]);
        }

        Cache::forget('experiences');

        return back()->with('success', 'Order updated.');
    }
}