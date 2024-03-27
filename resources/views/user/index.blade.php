@extends('user/template')
@section('content')
<div class="row mt-5 mb-5">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>CRUD User</h2>
        </div>
        <div class="float-right">
            <a href="{{ route('user.create') }}" class="btn btn-success">Input User</a>
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
        <th class="text-center" width="150px">Password</th>
    </tr>
    @foreach ( $useri as $m_user )
    <tr>
        <td>{{ $m_user->user_id }}</td>
        <td>{{ $m_user->level_id }}</td>
        <td>{{ $m_user->username }}</td>
        <td>{{ $m_user->nama }}</td>
        <td>{{ $m_user->password }}</td>
        <td>
            <form method="POST" action="{{ route('user.destroy', $m_user->user_id)}}">
                <a class="btn btn-info btn-sm" href="{{ route('user.show', $m_user->user_id )}}">Show</a>
                <a class="btn btn-primary btn-sm" href="{{ route('user.edit', $m_user->user_id )}}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin Ingin Mengahpus Data Ini?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection