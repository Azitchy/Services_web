<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SitePage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AdminSitePageController extends Controller
{
    public function index()
    {
        $sitePages = SitePage::query()->orderBy('page_key')->paginate(20);

        return view('admin.site-pages.index', compact('sitePages'));
    }

    public function create()
    {
        return view('admin.site-pages.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        SitePage::create($validated);

        return redirect()->route('admin.site-pages.index')->with('success', 'Site page created successfully.');
    }

    public function show(SitePage $sitePage)
    {
        return redirect()->route('admin.site-pages.edit', $sitePage);
    }

    public function edit(SitePage $sitePage)
    {
        return view('admin.site-pages.edit', compact('sitePage'));
    }

    public function update(Request $request, SitePage $sitePage)
    {
        $validated = $this->validateRequest($request, $sitePage->id);

        $sitePage->update($validated);

        return redirect()->route('admin.site-pages.index')->with('success', 'Site page updated successfully.');
    }

    public function destroy(SitePage $sitePage)
    {
        $sitePage->delete();

        return redirect()->route('admin.site-pages.index')->with('success', 'Site page deleted successfully.');
    }

    private function validateRequest(Request $request, ?int $sitePageId = null): array
    {
        $request->merge([
            'page_key' => Str::slug($request->input('page_key', '')),
        ]);

        $validated = $request->validate([
            'page_key' => ['required', 'string', 'max:120', 'unique:site_pages,page_key'.($sitePageId ? ','.$sitePageId : '')],
            'name' => ['required', 'string', 'max:255'],
            'hero_kicker' => ['nullable', 'string', 'max:255'],
            'hero_title' => ['required', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string', 'max:2000'],
            'hero_image_url' => ['nullable', 'url', 'max:2048'],
            'section_title' => ['nullable', 'string', 'max:255'],
            'section_subtitle' => ['nullable', 'string', 'max:2000'],
            'extra_content_json' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $extraContent = [];
        if (! empty($validated['extra_content_json'])) {
            $decoded = json_decode($validated['extra_content_json'], true);
            if (json_last_error() !== JSON_ERROR_NONE || ! is_array($decoded)) {
                throw ValidationException::withMessages([
                    'extra_content_json' => 'Extra content must be valid JSON object/array.',
                ]);
            }
            $extraContent = $decoded;
        }

        return [
            'page_key' => $validated['page_key'],
            'name' => $validated['name'],
            'hero_kicker' => $validated['hero_kicker'] ?? null,
            'hero_title' => $validated['hero_title'],
            'hero_subtitle' => $validated['hero_subtitle'] ?? null,
            'hero_image_url' => $validated['hero_image_url'] ?? null,
            'section_title' => $validated['section_title'] ?? null,
            'section_subtitle' => $validated['section_subtitle'] ?? null,
            'extra_content' => $extraContent,
            'is_active' => (bool) ($validated['is_active'] ?? false),
        ];
    }
}
