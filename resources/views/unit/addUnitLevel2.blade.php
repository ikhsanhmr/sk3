@extends('layout.tamplate')
@section('title', 'List Unit | AIL')
@section('content')
@if(session('errors'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  Something it's wrong:
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Tambah Unit Level 2</h1>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <form action="{{ route('addUnitLevel2') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="kantor_induk">Kantor Induk</label>
            <select class="form-control" name="kantor_induk" id="kantor_induk">
              <option value=""> -- Pilih Kantor Induk -- </option>
              @foreach($kantor_induk as $key => $row)
              <option value="{{ $row->id }}">{{ $row->nama_kantor_induk }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="unit_level2">Nama Unit Level 2</label>
            <input type="text" class="form-control" name="unit_level2" id="unit_level2" placeholder="Masukan nama unit level 2">
          </div>
          <a href="{{ route('unit') }}" class="btn btn-warning btn-sm text-dark">Kembali</a>
          <button class="btn btn-primary btn-sm" type="submit">
            Simpan
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
