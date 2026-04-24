@extends('frontend.layouts.app')

@section('title', ($page->name ?: 'Our Services').' - Smart Express Cleaning')
@section('body_class', 'front-page')

@section('content')
    <section class="page-hero" @if($page->hero_image_url) style="background: linear-gradient(110deg, rgba(12, 25, 41, 0.96), rgba(12, 25, 41, 0.72)), url('{{ $page->hero_image_url }}') center/cover no-repeat;" @endif>
        <div class="container">
            <p class="page-kicker fade-up">{{ $page->hero_kicker ?: 'Our Services' }}</p>
            <h1 class="page-title fade-up">{{ $page->hero_title }}</h1>
            <p class="page-lead fade-up">{{ $page->hero_subtitle }}</p>
        </div>
    </section>

    <section class="section-shell pt-0">
        <div class="container">
            <div class="row g-4">
                @forelse ($services as $service)
                    <div class="col-md-6 col-lg-4 fade-up">
                        <article class="service-card">
                            <img src="{{ $service->image_url ?: 'https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?auto=format&fit=crop&w=1200&q=80' }}" alt="{{ $service->title }}">
                            <div class="service-card-body">
                                <h4>{{ $service->title }}</h4>
                                <p class="text-secondary mb-0">{{ $service->short_description ?: $service->description }}</p>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-secondary">No services available yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    @php
        $process = data_get($page->extra_content, 'process', [
            ['title' => '1. Booking Sync', 'text' => 'We align cleaning windows with check-out schedules and turnaround deadlines.'],
            ['title' => '2. Team Dispatch', 'text' => 'Assigned cleaners arrive with a task checklist and property-specific requirements.'],
            ['title' => '3. Quality Confirmation', 'text' => 'Final walkthrough confirms cleanliness, staging, and guest-facing presentation.'],
        ]);
    @endphp

    <section class="section-shell">
        <div class="container">
            <div class="process-strip fade-up">
                <h2 class="section-title mb-3">{{ $page->section_title ?: 'How Our Process Works' }}</h2>
                <div class="row g-3">
                    @foreach ($process as $step)
                        <div class="col-md-4">
                            <div class="process-item">
                                <h3 class="h5">{{ data_get($step, 'title') }}</h3>
                                <p class="mb-0 text-secondary">{{ data_get($step, 'text') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @include('frontend.partials.contact-form')
@endsection

