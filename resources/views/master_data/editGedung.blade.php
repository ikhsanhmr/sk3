@extends('layout.template')

@section('title')
SK3 | Edit Gedung
@endsection


@section('content-header')
<b>Edit Gedung</b>
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
    <form action="{{route('updateGedung',$gedung->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                <label for="">Kantor Induk</label>
                <select type="text" class="form-control" name='kantor_induk' id="kantor_induk">
                    <option value="" disabled selected>Kantor induk</option>
                    @foreach ($kantor_induk as $kantor)
                    <option value="{{$kantor->id}}"  @if($kantor->id == $gedung->id_kantor_induk) selected = "selected" @endif>{{$kantor->nama_kantor_induk}}</option>
                    @endforeach
                  </select>
              </div>

              <div class="form-group">
                <label for="">Unit Level 2</label>
                <select type="text" class="form-control" name='unit_level2' id="unit_level2">
                    @foreach($unit_level2 as $level2)
                    <option value="{{$level2->id}}" @if($level2->id == $gedung->id_unit_level2) selected='selected' @endif>{{$level2->nama_unit_level2}}</option>
                    @endforeach
                  </select>
              </div>

              <div class="form-group">
                <label for="">Unit Level 3</label>
                <select type="text" class="form-control" name='unit_level3' id="unit_level3">
                    @foreach($unit_level3 as $level3)
                    <option value="{{$level3->id}}" @if($level3->id == $gedung->id_unit_level3) selected='selected' @endif>{{$level3->nama_unit_level3}}</option>
                    @endforeach
                  </select>
              </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                <label for="">Nama Gedung</label>
                <input type="text" class="form-control" value="{{$gedung->nama_gedung}}" name="nama_gedung" id="nama_gedung" placeholder="Nama Gedung">
              </div>
              <div class="form-group">
                <label for="">Company Code</label>
                <input type="text" class="form-control" value="{{$gedung->company_code}}" name="company_code" id="company_code" placeholder="Company code">
              </div>
              <div class="form-group">
                <label for="">Busines Area</label>
                <input type="text" class="form-control" value="{{$gedung->busines_area}}" name="busines_area" id="busines_area" placeholder="Busines Area">
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
