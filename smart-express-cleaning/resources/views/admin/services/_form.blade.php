<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $service->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Slug</label>
    <input type="text" name="slug" class="form-control" value="{{ old('slug', $service->slug ?? '') }}" placeholder="auto-generated if empty">
</div>

<div class="mb-3">
    <label class="form-label">Short Description</label>
    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $service->short_description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Detailed Description</label>
    <textarea name="description" class="form-control" rows="5">{{ old('description', $service->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Upload Image</label>
    <input type="file" name="image_file" class="form-control" accept="image/*">
    @if (isset($service) && ! empty($service->image_url))
        <div class="mt-2">
            <img src="{{ $service->image_url }}" alt="{{ $service->title }}" style="width: 140px; height: 90px; object-fit: cover; border-radius: .35rem;">
        </div>
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Sort Order</label>
    <input type="number" name="sort_order" class="form-control" min="0" value="{{ old('sort_order', $service->sort_order ?? 0) }}">
</div>

<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="service_is_active" @checked((bool) old('is_active', $service->is_active ?? true))>
    <label class="form-check-label" for="service_is_active">Active</label>
</div>

<button type="submit" class="btn btn-dark">{{ $buttonLabel }}</button>
<a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Cancel</a>

