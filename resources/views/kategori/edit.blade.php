@extends('layout.app')

{{-- Custom layout section --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Update')

@section('content_body')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat Kategori Baru</h3>
            </div>

            <form action="/kategori/update/{{ $d->kategori_id}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="kodeKategori">Kode Kategori</label>
                        <input type="text" name="kodeKategori" id="kodeKategori" value="{{ $d->kategori_kode}}">
                    </div>
                    <div class="form-group">
                        <label for="kodeKategori">Nama Kategori</label>
                        <input type="text" name="namaKategori" id="namaKategori" value="{{ $d->kategori_nama}}">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
