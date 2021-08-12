@extends('layout.template')

@section('title')
SK3 | Add Unit
@endsection


@section('content-header')
@endsection

@section('content-body')
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
  <h1 class="h3 mb-0 text-gray-800">Tambah Unit</h1>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <form action="{{ route('addUnit') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="wilayah_kerja">Wilayah Kerja</label>
            <select class="form-control" name="wilayah_kerja" id="wilayah_kerja">
              <option value=""> -- Pilih Wilayah Kerja -- </option>
              <option value="1">Sumut 1</option>
              <option value="2">Sumut 2</option>
            </select>
          </div>
          <div class="form-group">
            <label for="kantor_induk">Nama Kantor Induk</label>
            <input type="text" class="form-control" name="kantor_induk" id="kantor_induk" placeholder="Masukan nama kantor induk">
          </div>
          <div class="form-group">
            <label for="unit_level2">Nama Unit Level 2</label>
            <input type="text" class="form-control" name="unit_level2" id="unit_level2" placeholder="Masukan nama unit level 2">
          </div>
          <div class="form-group">
            <label for="unit_level3">Nama Unit Level 3</label>
            <input type="text" class="form-control" name="unit_level3" id="unit_level3" placeholder="Masukan nama unit level 3">
          </div>
          <button class="btn btn-primary btn-sm" type="submit">
            Simpan
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
