@extends('admin.layout')

@section('title', 'Edit Service')

@section('content')
    <h1 class="h3 mb-3">Edit Service: {{ $service->title }}</h1>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.services.update', $service) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @php($buttonLabel = 'Update Service')
                @include('admin.services._form')
            </form>
        </div>
    </div>
@endsection

