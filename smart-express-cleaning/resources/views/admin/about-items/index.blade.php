@extends('admin.layout')

@section('title', 'About Us Content')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">About Us Content Sections</h1>
        <a href="{{ route('admin.about-items.create') }}" class="btn btn-dark btn-sm">Add New Item</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Sort Order</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $item->type === 'who_we_are' ? 'Who We Are' : 'What We Deliver' }}
                                </span>
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->sort_order }}</td>
                            <td>
                                @if ($item->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.about-items.edit', $item) }}" class="btn btn-sm btn-outline-dark">Edit</a>
                                <form action="{{ route('admin.about-items.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this item?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary py-4">No content items found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
