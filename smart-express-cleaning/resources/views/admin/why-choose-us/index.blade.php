@extends('admin.layout')

@section('title', 'Why Choose Us')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Why Choose Us Items</h1>
    <a href="{{ route('admin.why-choose-us.create') }}" class="btn btn-primary">Add New Item</a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="5%">Order</th>
                        <th>Title</th>
                        <th>Text</th>
                        <th width="15%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>{{ $item->order }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ Str::limit($item->text, 50) }}</td>
                        <td>
                            <a href="{{ route('admin.why-choose-us.edit', $item) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('admin.why-choose-us.destroy', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No items found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
