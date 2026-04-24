@extends('frontend.layouts.app')

@section('title', 'Smart Express Cleaning Services')
@section('body_class', 'front-home')

@section('content')
    <header class="hero" id="home">
        <div class="container">
            <div class="col-lg-8 fade-up">
                <h1 class="hero-title">{{ $page->hero_title }}</h1>
                <p class="hero-subtitle mb-4">{{ $page->hero_subtitle }}</p>
                <a href="#contact" class="btn-pop text-decoration-none">{{ data_get($page->extra_content, 'hero_button', 'Pop Me a Price') }}</a>
            </div>
        </div>
    </header>

    <section class="section-shell" id="about-snippet">
        <div class="container">
            <div class="row align-items-end mb-4">
                <div class="col-lg-8 fade-up">
                    <h2 class="section-title mb-2">{{ $page->section_title ?: 'Why Choose Mop and Pop?' }}</h2>
                    <p class="section-lead mb-0">{{ $page->section_subtitle ?: 'Built around Airbnb hosting standards, our service makes every check-in feel professionally prepared and truly guest-ready.' }}</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0 fade-up">
                    <a href="{{ route('about') }}" class="btn-pop text-decoration-none">Read About Us</a>
                </div>
            </div>

            @php
                $whyCards = data_get($page->extra_content, 'why_cards', [
                    ['title' => 'Experienced, Trusted Team', 'text' => 'All cleaners are trained for high-standard holiday home delivery.'],
                    ['title' => 'Guest-Ready Standards', 'text' => 'Premium products, linens, and staging checks on every turnover.'],
                    ['title' => 'Reliable & Flexible', 'text' => 'Scheduled around your booking flow with responsive support.'],
                    ['title' => 'Powered by Clean Tech', 'text' => 'Automation-backed operations designed for modern property teams.'],
                ]);
            @endphp

            <div class="row g-4">
                @foreach ($whyCards as $index => $card)
                    <div class="col-md-6 col-lg-3 fade-up">
                        <article class="why-card">
                            <div class="why-number">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</div>
                            <h3 class="h4">{{ data_get($card, 'title') }}</h3>
                            <p class="mb-0 text-secondary">{{ data_get($card, 'text') }}</p>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell services-wrap">
        <div class="container">
            <div class="row mb-4 align-items-end">
                <div class="col-lg-8 fade-up">
                    <h2 class="section-title mb-2">Our Services</h2>
                    <p class="mb-0">From quick turnarounds to full deep cleans, we keep your space spotless and guest-ready.</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0 fade-up">
                    <a href="{{ route('services') }}" class="btn-pop text-decoration-none">View All Services</a>
                </div>
            </div>

            <div class="row g-4">
                @foreach ($services as $service)
                    <div class="col-md-6 col-lg-4 fade-up">
                        <article class="service-card">
                            <img src="{{ $service->image_url ?: 'https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?auto=format&fit=crop&w=1200&q=80' }}" alt="{{ $service->title }}">
                            <div class="service-card-body">
                                <h4>{{ $service->title }}</h4>
                                <p class="text-secondary mb-3">{{ $service->short_description ?: $service->description }}</p>
                                <a href="{{ route('home') }}#contact" class="btn-pop btn-sm text-decoration-none">Get Quote</a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container">
            <div class="row mb-4 align-items-end">
                <div class="col-lg-8 fade-up">
                    <h2 class="section-title mb-2">Latest Blogs</h2>
                    <p class="section-lead mb-0">Tips and practical guides for hosts, property managers, and cleaning teams.</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-3 mt-lg-0 fade-up">
                    <a href="{{ route('blogs.index') }}" class="btn-pop text-decoration-none">Visit Blog</a>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($blogs as $blog)
                    <div class="col-md-6 col-lg-4 fade-up">
                        <article class="blog-card">
                            <img src="{{ $blog->cover_image_url ?: 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=1400&q=80' }}" alt="{{ $blog->title }}" class="blog-card-image">
                            <div class="p-3">
                                <p class="blog-meta mb-2">{{ optional($blog->published_at)->format('F d, Y') }} · {{ $blog->read_time_minutes }} min read</p>
                                <h3 class="h4 mb-2">{{ $blog->title }}</h3>
                                <p class="text-secondary">{{ $blog->excerpt }}</p>
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="read-link">Read Article</a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('frontend.partials.contact-form')
@endsection

