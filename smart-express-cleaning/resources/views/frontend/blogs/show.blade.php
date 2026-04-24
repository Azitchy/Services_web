@extends('frontend.layouts.app')

@section('title', $blog->title.' - Smart Express Cleaning')
@section('body_class', 'front-page')

@section('content')
    <section class="page-hero" @if($blog->cover_image_url) style="background: linear-gradient(110deg, rgba(12, 25, 41, 0.96), rgba(12, 25, 41, 0.72)), url('{{ $blog->cover_image_url }}') center/cover no-repeat;" @endif>
        <div class="container">
            <p class="page-kicker fade-up">Blog Detail</p>
            <h1 class="page-title fade-up">{{ $blog->title }}</h1>
            <p class="page-lead fade-up">{{ optional($blog->published_at)->format('F d, Y') }} · {{ $blog->author_name }} · {{ $blog->read_time_minutes }} min read</p>
        </div>
    </section>

    <section class="section-shell pt-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <article class="blog-article fade-up">
                        <img src="{{ $blog->cover_image_url ?: 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1400&q=80' }}" alt="{{ $blog->title }}" class="blog-hero-image mb-4">
                        @if ($blog->excerpt)
                            <p class="lead text-secondary">{{ $blog->excerpt }}</p>
                        @endif

                        @php
                            $paragraphs = preg_split('/\r\n|\r|\n/', (string) $blog->content) ?: [];
                        @endphp

                        @foreach ($paragraphs as $paragraph)
                            @if (trim($paragraph) !== '')
                                <p>{{ $paragraph }}</p>
                            @endif
                        @endforeach
                    </article>
                    <div class="mt-4 fade-up">
                        <a href="{{ route('blogs.index') }}" class="read-link">Back to all blogs</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

