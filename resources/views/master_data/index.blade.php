@extends('layout.template')

@section('title')
SK3 | Unit
@endsection


@section('content-header')
<ul class="nav nav-pills" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="pills_master_gedung-tab" data-toggle="pill" href="#pills_master_gedung" role="tab" aria-controls="pills_master_gedung" aria-selected="true">Master Gedung</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="pills_master_lantai-tab" data-toggle="pill" href="#pills_master_lantai" role="tab" aria-controls="pills_master_lantai" aria-selected="false">Master Lantai</a>
    </li>
  </ul>
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
@if (Session::has('success'))
<div class="alert alert-success">
  {{ Session::get('success') }}
</div>
@endif
@if (Session::has('warning'))
<div class="alert alert-warning">
  {{ Session::get('warning') }}
</div>
@endif
@if (Session::has('error'))
<div class="alert alert-danger">
  {{ Session::get('error') }}
</div>
@endif

{{-- <a href="/restore"> restore</a>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">List Unit</h1>
</div> --}}
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills_master_gedung" role="tabpanel" aria-labelledby="pills_master_gedung-tab">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        {{-- <a class="m-0 btn btn-primary btn-sm font-weight-bold" href="{{ url('/admin/unit/add') }}">Tambah Unit</a> --}}
        <a class="m-0 btn btn-primary btn-sm font-weight-bold" href="{{route('addGedung')}}">Tambah Gedung</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Kantor Induk</th>
                <th>Level 2</th>
                <th>Level 3</th>
                <th>Nama Gedung</th>
                <th>Tanggal Input</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="pills_master_lantai" role="tabpanel" aria-labelledby="pills_master_lantai-tab">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <a class="m-0 btn btn-primary btn-sm font-weight-bold" href="">Tambah Lantai</a>
      </div>
      <div class="card-body">
        {{-- TABEL UNIT LEVEL 2 --}}
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTableUnitLevel2" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Kantor Induk</th>
                <th>Level 2</th>
                <th>Level 3</th>
                <th>Nama Lantai</th>
                <th>Nama Gedung</th>
                <th>Tanggal Input</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection

