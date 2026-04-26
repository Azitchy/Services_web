@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Dashboard</h1>
        <span class="text-secondary">Welcome, {{ auth()->user()->name }}</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-2">
            <div class="card border-0 shadow-sm"><div class="card-body"><p class="text-secondary mb-1 small">Hosts</p><h2 class="h4 mb-0">{{ $stats['hosts'] }}</h2></div></div>
        </div>
        <div class="col-6 col-lg-2">
            <div class="card border-0 shadow-sm"><div class="card-body"><p class="text-secondary mb-1 small">Cleaners</p><h2 class="h4 mb-0">{{ $stats['cleaners'] }}</h2></div></div>
        </div>
        <div class="col-6 col-lg-2">
            <div class="card border-0 shadow-sm"><div class="card-body"><p class="text-secondary mb-1 small">Properties</p><h2 class="h4 mb-0">{{ $stats['properties'] }}</h2></div></div>
        </div>
        <div class="col-6 col-lg-2">
            <div class="card border-0 shadow-sm"><div class="card-body"><p class="text-secondary mb-1 small">Bookings</p><h2 class="h4 mb-0">{{ $stats['bookings'] }}</h2></div></div>
        </div>
        <div class="col-6 col-lg-2">
            <div class="card border-0 shadow-sm"><div class="card-body"><p class="text-secondary mb-1 small">Jobs</p><h2 class="h4 mb-0">{{ $stats['jobs'] }}</h2></div></div>
        </div>
        <div class="col-6 col-lg-2">
            <div class="card border-0 shadow-sm"><div class="card-body"><p class="text-secondary mb-1 small">New Inquiries</p><h2 class="h4 mb-0">{{ $stats['new_inquiries'] }}</h2></div></div>
        </div>
        <div class="col-6 col-lg-4">
            <div class="card border-0 shadow-sm"><div class="card-body"><p class="text-secondary mb-1 small">Site Pages</p><h2 class="h4 mb-0">{{ $stats['site_pages'] }}</h2></div></div>
        </div>
        <div class="col-6 col-lg-4">
            <div class="card border-0 shadow-sm"><div class="card-body"><p class="text-secondary mb-1 small">Services (CMS)</p><h2 class="h4 mb-0">{{ $stats['services'] }}</h2></div></div>
        </div>
        <div class="col-6 col-lg-4">
            <div class="card border-0 shadow-sm"><div class="card-body"><p class="text-secondary mb-1 small">Blog Posts</p><h2 class="h4 mb-0">{{ $stats['blog_posts'] }}</h2></div></div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h3 class="h5 mb-3">Quick Management</h3>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.site-pages.index') }}" class="btn btn-sm btn-outline-dark">Manage Site Pages</a>
                <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-outline-dark">Manage Services</a>
                <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-sm btn-outline-dark">Manage Blog Posts</a>
                <a href="{{ route('admin.contact-inquiries.index') }}" class="btn btn-sm btn-outline-dark">Manage Contact Inquiries</a>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="h5 mb-0">Recent Contact Inquiries</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentInquiries as $inquiry)
                                <tr>
                                    <td>{{ $inquiry->first_name }} {{ $inquiry->last_name }}</td>
                                    <td>{{ $inquiry->email }}</td>
                                    <td><span class="badge bg-secondary">{{ $inquiry->status }}</span></td>
                                    <td><a href="{{ route('admin.contact-inquiries.show', $inquiry) }}" class="btn btn-sm btn-outline-dark">View</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-secondary">No inquiries yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h3 class="h5 mb-0">Upcoming Cleaning Jobs</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Property</th>
                                <th>Cleaner</th>
                                <th>Status</th>
                                <th>Start</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($upcomingJobs as $job)
                                <tr>
                                    <td>{{ $job->property?->name }}</td>
                                    <td>{{ $job->cleaner?->user?->name ?? 'Unassigned' }}</td>
                                    <td><span class="badge bg-info text-dark">{{ $job->status }}</span></td>
                                    <td>{{ $job->scheduled_start?->format('Y-m-d H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-secondary">No jobs found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="h5 mb-0">Latest Services</h3>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-outline-dark">Manage</a>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @forelse ($recentServices as $service)
                            <div class="col-12 col-md-6">
                                <div class="d-flex gap-2 align-items-center">
                                    @if ($service->image_url)
                                        <img src="{{ $service->image_url }}" alt="{{ $service->title }}" style="width: 72px; height: 52px; object-fit: cover; border-radius: .3rem;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center text-secondary small" style="width: 72px; height: 52px; background: #f1f3f5; border-radius: .3rem;">No image</div>
                                    @endif
                                    <div class="min-w-0">
                                        <div class="fw-semibold text-truncate">{{ $service->title }}</div>
                                        <div class="text-secondary small text-truncate">{{ $service->slug }}</div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-secondary small">No services available.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h3 class="h5 mb-0">Latest Blog Posts</h3>
                    <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-sm btn-outline-dark">Manage</a>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @forelse ($recentBlogPosts as $blogPost)
                            <div class="col-12 col-md-6">
                                <div class="d-flex gap-2 align-items-center">
                                    @if ($blogPost->cover_image_url)
                                        <img src="{{ $blogPost->cover_image_url }}" alt="{{ $blogPost->title }}" style="width: 72px; height: 52px; object-fit: cover; border-radius: .3rem;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center text-secondary small" style="width: 72px; height: 52px; background: #f1f3f5; border-radius: .3rem;">No image</div>
                                    @endif
                                    <div class="min-w-0">
                                        <div class="fw-semibold text-truncate">{{ $blogPost->title }}</div>
                                        <div class="text-secondary small text-truncate">{{ $blogPost->slug }}</div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-secondary small">No blog posts available.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

