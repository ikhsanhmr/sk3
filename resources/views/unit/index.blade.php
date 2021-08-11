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

<a href="/restore"> restore</a>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">List Unit</h1>
</div>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="pills-unit_level3-tab" data-toggle="pill" href="#pills-unit_level3" role="tab" aria-controls="pills-unit_level3" aria-selected="true">Unit level 3</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-unit_level2-tab" data-toggle="pill" href="#pills-unit_level2" role="tab" aria-controls="pills-unit_level2" aria-selected="false">Unit Level 2</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-kantor-induk-tab" data-toggle="pill" href="#pills-kantor-induk" role="tab" aria-controls="pills-kantor-induk" aria-selected="false">Kantor Induk</a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-unit_level3" role="tabpanel" aria-labelledby="pills-unit_level3-tab">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        {{-- <a class="m-0 btn btn-primary btn-sm font-weight-bold" href="{{ url('/admin/unit/add') }}">Tambah Unit</a> --}}
        <a class="m-0 btn btn-primary btn-sm font-weight-bold" href="{{ url('/admin/unit/add/unitlevel3') }}">Tambah Unit Level 3</a>
      </div>
      <div class="card-body">
        <small>Info : Data yang tampil ditabel adalah data yang merujuk pada unit level 3 saja</small>
        {{-- TABEL UNIT LEVEL 3 --}}
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Kantor Induk <small>Level 1</small></th>
                <th>Level 2</th>
                <th>Level 3</th>
                <th>Wilayah</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($units as $key => $unit)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $unit->unitlevel2->kantorinduk->nama_kantor_induk }}</td>
                <td>{{ $unit->unitlevel2->nama_unit_level2 }}</td>
                <td>{{ $unit->nama_unit_level3 }}</td>
                <td>{{ $unit->unitlevel2->kantorinduk->wilayah_kerja == 1 ? 'Sumut 1' : 'Sumut 2'  }}</td>
                <td>
                  <a href="{{ url('/admin/unit/edit', $unit->id) }}" class="btn btn-warning btn-sm btn-circle"><i class="fa fa-pen"></i></a>
                  <a class="btn btn-danger btn-circle btn-sm button-delete" data-id="{{ $unit->id }}" data-type="UNIT_LEVEL3" data-toggle="modal" data-target="#deleteModal">
                    <i class="fas fa-trash-alt fa-sm fa-fw"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="pills-unit_level2" role="tabpanel" aria-labelledby="pills-unit_level2-tab">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <a class="m-0 btn btn-primary btn-sm font-weight-bold" href="{{ url('/admin/unit/add/unitlevel2') }}">Tambah Unit Level 2</a>
      </div>
      <div class="card-body">
        {{-- TABEL UNIT LEVEL 2 --}}
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTableUnitLevel2" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Kantor Induk <small>Level 1</small></th>
                <th>Level 2</th>
                <th>Wilayah</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($unit_level2 as $key => $unit)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $unit->kantorinduk->nama_kantor_induk }}</td>
                <td>{{ $unit->nama_unit_level2 }}</td>
                <td>{{ $unit->kantorinduk->wilayah_kerja == 1 ? 'Sumut 1' : 'Sumut 2'  }}</td>
                <td>
                  <a href="{{ url('/admin/unit/edit/unitlevel2', $unit->id) }}" class="btn btn-warning btn-sm btn-circle"><i class="fa fa-pen"></i></a>
                  <a class="btn btn-danger btn-circle btn-sm button-delete" data-id="{{ $unit->id }}" data-type="UNIT_LEVEL2" data-toggle="modal" data-target="#deleteModal">
                    <i class="fas fa-trash-alt fa-sm fa-fw"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="pills-kantor-induk" role="tabpanel" aria-labelledby="pills-kantor-induk-tab">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <a class="m-0 btn btn-primary btn-sm font-weight-bold" href="{{ url('/admin/unit/add/kantorinduk') }}">Tambah Unit Kantor Induk</a>
      </div>
      <div class="card-body">
        {{-- TABEL KANTOR INDUK --}}
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTableKantorInduk" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Kantor Induk <small>Level 1</small></th>
                <th>Wilayah</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($kantor_induk as $key => $unit)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $unit->nama_kantor_induk }}</td>
                <td>{{ $unit->wilayah_kerja == 1 ? 'Sumut 1' : 'Sumut 2'  }}</td>
                <td>
                  <a href="{{ url('/admin/unit/edit/kantorinduk', $unit->id) }}" class="btn btn-warning btn-sm btn-circle"><i class="fa fa-pen"></i></a>
                  <a class="btn btn-danger btn-circle btn-sm button-delete" data-id="{{ $unit->id }}" data-type="UNIT_LEVEL1" data-toggle="modal" data-target="#deleteModal">
                    <i class="fas fa-trash-alt fa-sm fa-fw"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hapus?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin akan menghapus data?</p>
        <small>Warning : Data yang terkait akan terhapus juga</small>
      </div>
      <div class="modal-footer">
        <form action="{{ url('/admin/unit') }}" method="post">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <input type="hidden" name="type" id="type" class="type">
          <input type="hidden" name="id" id="id" class="id">
          <button type="submit" class="btn btn-danger">Hapus</button>
          @csrf
          @method('delete')
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script>
  $('#dataTableKantorInduk').dataTable()
  $('#dataTableUnitLevel2').dataTable()

  $('#dataTable').on('click', '.button-delete', function() {
    console.log('ok')

    let id = $(this).data('id')
    let type = $(this).data('type')

    $('.id').val(id)
    $('.type').val(type)
  })

  $('#dataTableUnitLevel2').on('click', '.button-delete', function() {
    console.log('ok2')

    let id = $(this).data('id')
    let type = $(this).data('type')

    $('.id').val(id)
    $('.type').val(type)
  })

  $('#dataTableKantorInduk').on('click', '.button-delete', function() {
    console.log('ok3')

    let id = $(this).data('id')
    let type = $(this).data('type')

    $('.id').val(id)
    $('.type').val(type)
  })

</script>
@endsection
