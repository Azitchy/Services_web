@extends('admin.layout')

@section('title', 'Inquiry #'.$contactInquiry->id)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Inquiry #{{ $contactInquiry->id }}</h1>
        <a href="{{ route('admin.contact-inquiries.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="h5">Client Details</h2>
                    <p class="mb-1"><strong>Name:</strong> {{ $contactInquiry->first_name }} {{ $contactInquiry->last_name }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $contactInquiry->email }}</p>
                    <p class="mb-1"><strong>Company:</strong> {{ $contactInquiry->company_name ?: '-' }}</p>
                    <p class="mb-1"><strong>IP:</strong> {{ $contactInquiry->ip_address ?: '-' }}</p>
                    <p class="mb-3"><strong>User Agent:</strong> {{ $contactInquiry->submitted_from ?: '-' }}</p>

                    <h3 class="h6 text-uppercase text-secondary">Message</h3>
                    <p class="mb-0">{{ $contactInquiry->message }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="h5 mb-3">Update Inquiry</h2>
                    <form method="POST" action="{{ route('admin.contact-inquiries.update', $contactInquiry) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="new" @selected($contactInquiry->status === 'new')>New</option>
                                <option value="in_progress" @selected($contactInquiry->status === 'in_progress')>In progress</option>
                                <option value="resolved" @selected($contactInquiry->status === 'resolved')>Resolved</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Admin notes</label>
                            <textarea name="admin_notes" rows="4" class="form-control">{{ old('admin_notes', $contactInquiry->admin_notes) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Save changes</button>
                    </form>

                    <form method="POST" action="{{ route('admin.contact-inquiries.destroy', $contactInquiry) }}" class="mt-3" onsubmit="return confirm('Delete this inquiry?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">Delete inquiry</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
