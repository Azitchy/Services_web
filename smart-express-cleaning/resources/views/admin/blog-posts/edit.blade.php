@extends('admin.layout')

@section('title', 'Edit Blog Post')

@section('content')
    <h1 class="h3 mb-3">Edit Blog Post: {{ $blogPost->title }}</h1>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.blog-posts.update', $blogPost) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @php($buttonLabel = 'Update Blog Post')
                @include('admin.blog-posts._form')
            </form>
        </div>
    </div>
@endsection

