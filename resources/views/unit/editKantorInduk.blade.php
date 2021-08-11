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
  <h1 class="h3 mb-0 text-gray-800">Edit Kantor Induk</h1>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <form action="{{ route('editKantorInduk') }}" method="post">
          @csrf
          @method('put')
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
            <input type="text" class="form-control" value="{{ $kantor_induk->nama_kantor_induk }}" name="kantor_induk" id="kantor_induk" placeholder="Masukan nama kantor induk">
          </div>

          <input type="hidden" name="id" id="id" value="{{ $kantor_induk->id }}">
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
  $('#wilayah_kerja').val('{{$kantor_induk -> wilayah_kerja}}').change()

</script>
@endsection
