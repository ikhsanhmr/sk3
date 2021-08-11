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
  <h1 class="h3 mb-0 text-gray-800">Edit Unit</h1>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <form action="{{ route('editUnit') }}" method="post">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="kantor_induk">Kantor Induk</label>
            <select class="form-control" name="kantor_induk" id="kantor_induk" disabled>
              <option value=""> -- Pilih Kantor Induk -- </option>
              @foreach($kantor_induks as $key => $row)
              @if($row->id == $kantor_induk->id)
              <option value="{{ $row->id }}" selected>{{ $row->nama_kantor_induk }}</option>
              @else
              <option value="{{ $row->id }}">{{ $row->nama_kantor_induk }}</option>
              @endif
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="unit_level2">Unit Level 2</label>
            <select class="form-control" name="unit_level2" id="unit_level2">
              <option value=""> -- Pilih Unit Level 2 -- </option>
              @foreach($unit_level2s as $key => $row)

              @if($row->id == $unit_level2->id)
              <option value="{{ $row->id }}" selected>{{ $row->nama_unit_level2 }}</option>
              @elseif($row->kantor_induk_id == $kantor_induk->id)
              <option value="{{ $row->id }}">{{ $row->nama_unit_level2 }}</option>
              @endif

              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="unit_level3">Nama Unit Level 3</label>
            <input type="text" class="form-control" value="{{ $unit_level3->nama_unit_level3 }}" name="unit_level3" id="unit_level3" placeholder="Masukan nama unit level 3">
          </div>
          <input type="hidden" name="id" id="id" value="{{ $unit_level3->id }}">
          <a href="{{ route('unit') }}" class="btn btn-warning btn-sm">
            Kembali
          </a>
          <button class="btn btn-primary btn-sm" type="submit">
            Simpan
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
