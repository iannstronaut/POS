@extends('layout.app')

{{-- Custom layout section --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Wlcome')

{{-- Custom body: main page content --}}

@section('content_body')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_costum.css"> --}}
@endpush

@push('js')
    <script> console.log("Hi, I'm using the Laravel AdminLTE package!")</script>
@endpush