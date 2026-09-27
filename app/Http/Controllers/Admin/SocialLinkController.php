<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SocialLinkRequest;
use App\Models\SocialLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SocialLinkController extends Controller
{
    public function index(): View
    {
        return view('admin.socials.index', [
            'links' => SocialLink::ordered()->paginate(20),
        ]);
    }

    public function create(): View
    {
        return view('admin.socials.create', ['link' => new SocialLink]);
    }

    public function store(SocialLinkRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['order'] = $data['order'] ?? (SocialLink::max('order') + 1);

        SocialLink::create($data);
        Cache::forget('socials');

        return redirect()->route('admin.socials.index')->with('success', 'Link created.');
    }

    public function edit(SocialLink $social): View
    {
        return view('admin.socials.edit', ['link' => $social]);
    }

    public function update(SocialLinkRequest $request, SocialLink $social): RedirectResponse
    {
        $social->update($request->validated());
        Cache::forget('socials');

        return redirect()->route('admin.socials.index')->with('success', 'Link updated.');
    }

    public function destroy(SocialLink $social): RedirectResponse
    {
        $social->delete();
        Cache::forget('socials');

        return back()->with('success', 'Link deleted.');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:social_links,id'],
        ]);

        foreach ($request->ids as $position => $id) {
            SocialLink::where('id', $id)->update(['order' => $position + 1]);
        }

        Cache::forget('socials');

        return back()->with('success', 'Order updated.');
    }
}