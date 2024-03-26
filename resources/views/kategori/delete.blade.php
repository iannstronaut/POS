@extends('layout.app')

{{-- Custom layout section --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Delete')

@section('content_body')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat Kategori Baru</h3>
            </div>

            <form id="deleteForm" action="/kategori/delete/{{ $d->kategori_id }}" method="POST">
                @csrf
                @method('DELETE')
                <h3>Apakah Anda Yakin untuk Menghapus Kategori {{ $d->kategori_nama}} dari Database</h3>
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
@endsection
