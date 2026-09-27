<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function __construct(private ImageUploadService $images)
    {
    }

    public function edit(): View
    {
        return view('admin.settings.edit', ['setting' => Setting::current()]);
    }

    public function update(SettingRequest $request): RedirectResponse
    {
        $setting = Setting::current();
        $data = $request->validated();
        unset($data['og_image']);

        if ($request->hasFile('og_image')) {
            $data['og_image'] = $this->images->replace($setting->og_image, $request->file('og_image'), 'seo');
        }

        $setting->update($data);
        Cache::forget('settings');

        return back()->with('success', 'SEO settings updated.');
    }
}