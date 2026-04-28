<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AdminBannerController extends Controller
{
    public function index()
    {
        $banners = Banner::query()->orderBy('sort_order')->paginate(15);

        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        if ($request->hasFile('image_file')) {
            $validated['image_url'] = $this->storeImage($request->file('image_file'));
        }

        Banner::create($validated);

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $this->validateRequest($request, $banner->id);

        if ($request->hasFile('image_file')) {
            $this->deleteStoredImage($banner->getRawOriginal('image_url'));
            $validated['image_url'] = $this->storeImage($request->file('image_file'));
        }

        $banner->update($validated);

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        $this->deleteStoredImage($banner->getRawOriginal('image_url'));
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully.');
    }

    private function validateRequest(Request $request, ?int $bannerId = null): array
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'image_file' => [$bannerId ? 'nullable' : 'required', 'image', 'max:5120'],
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_link' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = (bool) ($validated['is_active'] ?? false);

        unset($validated['image_file']);

        return $validated;
    }

    private function storeImage(UploadedFile $file): string
    {
        return $file->store('uploads/banners', 'public');
    }

    private function deleteStoredImage(?string $imagePath): void
    {
        if (! $imagePath) {
            return;
        }

        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
}
