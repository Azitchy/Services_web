<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $blogPost->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Slug</label>
    <input type="text" name="slug" class="form-control" value="{{ old('slug', $blogPost->slug ?? '') }}" placeholder="auto-generated if empty">
</div>

<div class="mb-3">
    <label class="form-label">Excerpt</label>
    <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $blogPost->excerpt ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Content</label>
    <textarea name="content" class="form-control" rows="10" required>{{ old('content', $blogPost->content ?? '') }}</textarea>
    <small class="text-secondary">Use line breaks to create paragraphs.</small>
</div>

<div class="mb-3">
    <label class="form-label">Upload Cover Image</label>
    <input type="file" name="cover_image_file" class="form-control" accept="image/*">
    @if (isset($blogPost) && ! empty($blogPost->cover_image_url))
        <div class="mt-2">
            <img src="{{ $blogPost->cover_image_url }}" alt="{{ $blogPost->title }}" style="width: 140px; height: 90px; object-fit: cover; border-radius: .35rem;">
        </div>
    @endif
</div>

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">Author Name</label>
        <input type="text" name="author_name" class="form-control" value="{{ old('author_name', $blogPost->author_name ?? 'Smart Express Editorial Team') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Read Time (minutes)</label>
        <input type="number" name="read_time_minutes" class="form-control" min="1" max="60" value="{{ old('read_time_minutes', $blogPost->read_time_minutes ?? 5) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Published At</label>
        <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', isset($blogPost) && $blogPost->published_at ? $blogPost->published_at->format('Y-m-d\\TH:i') : '') }}">
    </div>
</div>

<div class="form-check my-3">
    <input class="form-check-input" type="checkbox" name="is_published" value="1" id="is_published" @checked((bool) old('is_published', $blogPost->is_published ?? true))>
    <label class="form-check-label" for="is_published">Published</label>
</div>

<button type="submit" class="btn btn-dark">{{ $buttonLabel }}</button>
<a href="{{ route('admin.blog-posts.index') }}" class="btn btn-outline-secondary">Cancel</a>

