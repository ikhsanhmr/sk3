@extends('layout.template')

@section('title')
SK3 | Jadwal
@endsection


@section('content-header')
<h5>Jadwal</h5>
@endsection

@section('content-body')
<div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="10%">No.</th>
              <th width="25%">Nama</th>
              <th>NIP</th>
              <th width="25%">Email</th>
              <th width="20%">Status</th>
              {{-- <th>Password</th> --}}
              <th width="20%">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                  <a href="" class="btn btn-warning btn-sm btn-circle mr-2 btn-modal-edit"><i class="fa fa-pen"></i></a>
                  <a href="" class="btn btn-danger btn-sm btn-circle mr-2 btn-modal-edit"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
