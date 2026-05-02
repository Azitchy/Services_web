@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Dashboard</h1>
        <span class="text-secondary">Welcome, {{ auth()->user()->name }}</span>
    </div>

    <style>
        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 1rem;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 2rem rgba(0,0,0,.08)!important;
        }
        .premium-card {
            border-radius: 1rem;
            overflow: hidden;
        }
        .list-group-item-action {
            transition: all 0.2s ease;
            border: none !important;
            margin-bottom: 2px;
        }
        .list-group-item-action:hover {
            background-color: #f8faff !important;
            transform: scale(1.01);
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            z-index: 1;
            border-radius: 0.75rem !important;
        }
        .service-img-container {
            width: 52px;
            height: 52px;
            border-radius: 0.75rem;
            overflow: hidden;
            flex-shrink: 0;
        }
        .service-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .table-premium thead th {
            background: #f8f9fa;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            font-weight: 700;
            color: #6c757d;
            border-bottom: none;
            padding: 1rem;
        }
        .table-premium tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f3f5;
        }
    </style>

    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-2">
            <a href="{{ route('admin.contact-inquiries.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm stat-card h-100"><div class="card-body"><p class="text-secondary mb-1 small">New Inquiries</p><h2 class="h4 mb-0 text-dark">{{ $stats['new_inquiries'] }}</h2></div></div>
            </a>
        </div>
        <div class="col-6 col-lg-2">
            <a href="{{ route('admin.site-pages.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm stat-card h-100"><div class="card-body"><p class="text-secondary mb-1 small">Site Pages</p><h2 class="h4 mb-0 text-dark">{{ $stats['site_pages'] }}</h2></div></div>
            </a>
        </div>
        <div class="col-6 col-lg-2">
            <a href="{{ route('admin.services.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm stat-card h-100"><div class="card-body"><p class="text-secondary mb-1 small">Services (CMS)</p><h2 class="h4 mb-0 text-dark">{{ $stats['services'] }}</h2></div></div>
            </a>
        </div>
        <div class="col-6 col-lg-2">
            <a href="{{ route('admin.blog-posts.index') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm stat-card h-100"><div class="card-body"><p class="text-secondary mb-1 small">Blog Posts</p><h2 class="h4 mb-0 text-dark">{{ $stats['blog_posts'] }}</h2></div></div>
            </a>
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
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm premium-card">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h3 class="h5 mb-0 fw-bold">Recent Contact Inquiries</h3>
                    <a href="{{ route('admin.contact-inquiries.index') }}" class="btn btn-sm btn-outline-dark">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-premium mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentInquiries as $inquiry)
                                <tr>
                                    <td>
                                        <div class="fw-semibold">{{ $inquiry->first_name }} {{ $inquiry->last_name }}</div>
                                        <div class="text-muted small">{{ $inquiry->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td>{{ $inquiry->email }}</td>
                                    <td><span class="badge bg-light text-dark border">{{ $inquiry->status }}</span></td>
                                    <td class="text-end"><a href="{{ route('admin.contact-inquiries.show', $inquiry) }}" class="btn btn-sm btn-light border">View Details</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-secondary">
                                        <div class="mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-inbox text-light" viewBox="0 0 16 16">
                                                <path d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4H4.98zm9.954 5H10.45a2.5 2.5 0 0 1-4.9 0H1.066l.32 2.562a.5.5 0 0 0 .497.438h12.234a.5.5 0 0 0 .496-.438L14.933 9zM3.809 3.563A1.5 1.5 0 0 1 4.981 3h6.038a1.5 1.5 0 0 1 1.172.563l3.7 4.625a.5.5 0 0 1 .109.31V13a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8.5a.5.5 0 0 1 .11-.31l3.7-4.625z"/>
                                            </svg>
                                        </div>
                                        No inquiries yet.
                                    </td>
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
            <div class="card border-0 shadow-sm premium-card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h3 class="h5 mb-0 fw-bold">Latest Services</h3>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Manage All</a>
                </div>
                <div class="card-body p-2">
                    <div class="list-group list-group-flush">
                        @forelse ($recentServices as $service)
                            <a href="{{ route('admin.services.edit', $service) }}" class="list-group-item list-group-item-action border-0 py-3 rounded-3 mb-1">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="service-img-container shadow-sm border">
                                        @if ($service->image_url)
                                            <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="service-img">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center text-secondary bg-light h-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                    <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-grow-1">
                                        <div class="fw-bold text-dark mb-0">{{ $service->title }}</div>
                                        <div class="text-muted small text-truncate">{{ $service->slug }}</div>
                                    </div>
                                    <div class="text-primary opacity-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="p-4 text-center text-muted">
                                <p class="mb-0 small">No services available.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm premium-card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h3 class="h5 mb-0 fw-bold">Latest Blog Posts</h3>
                    <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Manage All</a>
                </div>
                <div class="card-body p-2">
                    <div class="list-group list-group-flush">
                        @forelse ($recentBlogPosts as $blogPost)
                            <a href="{{ route('admin.blog-posts.edit', $blogPost) }}" class="list-group-item list-group-item-action border-0 py-3 rounded-3 mb-1">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="service-img-container shadow-sm border">
                                        @if ($blogPost->cover_image_url)
                                            <img src="{{ $blogPost->cover_image_url }}" alt="{{ $blogPost->title }}" class="service-img">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center text-secondary bg-light h-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                                    <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-grow-1">
                                        <div class="fw-bold text-dark mb-0">{{ $blogPost->title }}</div>
                                        <div class="text-muted small text-truncate">{{ $blogPost->slug }}</div>
                                    </div>
                                    <div class="text-primary opacity-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="p-4 text-center text-muted">
                                <p class="mb-0 small">No blog posts available.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
