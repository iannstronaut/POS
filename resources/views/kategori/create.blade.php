@extends('layout.app')

{{-- Custom layout section --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Wlcome')

@section('content_body')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Buat Kategori Baru</h3>
            </div>

            <form action="/kategori" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="kodeKategori">Kode Kategori</label>
                        <input type="text" name="kodeKategori" id="kodeKategori">
                    </div>
                    <div class="form-group">
                        <label for="kodeKategori">Nama Kategori</label>
                        <input type="text" name="namaKategori" id="namaKategori">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
