@extends('admin.layout')

@section('title', 'Contact Inquiries')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Contact Inquiries</h1>
        <form method="GET" class="d-flex gap-2">
            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">All statuses</option>
                <option value="new" @selected($selectedStatus === 'new')>New</option>
                <option value="in_progress" @selected($selectedStatus === 'in_progress')>In progress</option>
                <option value="resolved" @selected($selectedStatus === 'resolved')>Resolved</option>
            </select>
        </form>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Status</th>
                        <th>Submitted</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($inquiries as $inquiry)
                        <tr>
                            <td>{{ $inquiry->id }}</td>
                            <td>{{ $inquiry->first_name }} {{ $inquiry->last_name }}</td>
                            <td>{{ $inquiry->email }}</td>
                            <td>{{ $inquiry->company_name ?: '-' }}</td>
                            <td><span class="badge bg-secondary">{{ $inquiry->status }}</span></td>
                            <td>{{ $inquiry->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.contact-inquiries.show', $inquiry) }}" class="btn btn-sm btn-outline-dark">Open</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-secondary py-4">No inquiries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $inquiries->links() }}
    </div>
@endsection
