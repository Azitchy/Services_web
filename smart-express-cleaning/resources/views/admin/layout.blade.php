<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Smart Express Cleaning</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #eef1f4; }
        .admin-shell { min-height: 100vh; }
        .admin-sidebar { width: 250px; background: #2b313b; color: #c7d0db; min-height: 100vh; position: fixed; top: 0; left: 0; z-index: 1045; transform: translateX(-100%); transition: transform .2s ease; }
        body.sidebar-open .admin-sidebar { transform: translateX(0); }
        .sidebar-overlay { position: fixed; inset: 0; background: rgba(0, 0, 0, .45); z-index: 1040; display: none; }
        body.sidebar-open .sidebar-overlay { display: block; }
        .admin-brand { height: 58px; display: flex; align-items: center; padding: 0 1rem; color: #fff; text-decoration: none; font-weight: 700; border-bottom: 1px solid #39404d; }
        .admin-menu { padding: .75rem; }
        .admin-menu-link { display: block; color: #c7d0db; text-decoration: none; padding: .6rem .75rem; border-radius: .35rem; margin-bottom: .25rem; }
        .admin-menu-link:hover, .admin-menu-link.active { background: #3a4350; color: #fff; }
        .admin-content { min-width: 0; width: 100%; }
        .admin-topbar { height: 58px; background: #fff; border-bottom: 1px solid #dbe0e6; display: flex; align-items: center; justify-content: space-between; padding: 0 1rem; position: sticky; top: 0; z-index: 1030; }
        .admin-main { padding: 1.25rem; }
        .menu-toggle { border: 0; background: transparent; font-size: 1.3rem; color: #495057; line-height: 1; }
        @media (min-width: 992px) {
            .admin-sidebar { position: sticky; transform: none; }
            .sidebar-overlay { display: none !important; }
            .menu-toggle { display: none; }
        }
        @media (max-width: 991.98px) {
            .admin-main { padding: 1rem; }
        }
    </style>
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="d-flex admin-shell">
        <aside class="admin-sidebar" id="adminSidebar">
            <a class="admin-brand" href="{{ route('admin.dashboard') }}">Smart Express Admin</a>
            <nav class="admin-menu">
                <a class="admin-menu-link @if(request()->routeIs('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a class="admin-menu-link @if(request()->routeIs('admin.services.*')) active @endif" href="{{ route('admin.services.index') }}">Services</a>
                <a class="admin-menu-link @if(request()->routeIs('admin.blog-posts.*')) active @endif" href="{{ route('admin.blog-posts.index') }}">Blog Posts</a>
                <a class="admin-menu-link @if(request()->routeIs('admin.contact-inquiries.*')) active @endif" href="{{ route('admin.contact-inquiries.index') }}">Contact Inquiries</a>
                <a class="admin-menu-link" href="{{ route('home') }}" target="_blank">View Website</a>
                <form method="POST" action="{{ route('admin.logout') }}" class="mt-2">
                    @csrf
                    <button class="btn btn-sm btn-outline-light w-100" type="submit">Logout</button>
                </form>
            </nav>
        </aside>

        <div class="flex-grow-1 admin-content">
            <header class="admin-topbar">
                <div class="d-flex align-items-center gap-2">
                    <button class="menu-toggle" id="sidebarToggle" type="button" aria-label="Toggle menu">☰</button>
                    <span class="text-secondary small">Admin Panel</span>
                </div>
                <span class="text-secondary small">{{ auth()->user()->name }}</span>
            </header>

            <main class="admin-main">
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
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const sidebarLinks = document.querySelectorAll('.admin-menu-link');
        const closeSidebar = () => document.body.classList.remove('sidebar-open');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => document.body.classList.toggle('sidebar-open'));
        }
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeSidebar);
        }
        sidebarLinks.forEach((link) => link.addEventListener('click', () => {
            if (window.innerWidth < 992) {
                closeSidebar();
            }
        }));
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 992) {
                closeSidebar();
            }
        });
    </script>
</body>
</html>

