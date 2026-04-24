@extends('admin.layout')

@section('title', 'Create Service')

@section('content')
    <h1 class="h3 mb-3">Create Service</h1>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.services.store') }}">
                @csrf
                @php($buttonLabel = 'Create Service')
                @include('admin.services._form')
            </form>
        </div>
    </div>
@endsection

