<section class="section-shell" id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="contact-box fade-up">
                    <div class="row g-4">
                        <div class="col-lg-5">
                            <h2 class="section-title mb-2">Get in Touch for a Custom Quote!</h2>
                            <p class="text-secondary mb-0">Tell us about your property portfolio and cleaning needs. We will send a tailored plan.</p>
                        </div>
                        <div class="col-lg-7">
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
                                        <input type="text" name="first_name" class="form-control" placeholder="Ava" value="{{ old('first_name') }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Last name</label>
                                        <input type="text" name="last_name" class="form-control" placeholder="Patel" value="{{ old('last_name') }}" required>
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
                                        <label class="form-label">Spill the details (we will mop it up)</label>
                                        <textarea name="message" class="form-control" rows="4" placeholder="Number of properties, locations, cleaning frequency..." required>{{ old('message') }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn-pop">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
