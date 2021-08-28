@extends('layout.template')

@section('title')
SK3 | Eviden
@endsection


@section('content-header')
<h5>Eviden</h5>
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
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a class="m-0 btn btn-primary btn-sm font-weight-bold" href="{{route('showFormEviden')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Eviden</a>
    </div>
    <div class="card-body pt-0">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>Jadwal</th>
              <th>Url</th>
              <th>Pdf</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($eviden as  $key => $value)
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$value->Jadwal->deskripsi}}</td>
                <td>
                    @if($value->url == NULL)
                    <i class="fas fa-exclamation text-danger"></i>
                    @else
                    <i class="fas fa-check text-success"></i>
                    @endif
                </td>
                <td>
                    @if($value->pdf == NULL)
                    <i class="fas fa-exclamation text-danger"></i>
                    @else
                    <i class="fas fa-check text-success"></i>
                    @endif
                </td>
              <td>
                  <a href="{{route('editEviden',$value->id)}}" class="btn btn-warning btn-sm btn-circle mr-2 btn-modal-edit"><i class="fa fa-pen"></i></a>
                  <a href="{{route('deleteEviden',$value->id)}}" class="btn btn-danger btn-sm btn-circle mr-2 btn-modal-edit"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script>
    $('#dataTable').dataTable()
</script>
@endsection

