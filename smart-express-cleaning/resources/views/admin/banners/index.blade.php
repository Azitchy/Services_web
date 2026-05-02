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
                                    @if($banner->isVideo())
                                        <div class="bg-light d-flex align-items-center justify-content-center rounded border" style="width: 100px; height: 50px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-play-circle-fill text-primary" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.79 5.093A.5.5 0 0 0 6 5.5v5a.5.5 0 0 0 .79.407l3.5-2.5a.5.5 0 0 0 0-.814l-3.5-2.5z"/>
                                            </svg>
                                        </div>
                                    @else
                                        <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" style="width: 100px; height: 50px; object-fit: cover; border-radius: .25rem;">
                                    @endif
                                @else
                                    <span class="text-secondary small">No media</span>
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
