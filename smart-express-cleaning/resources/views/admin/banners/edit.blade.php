@extends('admin.layout')

@section('title', 'Edit Banner')

@section('content')
    <div class="mb-4">
        <h1 class="h3 mb-0">Edit Banner</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}" class="text-dark">Banners</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Banner</li>
            </ol>
        </nav>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.banners._form')
    </form>
@endsection
