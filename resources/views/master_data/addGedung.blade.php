@extends('layout.template')

@section('title')
SK3 | Add Gedung
@endsection


@section('content-header')
<b>Add Gedung</b>
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
{{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Tambah Kantor Induk</h1>
</div> --}}
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <form>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                <label for="">Kantor Induk</label>
                <select type="text" class="form-control" name='kantor_induk' id="kantor_induk">
                    <option value="" disabled selected>--- Pilih ---</option>
                    @foreach ($kantor_induk as $induk)
                        <option value="{{$induk->id}}">{{$induk->nama_kantor_induk}}</option>
                    @endforeach
                  </select>
              </div>

              <div class="form-group">
                <label for="">Unit Level 2</label>
                <select type="text" class="form-control" name='unit_level2' id="unit_level2">
                    <option value="" disabled selected>--- Pilih ---</option>
                    <option value=""></option>
                  </select>
              </div>

              <div class="form-group">
                <label for="">Unit Level 3</label>
                <select type="text" class="form-control" name='unit_level3' id="unit_level3">
                    <option value="" disabled selected>--- Pilih ---</option>
                    <option value=""></option>
                  </select>
              </div>
              <a href="{{ route('masterData') }}" class="btn btn-warning btn-sm text-dark">Kembali</a>
              <button class="btn btn-primary btn-sm" type="submit">
                Simpan
              </button>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                <label for="">Nama Gedung</label>
                <input type="text" class="form-control" name="kantor_induk" id="kantor_induk" placeholder="Nama Gedung">
              </div>
              <div class="form-group">
                <label for="">Company Code</label>
                <input type="text" class="form-control" name="unit_level2" id="unit_level2" placeholder="Company code">
              </div>
              <div class="form-group">
                <label for="">Busines Area</label>
                <input type="text" class="form-control" name="unit_level3" id="unit_level3" placeholder="Busines Area">
              </div>
          </div>
        </div>
      </form>
  </div>
</div>
@endsection
