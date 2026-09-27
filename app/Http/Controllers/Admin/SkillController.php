<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SkillRequest;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function index(): View
    {
        return view('admin.skills.index', [
            'skills' => Skill::ordered()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.skills.create', ['skill' => new Skill]);
    }

    public function store(SkillRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['order'] = $data['order'] ?? (Skill::max('order') + 1);

        Skill::create($data);
        Cache::forget('skills');

        return redirect()->route('admin.skills.index')->with('success', 'Skill created.');
    }

    public function edit(Skill $skill): View
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(SkillRequest $request, Skill $skill): RedirectResponse
    {
        $skill->update($request->validated());
        Cache::forget('skills');

        return redirect()->route('admin.skills.index')->with('success', 'Skill updated.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();
        Cache::forget('skills');

        return back()->with('success', 'Skill deleted.');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:skills,id'],
        ]);

        foreach ($request->ids as $position => $id) {
            Skill::where('id', $id)->update(['order' => $position + 1]);
        }

        Cache::forget('skills');

        return back()->with('success', 'Order updated.');
    }
}