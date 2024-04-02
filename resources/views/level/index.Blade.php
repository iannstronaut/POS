@extends('user/template')
@section('content')
<div class="row mt-5 mb-5">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>CRUD Level</h2>
        </div>
        <div class="float-right">
            <a href="{{ route('user.create') }}" class="btn btn-success">Input Level</a>
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
    <tr>
        <th class="text-center" width="20px">User Id</th>
        <th class="text-center" width="150px">Level Id</th>
        <th class="text-center" width="200px">Username</th>
        <th class="text-center" width="200px">Nama</th>
    </tr>
    @foreach ( $leveli as $level )
    <tr>
        <td>{{ $level->level_id }}</td>
        <td>{{ $level->level_kode }}</td>
        <td>{{ $level->level_nama }}</td>
        <td>
            <form method="POST" action="{{ route('user.destroy', $level->level_id)}}">
                <a class="btn btn-info btn-sm" href="{{ route('user.show', $level->level_id )}}">Show</a>
                <a class="btn btn-primary btn-sm" href="{{ route('user.edit', $level->level_id )}}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin Ingin Mengahpus Data Ini?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection