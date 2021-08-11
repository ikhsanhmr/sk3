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
  <h1 class="h3 mb-0 text-gray-800">Edit Unit Level 2</h1>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <form action="{{ route('editUnitLevel2') }}" method="post">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="kantor_induk_id">Kantor Induk</label>
            <select class="form-control" name="kantor_induk_id" id="kantor_induk_id">
              @foreach($kantor_induks as $key => $kantor_induk)
              <option value="{{ $kantor_induk->id }}">{{ $kantor_induk->nama_kantor_induk }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="unit_level2">Nama Unit Level 2</label>
            <input type="text" class="form-control" value="{{ $unit_level2->nama_unit_level2 }}" name="unit_level2" id="unit_level2" placeholder="Masukan nama unit level 2">
          </div>

          <input type="hidden" name="id" id="id" value="{{ $unit_level2->id }}">

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

@section('script')
<script>
  $('#kantor_induk_id').val('{{$unit_level2->kantor_induk_id}}').change()

</script>
@endsection
