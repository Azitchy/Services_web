@extends('admin.layout')

@section('title', 'Add About Content')

@section('content')
    <h1 class="h3 mb-3">Add New About Us Content</h1>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.about-items.store') }}">
                @csrf
                @php($buttonLabel = 'Create Item')
                @include('admin.about-items._form')
            </form>
        </div>
    </div>
@endsection
