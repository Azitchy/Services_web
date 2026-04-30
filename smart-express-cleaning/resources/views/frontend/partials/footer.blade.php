<footer class="site-footer py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-7">
                <h3 class="h2 mb-2">{{ $settings['company_name'] ?? 'Smart Express Cleaning Services' }}</h3>
                <h4 class="h6 text-uppercase text-secondary">{{ $settings['footer_address_title'] ?? 'Head Office' }}</h4>
                <p class="mb-0">{{ $settings['footer_description'] ?? 'From deep cleans to holiday home turnarounds, we keep spaces sparkling and guest-ready. Kathmandu, Nepal.' }}</p>
            </div>
            <div class="col-lg-5">
                <h4 class="h6 text-uppercase text-secondary">Quick Links</h4>
                <p class="mb-1"><a class="footer-link" href="{{ route('about') }}">About Us</a></p>
                <p class="mb-1"><a class="footer-link" href="{{ route('services') }}">Our Services</a></p>
                <p class="mb-3"><a class="footer-link" href="{{ route('blogs.index') }}">Blogs</a></p>
                <h4 class="h6 text-uppercase text-secondary">Contact</h4>
                <p class="mb-1">{{ $settings['contact_email'] ?? 'demo@example.com' }}</p>
                <p class="mb-0">{{ $settings['contact_phone'] ?? '+977 9800000000' }}</p>
            </div>
        </div>
    </div>
</footer>
