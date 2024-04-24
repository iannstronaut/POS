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
            id="table_stok">
                <thead>
                    <tr><th>Stok Id</th><th>Barang Id</th><th>User Id</th><th>Tanggal Stok</th><th>Jumlah</th><th>Aksi</th></tr>
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
        var dataUser = $('#table_stok').DataTable({
        serverSide: true,
        ajax: {
        "url": "{{ url('stok/list') }}",
        "dataType": "json",
        "type": "POST"
        },
        columns: [
            {
            data: "stok_id", 
            className: "",
            orderable: true, 
            searchable: true 
            },{
            data: "barang_id", 
            className: "",
            orderable: true, 
            searchable: true 
            },{
            data: "user_id", 
            className: "",
            orderable: true, 
            searchable: true 
            },{
            data: "stok_tanggal", 
            className: "",
            orderable: false,
            searchable: false
            },{
            data: "stok_jumlah", 
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