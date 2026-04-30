<section class="section-shell" id="contact">
    <div class="container">
        <div class="row g-4 align-items-stretch justify-content-center">
            <div class="col-lg-5 fade-up">
                <div class="h-100 w-100" style="min-height: 400px; border-radius: 24px; overflow: hidden; box-shadow: 0 22px 45px rgba(18, 32, 50, 0.08);">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3608.167126519072!2d55.31964689999999!3d25.2649628!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5d00014cdd8d%3A0x6ca9a38124f91c81!2sAl%20Fahad%20plaza!5e0!3m2!1sen!2snp!4v1777521339389!5m2!1sen!2snp" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="contact-box fade-up h-100 d-flex flex-column justify-content-center">
                    <h2 class="section-title mb-2">Get in Touch for a Custom Quote!</h2>
                    <p class="text-secondary mb-4">Tell us about your property portfolio and cleaning needs. We will send a tailored plan.</p>
                    
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
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">First name</label>
                                <input type="text" name="first_name" class="form-control" placeholder="First name" value="{{ old('first_name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last name</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last name" value="{{ old('last_name') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="you@email.com" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Company name</label>
                                <input type="text" name="company_name" class="form-control" placeholder="Smart Stays LLC" value="{{ old('company_name') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Spill the details (we will contact it up)</label>
                                <textarea name="message" class="form-control" rows="4" placeholder="Number of properties, locations, cleaning frequency..." required>{{ old('message') }}</textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn-pop">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
