@extends('admin.layout')

@section('title', 'Edit About Content')

@section('content')
    <h1 class="h3 mb-3">Edit About Us Content</h1>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.about-items.update', $about_item) }}">
                @csrf
                @method('PUT')
                @php($item = $about_item)
                @php($buttonLabel = 'Update Item')
                @include('admin.about-items._form')
            </form>
        </div>
    </div>
@endsection
