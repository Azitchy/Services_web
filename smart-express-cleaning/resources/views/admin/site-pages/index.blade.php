@extends('admin.layout')

@section('title', 'Site Pages')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Site Pages</h1>
        <a href="{{ route('admin.site-pages.create') }}" class="btn btn-dark btn-sm">Add Site Page</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Name</th>
                        <th>Hero Title</th>
                        <th>Status</th>
                        <th>Updated</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sitePages as $sitePage)
                        <tr>
                            <td><code>{{ $sitePage->page_key }}</code></td>
                            <td>{{ $sitePage->name }}</td>
                            <td>{{ $sitePage->hero_title }}</td>
                            <td>
                                @if ($sitePage->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $sitePage->updated_at->format('Y-m-d H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.site-pages.edit', $sitePage) }}" class="btn btn-sm btn-outline-dark">Edit</a>
                                <form action="{{ route('admin.site-pages.destroy', $sitePage) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this page?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-secondary py-4">No site pages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $sitePages->links() }}
    </div>
@endsection

