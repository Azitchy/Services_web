@extends('admin.layout')

@section('title', 'Edit Why Choose Us Item')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Why Choose Us Item</h1>
    <a href="{{ route('admin.why-choose-us.index') }}" class="btn btn-secondary">Back to List</a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin.why-choose-us.update', $whyChooseUs) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $whyChooseUs->title) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="text" class="form-label">Text <span class="text-danger">*</span></label>
                <textarea class="form-control" id="text" name="text" rows="3" required>{{ old('text', $whyChooseUs->text) }}</textarea>
            </div>
            
            <div class="mb-3">
                <label for="order" class="form-label">Display Order <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $whyChooseUs->order) }}" min="0" required>
                <div class="form-text">Items are displayed in ascending order (0, 1, 2...).</div>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Item</button>
        </form>
    </div>
</div>
@endsection
