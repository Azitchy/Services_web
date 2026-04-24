@extends('admin.layout')

@section('title', 'Edit Site Page')

@section('content')
    <h1 class="h3 mb-3">Edit Site Page: {{ $sitePage->name }}</h1>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.site-pages.update', $sitePage) }}">
                @csrf
                @method('PUT')
                @php($buttonLabel = 'Update Page')
                @include('admin.site-pages._form')
            </form>
        </div>
    </div>
@endsection

