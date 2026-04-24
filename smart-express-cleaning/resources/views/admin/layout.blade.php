<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Smart Express Cleaning</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .admin-link.active {
            font-weight: 700;
            color: #fff !important;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 999px;
            padding-left: .8rem;
            padding-right: .8rem;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Smart Express Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav" aria-controls="adminNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="adminNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link admin-link @if(request()->routeIs('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link admin-link @if(request()->routeIs('admin.site-pages.*')) active @endif" href="{{ route('admin.site-pages.index') }}">Site Pages</a></li>
                    <li class="nav-item"><a class="nav-link admin-link @if(request()->routeIs('admin.services.*')) active @endif" href="{{ route('admin.services.index') }}">Services</a></li>
                    <li class="nav-item"><a class="nav-link admin-link @if(request()->routeIs('admin.blog-posts.*')) active @endif" href="{{ route('admin.blog-posts.index') }}">Blog Posts</a></li>
                    <li class="nav-item"><a class="nav-link admin-link @if(request()->routeIs('admin.contact-inquiries.*')) active @endif" href="{{ route('admin.contact-inquiries.index') }}">Contact Inquiries</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}" target="_blank">View Website</a></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button class="btn btn-sm btn-outline-light" type="submit">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

