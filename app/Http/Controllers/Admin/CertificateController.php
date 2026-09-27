<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CertificateRequest;
use App\Models\Certificate;
use App\Services\ImageUploadService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class CertificateController extends Controller
{
    public function __construct(private ImageUploadService $images)
    {
    }

    public function index(): View
    {
        return view('admin.certificates.index', [
            'certificates' => Certificate::ordered()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.certificates.create', ['certificate' => new Certificate]);
    }

    public function store(CertificateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['order'] = $data['order'] ?? (Certificate::max('order') + 1);

        if ($request->hasFile('image')) {
            $data['image'] = $this->images->store($request->file('image'), 'certificates');
        }

        if ($request->hasFile('file')) {
            $data['file_path'] = $this->images->storePdf($request->file('file'), 'certificates');
        }

        Certificate::create($data);
        Cache::forget('certificates');

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate created.');
    }

    public function edit(Certificate $certificate): View
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(CertificateRequest $request, Certificate $certificate): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->images->replace($certificate->image, $request->file('image'), 'certificates');
        }

        if ($request->hasFile('file')) {
            $this->images->delete($certificate->file_path);
            $data['file_path'] = $this->images->storePdf($request->file('file'), 'certificates');
        }

        $certificate->update($data);
        Cache::forget('certificates');

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated.');
    }

    public function destroy(Certificate $certificate): RedirectResponse
    {
        $this->images->delete($certificate->image);
        $this->images->delete($certificate->file_path);

        $certificate->delete();
        Cache::forget('certificates');

        return back()->with('success', 'Certificate deleted.');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['integer', 'exists:certificates,id'],
        ]);

        foreach ($request->ids as $position => $id) {
            Certificate::where('id', $id)->update(['order' => $position + 1]);
        }

        Cache::forget('certificates');

        return back()->with('success', 'Order updated.');
    }
}