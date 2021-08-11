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
  <h1 class="h3 mb-0 text-gray-800">Tambah Unit Level 3</h1>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <form action="{{ route('addUnitLevel3') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="unit_level2">Unit Level 2</label>
            <select class="form-control" name="unit_level2" id="unit_level2">
              <option value=""> -- Pilih unit Level 2 -- </option>
              @foreach($unit_level2 as $key => $row)
              <option value="{{ $row->id }}">{{ $row->nama_unit_level2 }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="unit_level3">Nama Unit Level 3</label>
            <input type="text" class="form-control" name="unit_level3" id="unit_level3" placeholder="Masukan nama unit level 3">
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
