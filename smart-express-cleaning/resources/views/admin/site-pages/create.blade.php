@extends('admin.layout')

@section('title', 'Create Site Page')

@section('content')
    <h1 class="h3 mb-3">Create Site Page</h1>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.site-pages.store') }}">
                @csrf
                @php($buttonLabel = 'Create Page')
                @include('admin.site-pages._form')
            </form>
        </div>
    </div>
@endsection

