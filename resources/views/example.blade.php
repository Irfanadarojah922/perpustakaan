@extends("layout.app")
@section("title", "Katalog")
@section("header", "Katalog")

@push ("css-libs")
    <meta name="csrf_token" content="{{csrf_token()}}" />
@endpush

@section("content")
<!-- Content -->
@endsection