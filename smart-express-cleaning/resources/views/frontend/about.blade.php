@extends('frontend.layouts.app')

@section('title', ($page->name ?: 'About Us').' - Smart Express Cleaning')
@section('body_class', 'front-page')

@section('content')
    <section class="page-hero" @if($page->hero_image_url) style="background: linear-gradient(110deg, rgba(12, 25, 41, 0.96), rgba(12, 25, 41, 0.72)), url('{{ $page->hero_image_url }}') center/cover no-repeat;" @endif>
        <div class="container">
            <p class="page-kicker fade-up">{{ $page->hero_kicker ?: 'About Us' }}</p>
            <h1 class="page-title fade-up">{{ $page->hero_title }}</h1>
            <p class="page-lead fade-up">{{ $page->hero_subtitle }}</p>
        </div>
    </section>

    @php
        $coreValues = data_get($page->extra_content, 'core_values', [
            ['title' => 'Consistency', 'text' => 'Every clean follows structured checklists and final quality inspection.'],
            ['title' => 'Speed', 'text' => 'Optimized turnover workflows to meet tight check-in timelines.'],
            ['title' => 'Transparency', 'text' => 'Clear communication on schedules, updates, and job completion.'],
            ['title' => 'Hospitality Mindset', 'text' => 'We clean to impress guests, not just to finish tasks.'],
        ]);
    @endphp

    <section class="section-shell pt-0">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6 fade-up">
                    <img class="page-image" src="{{ data_get($page->extra_content, 'who_image_url', 'https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=1400&q=80') }}" alt="Professional cleaning team">
                </div>
                <div class="col-lg-6 fade-up">
                    <h2 class="section-title mb-2">{{ data_get($page->extra_content, 'who_title', $page->section_title ?: 'Who We Are') }}</h2>
                    <p class="text-secondary">{{ data_get($page->extra_content, 'who_paragraph_1', $page->section_subtitle ?: 'We are a guest-experience focused cleaning company.') }}</p>
                    <p class="text-secondary mb-0">{{ data_get($page->extra_content, 'who_paragraph_2', 'From same-day turnovers to deep cleaning and amenity checks, we keep properties spotless and guest-ready.') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container">
            <h2 class="section-title mb-4 fade-up">{{ data_get($page->extra_content, 'values_title', 'Our Core Values') }}</h2>
            <div class="row g-4">
                @foreach ($coreValues as $value)
                    <div class="col-md-6 col-lg-3 fade-up">
                        <article class="why-card">
                            <h3 class="h4">{{ data_get($value, 'title') }}</h3>
                            <p class="mb-0 text-secondary">{{ data_get($value, 'text') }}</p>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell services-wrap">
        <div class="container">
            <div class="row mb-4">
                <div class="col-lg-8 fade-up">
                    <h2 class="section-title mb-2">{{ data_get($page->extra_content, 'deliver_title', 'What We Deliver') }}</h2>
                    <p class="mb-0">{{ data_get($page->extra_content, 'deliver_subtitle', 'A complete service cycle designed for hosts and property managers.') }}</p>
                </div>
            </div>
            <div class="row g-4">
                @foreach ($services as $service)
                    <div class="col-md-6 fade-up">
                        <article class="service-line">
                            <h3 class="h4 mb-2">{{ $service->title }}</h3>
                            <p class="mb-0">{{ $service->short_description ?: $service->description }}</p>
                        </article>
                    </div>
                @endforeach
            </div>
            <div class="mt-4 fade-up">
                <a href="{{ route('services') }}" class="btn-pop text-decoration-none">Explore All Services</a>
            </div>
        </div>
    </section>

    @include('frontend.partials.contact-form')
@endsection

