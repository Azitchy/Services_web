@extends('admin.layout')

@section('title', 'Banners')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Banners</h1>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-dark btn-sm">Add Banner</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Order</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($banners as $banner)
                        <tr>
                            <td>
                                @if ($banner->image_url)
                                    <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" style="width: 100px; height: 50px; object-fit: cover; border-radius: .25rem;">
                                @else
                                    <span class="text-secondary small">No image</span>
                                @endif
                            </td>
                            <td>{{ $banner->sort_order }}</td>
                            <td>{{ $banner->title ?: '-' }}</td>
                            <td>{{ $banner->subtitle ?: '-' }}</td>
                            <td>
                                @if ($banner->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-outline-dark">Edit</a>
                                <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}" class="d-inline" onsubmit="return confirm('Delete this banner?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-secondary py-4">No banners found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $banners->links() }}
    </div>
@endsection
