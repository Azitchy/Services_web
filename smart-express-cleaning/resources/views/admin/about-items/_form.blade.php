<div class="mb-3">
    <label class="form-label">Type</label>
    <select name="type" class="form-select" required>
        <option value="who_we_are" @selected(old('type', $item->type ?? '') === 'who_we_are')>Who We Are</option>
        <option value="deliver" @selected(old('type', $item->type ?? '') === 'deliver')>What We Deliver Item</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $item->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Content / Description</label>
    <textarea name="content" class="form-control" rows="4">{{ old('content', $item->content ?? '') }}</textarea>
    <small class="text-secondary">For "Who We Are", you can put the main paragraphs here. For "What We Deliver", put the card description.</small>
</div>

<div class="mb-3">
    <label class="form-label">Image URL / Icon Class</label>
    <input type="text" name="image" class="form-control" value="{{ old('image', $item->image ?? '') }}">
    <small class="text-secondary">For "Who We Are", use a full image URL. For "What We Deliver", you can use an image URL or leave blank.</small>
</div>

<div class="mb-3">
    <label class="form-label">Sort Order</label>
    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $item->sort_order ?? 0) }}" required>
</div>

<div class="form-check mb-3">
    <input type="hidden" name="is_active" value="0">
    <input type="checkbox" class="form-check-input" name="is_active" value="1" id="is_active" @checked((bool) old('is_active', $item->is_active ?? true))>
    <label class="form-check-label" for="is_active">Active</label>
</div>

<button type="submit" class="btn btn-dark">{{ $buttonLabel ?? 'Save' }}</button>
<a href="{{ route('admin.about-items.index') }}" class="btn btn-outline-secondary">Cancel</a>
