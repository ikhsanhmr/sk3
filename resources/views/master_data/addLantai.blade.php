@extends('layout.template')

@section('title')
SK3 | Add Lantai
@endsection


@section('content-header')
<b>Add Lantai</b>
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
    <form action="{{route('addLantai')}}" method="POST">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                <label for="">Kantor Induk</label>
                <select type="text" class="form-control" name='kantor_induk' id="kantor_induk">
                    <option value="" disabled selected>Kantor induk</option>
                    @foreach ($kantor_induk as $induk)
                        <option value="{{$induk->id}}">{{$induk->nama_kantor_induk}}</option>
                    @endforeach
                  </select>
              </div>

              <div class="form-group">
                <label for="">Unit Level 2</label>
                <select type="text" class="form-control" name='unit_level2' id="unit_level2">
                    <option value="" disabled selected>Unit level 2</option>
                    <option value=""></option>
                  </select>
              </div>

              <div class="form-group">
                <label for="">Unit Level 3</label>
                <select type="text" class="form-control" name='unit_level3' id="unit_level3">
                    <option value="" disabled selected>Unit level 3</option>
                    <option value=""></option>
                  </select>
              </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                <label for="">Nama Lantai</label>
                <input type="text" class="form-control" name="nama_lantai" id="nama_lantai" placeholder="Nama Lantai">
              </div>
              <div class="form-group">
                <label for="">Pilih Gedung</label>
                <select type="text" class="form-control" name="gedung" id="gedung">
                    @foreach($gedung as $value)
                    <option value="{{$value->id}}">{{$value->nama_gedung}}</option>
                    @endforeach
                  </select>
              </div>
          </div>
          <div class="col-md-12">
            <a href="{{ route('masterData') }}" class="btn btn-warning btn-sm text-dark">Kembali</a>
              <button class="btn btn-primary btn-sm" type="submit">
                Simpan
              </button>
          </div>
        </div>
      </form>
  </div>
</div>
@endsection

@section('script')
<script>

    $(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });


    $(function () {

        $('#kantor_induk').on('change', function () {
            let kantor_induk = $('#kantor_induk').val();
            $.ajax({
          		type: 'POST',
              	url: "{{route('get_unitlevel2')}}",
              	data: {kantor_induk: kantor_induk},
              	cache: false,
              	success: function(msg){
                  $("#unit_level2").html(msg);
                  $("#unit_level3").html("");
                },
                error: function (data ) {
                        console.log('Error:', data);
                },
            });

        });

        $('#unit_level2').on('change', function () {
            let unit_level2 = $('#unit_level2').val();
            $.ajax({
          		type: 'POST',
              	url: "{{route('get_unitlevel3')}}",
              	data: {unit_level2: unit_level2},
              	cache: false,
              	success: function(msg){
                  $("#unit_level3").html(msg);
                },
                error: function (data ) {
                        console.log('Error:', data);
                },
            });
        });
    });
});
</script>
@endsection
