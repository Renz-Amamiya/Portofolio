<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Models\Profile;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(private ImageUploadService $images)
    {
    }

    public function edit(): View
    {
        return view('admin.profile.edit', [
            'profile' => Profile::current(),
        ]);
    }

    public function update(ProfileRequest $request): RedirectResponse
    {
        $profile = Profile::current();
        $data = $request->validated();
        unset($data['photo'], $data['cv']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->images->replace($profile->photo, $request->file('photo'), 'avatars', 800);
        }

        if ($request->hasFile('cv')) {
            $old = $profile->cv_path;
            $data['cv_path'] = $this->images->storePdf($request->file('cv'), 'cv');
            $this->images->delete($old);
        }

        $profile->update($data);
        Cache::forget('profile');

        return back()->with('success', 'Profile updated.');
    }
}