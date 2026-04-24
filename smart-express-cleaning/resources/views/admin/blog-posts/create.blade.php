@extends('admin.layout')

@section('title', 'Create Blog Post')

@section('content')
    <h1 class="h3 mb-3">Create Blog Post</h1>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.blog-posts.store') }}">
                @csrf
                @php($buttonLabel = 'Create Blog Post')
                @include('admin.blog-posts._form')
            </form>
        </div>
    </div>
@endsection

