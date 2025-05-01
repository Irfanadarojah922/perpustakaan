@extends("layout.app")
@section("title", "Permission")
@section("header", "Permission")

@push ("css-libs")
    <meta name="csrf_token" content="{{csrf_token()}}" />
@endpush

@section("content")
<!-- Content -->
@endsection