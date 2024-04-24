@extends('layout.template')

{{-- Custom layout section --}}
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('kategori/create') 
                }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover table-sm"
            id="table_kategori">
                <thead>
                    <tr><th>Kategori Id</th><th>Kategori Kode</th><th>Kategori Nama</th><th>Aksi</th></tr>
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
        var dataUser = $('#table_kategori').DataTable({
        serverSide: true,
        ajax: {
        "url": "{{ url('kategori/list') }}",
        "dataType": "json",
        "type": "POST"
        },
        columns: [
            {
            data: "kategori_id", 
            className: "",
            orderable: true, 
            searchable: true 
            },{
            data: "kategori_kode", 
            className: "",
            orderable: true, 
            searchable: true 
            },{
            data: "kategori_nama", 
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