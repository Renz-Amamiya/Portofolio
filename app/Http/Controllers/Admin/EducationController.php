<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EducationRequest;
use App\Models\Education;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EducationController extends Controller
{
    public function index(): View
    {
        return view('admin.educations.index', [
            'educations' => Education::ordered()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.educations.create', ['education' => new Education]);
    }

    public function store(EducationRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['order'] = $data['order'] ?? (Education::max('order') + 1);

        Education::create($data);

        return redirect()->route('admin.educations.index')->with('success', 'Education created.');
    }

    public function edit(Education $education): View
    {
        return view('admin.educations.edit', compact('education'));
    }

    public function update(EducationRequest $request, Education $education): RedirectResponse
    {
        $education->update($request->validated());

        return redirect()->route('admin.educations.index')->with('success', 'Education updated.');
    }

    public function destroy(Education $education): RedirectResponse
    {
        $education->delete();

        return back()->with('success', 'Education deleted.');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:education,id'],
        ]);

        foreach ($request->ids as $position => $id) {
            Education::where('id', $id)->update(['order' => $position + 1]);
        }

        return back()->with('success', 'Order updated.');
    }
}
