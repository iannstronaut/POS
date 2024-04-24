@extends('layout.template')

{{-- Custom layout section --}}
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('barang/create') 
                }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success')}}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error')}}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select name="kategori_id" id="kategori_id" class="form-control" required>
                                <option value="">--Semua--</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->kategori_id}}">{{ $item->kategori_nama}}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Level Pengguna</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm"
            id="table_barang">
                <thead>
                    <tr><th>Barang Id</th><th>Kategori Id</th><th>Barang Kode</th><th>Barang Nama</th><th>Harga Beli</th><th>Harga Jual</th><th>Aksi</th></tr>
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
        var dataUser = $('#table_barang').DataTable({
        serverSide: true,
        ajax: {
        "url": "{{ url('barang/list') }}",
        "dataType": "json",
        "type": "POST",
        "data": function(d){
            d.kategori_id = $('#kategori_id').val();
        }
        },
        columns: [
            {
            data: "barang_id", 
            className: "",
            orderable: true, 
            searchable: true 
            },{
            data: "kategori_id", 
            className: "",
            orderable: true, 
            searchable: true 
            },{
            data: "barang_kode", 
            className: "",
            orderable: true, 
            searchable: true 
            },{
            data: "barang_nama", 
            className: "",
            orderable: false,
            searchable: false
            },{
            data: "harga_beli", 
            className: "",
            orderable: false,
            searchable: false
            },{
            data: "harga_beli", 
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

    $('#kategori_id').on('change', function(){
        dataUser.ajax.reload();
    });
});
</script>
@endpush