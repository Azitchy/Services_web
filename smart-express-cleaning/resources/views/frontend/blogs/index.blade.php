@extends('frontend.layouts.app')

@section('title', ($page->name ?: 'Blogs').' - Smart Express Cleaning')
@section('body_class', 'front-page')

@section('content')
    <section class="page-hero" @if($page->hero_image_url) style="background: linear-gradient(110deg, rgba(12, 25, 41, 0.96), rgba(12, 25, 41, 0.72)), url('{{ $page->hero_image_url }}') center/cover no-repeat;" @endif>
        <div class="container">
            <p class="page-kicker fade-up">{{ $page->hero_kicker ?: 'Blog' }}</p>
            <h1 class="page-title fade-up">{{ $page->hero_title }}</h1>
            <p class="page-lead fade-up">{{ $page->hero_subtitle }}</p>
        </div>
    </section>

    <section class="section-shell section-paper pt-0">
        <div class="container">
            <div class="row g-4">
                @forelse ($blogs as $blog)
                    <div class="col-md-6 col-lg-4 fade-up">
                        <article class="blog-card h-100">
                            <img src="{{ $blog->cover_image_url ?: 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1400&q=80' }}" alt="{{ $blog->title }}" class="blog-card-image">
                            <div class="p-3">
                                <p class="blog-meta mb-2">{{ optional($blog->published_at)->format('F d, Y') }} · {{ $blog->read_time_minutes }} min read</p>
                                <h2 class="h4 mb-2">{{ $blog->title }}</h2>
                                <p class="text-secondary">{{ $blog->excerpt }}</p>
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="read-link">Read Article</a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-secondary">No blogs published yet.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $blogs->links() }}
            </div>
        </div>
    </section>
@endsection

