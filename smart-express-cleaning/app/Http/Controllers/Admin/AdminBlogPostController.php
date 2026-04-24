<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBlogPostController extends Controller
{
    public function index()
    {
        $blogPosts = BlogPost::query()->orderByDesc('published_at')->paginate(15);

        return view('admin.blog-posts.index', compact('blogPosts'));
    }

    public function create()
    {
        return view('admin.blog-posts.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        BlogPost::create($validated);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post created successfully.');
    }

    public function show(BlogPost $blogPost)
    {
        return redirect()->route('admin.blog-posts.edit', $blogPost);
    }

    public function edit(BlogPost $blogPost)
    {
        return view('admin.blog-posts.edit', compact('blogPost'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $this->validateRequest($request, $blogPost->id);

        $blogPost->update($validated);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post deleted successfully.');
    }

    private function validateRequest(Request $request, ?int $blogPostId = null): array
    {
        $request->merge([
            'slug' => Str::slug($request->input('slug') ?: $request->input('title', '')),
        ]);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:blog_posts,slug'.($blogPostId ? ','.$blogPostId : '')],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'content' => ['required', 'string'],
            'cover_image_url' => ['nullable', 'url', 'max:2048'],
            'author_name' => ['nullable', 'string', 'max:255'],
            'read_time_minutes' => ['nullable', 'integer', 'min:1', 'max:60'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $validated['author_name'] = $validated['author_name'] ?? 'Smart Express Editorial Team';
        $validated['read_time_minutes'] = $validated['read_time_minutes'] ?? 5;
        $validated['is_published'] = (bool) ($validated['is_published'] ?? false);

        return $validated;
    }
}
