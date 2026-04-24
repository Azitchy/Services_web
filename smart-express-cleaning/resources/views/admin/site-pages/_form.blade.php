@php
    $extraJson = old('extra_content_json');

    if ($extraJson === null && isset($sitePage)) {
        $extraJson = json_encode($sitePage->extra_content ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    if ($extraJson === null) {
        $extraJson = "{}";
    }
@endphp

<div class="mb-3">
    <label class="form-label">Page Key</label>
    <input type="text" name="page_key" class="form-control" value="{{ old('page_key', $sitePage->page_key ?? '') }}" placeholder="home, about, services, blogs" required>
</div>

<div class="mb-3">
    <label class="form-label">Page Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $sitePage->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Hero Kicker</label>
    <input type="text" name="hero_kicker" class="form-control" value="{{ old('hero_kicker', $sitePage->hero_kicker ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Hero Title</label>
    <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title', $sitePage->hero_title ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Hero Subtitle</label>
    <textarea name="hero_subtitle" class="form-control" rows="2">{{ old('hero_subtitle', $sitePage->hero_subtitle ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Hero Image URL</label>
    <input type="url" name="hero_image_url" class="form-control" value="{{ old('hero_image_url', $sitePage->hero_image_url ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Section Title</label>
    <input type="text" name="section_title" class="form-control" value="{{ old('section_title', $sitePage->section_title ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Section Subtitle</label>
    <textarea name="section_subtitle" class="form-control" rows="2">{{ old('section_subtitle', $sitePage->section_subtitle ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Extra Content JSON</label>
    <textarea name="extra_content_json" class="form-control font-monospace" rows="12">{{ $extraJson }}</textarea>
    <small class="text-secondary">Use JSON for custom blocks like why cards, values, process steps.</small>
</div>

<div class="form-check mb-3">
    <input type="checkbox" class="form-check-input" name="is_active" value="1" id="is_active" @checked((bool) old('is_active', $sitePage->is_active ?? true))>
    <label class="form-check-label" for="is_active">Active</label>
</div>

<button type="submit" class="btn btn-dark">{{ $buttonLabel }}</button>
<a href="{{ route('admin.site-pages.index') }}" class="btn btn-outline-secondary">Cancel</a>

