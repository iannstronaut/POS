@extends('layout.template')

{{-- Custom layout section --}}
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('user/create') 
                }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover table-sm"
            id="table_transaksi">
                <thead>
                    <tr><th>Penjualan Id</th><th>User Id</th><th>Pembeli</th><th>Kode Penjualan</th><th>Penjualan_tanggal</th><th>Aksi</th></tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    $(document).ready(function() {
        var dataUser = $('#table_transaksi').DataTable({
        serverSide: true,
        ajax: {
        "url": "{{ url('transaksi/list') }}",
        "dataType": "json",
        "type": "POST"
        },
        columns: [
            {
            data: "penjualan_id", 
            className: "",
            orderable: true, 
            searchable: true 
            },{
            data: "user_id", 
            className: "",
            orderable: true, 
            searchable: true 
            },{
            data: "pembeli", 
            className: "",
            orderable: true, 
            searchable: true 
            },{
            data: "penjualan_kode", 
            className: "",
            orderable: false,
            searchable: false
            },{
            data: "penjualan_tanggal", 
            className: "",
            orderable: false,
            searchable: false
            },{
            data: "aksi", 
            className: "",
            orderable: false, 
            searchable: false 
            }
        ]
    });
});
</script>
@endpush