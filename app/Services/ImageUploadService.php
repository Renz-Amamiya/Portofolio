<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageUploadService
{
    private const MAX_WIDTH = 1920;
    private const QUALITY = 82;

    private ImageManager $manager;

    public function __construct()
    {
        // Only initialize Intervention if GD is enabled
        if (extension_loaded('gd')) {
            $this->manager = new ImageManager(new Driver);
        }
    }

    /**
     * Resize, convert to WebP, and store. Returns the path relative to the public disk.
     */
    public function store(UploadedFile $file, string $directory, ?int $maxWidth = null): string
    {
        // FALLBACK: Jika ekstensi GD mati di XAMPP, gunakan upload bawaan Laravel (tanpa kompresi WebP)
        if (!extension_loaded('gd')) {
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            return $file->storeAs(trim($directory, '/'), $filename, 'public');
        }

        $maxWidth ??= self::MAX_WIDTH;

        $image = $this->manager->read($file->getRealPath());
        $image->scaleDown(width: $maxWidth);

        $filename = Str::random(20) . '.webp';
        $path = trim($directory, '/') . '/' . $filename;

        Storage::disk('public')->put($path, (string) $image->toWebp(self::QUALITY));

        return $path;
    }

    public function replace(?string $oldPath, UploadedFile $file, string $directory, ?int $maxWidth = null): string
    {
        $this->delete($oldPath);

        return $this->store($file, $directory, $maxWidth);
    }

    public function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public function storePdf(UploadedFile $file, string $directory): string
    {
        $filename = Str::random(20) . '.pdf';
        $path = trim($directory, '/') . '/' . $filename;

        Storage::disk('public')->put($path, file_get_contents($file->getRealPath()));

        return $path;
    }
}