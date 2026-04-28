<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="form-label">Banner Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Banner Subtitle</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $banner->subtitle ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Banner Content (Optional)</label>
                    <textarea name="content" class="form-control" rows="3">{{ old('content', $banner->content ?? '') }}</textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Button Text</label>
                        <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $banner->button_text ?? '') }}" placeholder="e.g. Learn More">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Button Link</label>
                        <input type="text" name="button_link" class="form-control" value="{{ old('button_link', $banner->button_link ?? '') }}" placeholder="e.g. /services">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="form-label">Banner Image</label>
                    <input type="file" name="image_file" class="form-control" {{ isset($banner) ? '' : 'required' }}>
                    <div class="form-text text-secondary mt-1">Recommended: 1920x800px. Max 5MB.</div>
                </div>

                @if (isset($banner) && $banner->image_url)
                    <div class="mb-3">
                        <label class="form-label d-block text-secondary small text-uppercase">Current Image</label>
                        <img src="{{ $banner->image_url }}" alt="Preview" class="img-fluid rounded border">
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $banner->sort_order ?? 0) }}" min="0">
                </div>

                <div class="form-check mb-3">
                    <input type="hidden" name="is_active" value="0">
                    <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $banner->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Is Active?</label>
                </div>

                <hr class="my-4">

                <button type="submit" class="btn btn-dark w-100">
                    {{ isset($banner) ? 'Update Banner' : 'Create Banner' }}
                </button>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-link w-100 mt-2 text-secondary text-decoration-none">Cancel</a>
            </div>
        </div>
    </div>
</div>
