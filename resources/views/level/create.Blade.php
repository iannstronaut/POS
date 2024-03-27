@extends('adminlte::page')
@section('title', 'Create')
@section('content_header')
<h1>Create Level</h1>
@stop
@section('content')
<div class="card card-warning">
    <div class="card-header">
      <h3 class="card-title">Level Create Form</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form>
        <div class="col">
          <div class="col-sm-6">
            <!-- text input -->
            <div class="form-group">
              <label>Level Kode</label>
              <input type="text" class="form-control" placeholder="level_kode">
            </div>
            <div class="form-group">
              <label>Nama Kode</label>
              <input type="text" class="form-control" placeholder="level_nama">
            </div>
            <button type="submit" class="btn btn-primary w-25">Submit</button>
        </div>
      </form>
    </div>
  </div>
@stop
@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop
@section('js')
<script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop