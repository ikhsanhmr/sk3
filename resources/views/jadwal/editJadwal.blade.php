@extends('layout.template')

@section('title')
SK3 | Jadwal
@endsection


@section('content-header')
<h5>Add Jadwal</h5>
@endsection

@section('content-body')
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('updateJadwal',$jadwal->id) }}" method="post" class="user">
            @method('put')
            @csrf
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
            <div class="form-group">
                <select type="text" class="form-control" name='kantor_induk' id="kantor_induk">
                    <option value="" disabled selected>Kantor induk</option>
                    @foreach ($kantor_induk as $kantor)
                        <option value="{{$kantor->id}}"  @if($kantor->id == $jadwal->id_kantor_induk) selected = "selected" @endif>{{$kantor->nama_kantor_induk}}</option>
                    @endforeach
                  </select>
              </div>

              <div class="form-group">
                <select type="text" class="form-control" name='unit_level2' id="unit_level2">
                    <option value="" disabled selected>Unit Level2</option>
                    @foreach($unit_level2 as $level2)
                    <option value="{{$level2->id}}" @if($level2->id == $jadwal->id_unit_level2) selected='selected' @endif>{{$level2->nama_unit_level2}}</option>
                    @endforeach
                  </select>
              </div>

              <div class="form-group">
                <select type="text" class="form-control" name='unit_level3' id="unit_level3">
                    <option value="" disabled selected>Unit Level3</option>
                    @foreach($unit_level3 as $level3)
                    <option value="{{$level3->id}}" @if($level3->id == $jadwal->id_unit_level3) selected='selected' @endif>{{$level3->nama_unit_level3}}</option>
                    @endforeach
                  </select>
              </div>

            <div class="form-group">
              <input type="text" class="form-control form-control" value="{{$jadwal->lokasi}}" name="lokasi" id="lokasi" placeholder="lokasi">
            </div>
             <div class="form-group">
                <input type="text" class="form-control form-control" value="{{$jadwal->koordinat}}" id="koordinat" name="koordinat" placeholder="Koordinat">
            </div>
            <div class="form-group">
                <input type="text" class="form-control form-control" value="{{$jadwal->deskripsi}}" id="deskripsi" name="deskripsi" placeholder="Deskripsi">
              </div>
            <button type="submit" class="btn btn-primary btn btn-block">
              Update jadwal
            </button>
        </form>
      </div>
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
