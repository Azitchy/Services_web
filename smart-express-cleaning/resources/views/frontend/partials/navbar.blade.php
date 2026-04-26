<nav class="navbar navbar-expand-lg navbar-dark fixed-top site-nav">
    <div class="container">
        <a class="navbar-brand brand-mark" href="{{ route('home') }}">Smart Express Cleaning Services</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto gap-lg-2 align-items-lg-center">
                <li class="nav-item"><a class="nav-link @if(request()->routeIs('home')) active @endif" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link @if(request()->routeIs('about')) active @endif" href="{{ route('about') }}">About Us</a></li>
                <li class="nav-item"><a class="nav-link @if(request()->routeIs('services')) active @endif" href="{{ route('services') }}">Our Services</a></li>
                <li class="nav-item"><a class="nav-link @if(request()->routeIs('blogs.*')) active @endif" href="{{ route('blogs.index') }}">Blogs</a></li>
                <li class="nav-item ms-lg-2">
                    <a class="btn btn-sm btn-pop" href="{{ route('home') }}#contact">Enquiry</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
