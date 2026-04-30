@extends('admin.layout')

@section('title', 'Site Settings')

@section('content')
    <div class="mb-3">
        <h1 class="h3 mb-0">Site Settings</h1>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <h5 class="mb-3">Footer Information</h5>
                
                <div class="mb-3">
                    <label class="form-label">Company Name</label>
                    <input type="text" name="settings[company_name]" class="form-control" value="{{ $settings['company_name'] ?? 'Smart Express Cleaning Services' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Footer Address Title</label>
                    <input type="text" name="settings[footer_address_title]" class="form-control" value="{{ $settings['footer_address_title'] ?? 'HEAD OFFICE' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Footer Description / Address</label>
                    <textarea name="settings[footer_description]" class="form-control" rows="3">{{ $settings['footer_description'] ?? 'From deep cleans to holiday home turnarounds, we keep spaces sparkling and guest-ready. Kathmandu, Nepal.' }}</textarea>
                </div>

                <hr class="my-4">

                <h5 class="mb-3">Contact Information</h5>

                <div class="mb-3">
                    <label class="form-label">Contact Email</label>
                    <input type="email" name="settings[contact_email]" class="form-control" value="{{ $settings['contact_email'] ?? 'demo@example.com' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Contact Phone</label>
                    <input type="text" name="settings[contact_phone]" class="form-control" value="{{ $settings['contact_phone'] ?? '+977 9800000000' }}">
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-dark">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
@endsection
