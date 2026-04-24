@extends('admin.layout')

@section('title', 'Blog Posts')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Blog Posts</h1>
        <a href="{{ route('admin.blog-posts.create') }}" class="btn btn-dark btn-sm">Add Blog Post</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Published</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($blogPosts as $blogPost)
                        <tr>
                            <td>{{ $blogPost->title }}</td>
                            <td><code>{{ $blogPost->slug }}</code></td>
                            <td>{{ optional($blogPost->published_at)->format('Y-m-d H:i') ?: '-' }}</td>
                            <td>
                                @if ($blogPost->is_published)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.blog-posts.edit', $blogPost) }}" class="btn btn-sm btn-outline-dark">Edit</a>
                                <form method="POST" action="{{ route('admin.blog-posts.destroy', $blogPost) }}" class="d-inline" onsubmit="return confirm('Delete this blog post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary py-4">No blog posts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $blogPosts->links() }}
    </div>
@endsection

