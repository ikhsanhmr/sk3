@extends('layout.template')

@section('title')
SK3 | Add Gedung
@endsection


@section('content-header')
<b>Add Gedung</b>
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
    <form action="{{route('addApar')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                <label for="">Pilih Gedung</label>
                <select type="text" class="form-control" name='gedung' id="gedung">
                    <option value="" disabled selected >--Pilih Gedung--</option>
                    @foreach ($masterGedung as $gedung)
                        <option value="{{$gedung->id}}">{{$gedung->nama_gedung}}</option>
                    @endforeach
                  </select>
            </div>
            <div class="form-group">
                <label for="">Pilih Lantai</label>
                <select type="text" class="form-control" name='lantai' id="lantai">
                        <option value=""></option>
                  </select>
            </div>

            <div class="form-group">
                <label for="">Lokasi Apar</label>
                <input type="text" class="form-control" name="lokasi_apar" id="lokasi_apar" placeholder="Lokasi Apar">
              </div>
              <div class="form-group">
                <label for="">Nomor Urut</label>
                <input type="text" class="form-control" name="nomor_urut" id="nomor_urut" placeholder="Nomor Urut">
              </div>
              <div class="form-group">
                <label for="">Foto Apar</label>
                <input type="file" class="form-control" name="foto_apar" id="foto_apar" placeholder="Foto Apar">
              </div>

              <a href="{{ route('apar') }}" class="btn btn-warning btn-sm text-dark">Kembali</a>
              <button class="btn btn-primary btn-sm" type="submit">
                Simpan
              </button>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                <label for="">Merk Apar</label>
                <input type="text" class="form-control" name="merk_apar" id="merk_apar" placeholder="Merk Apar">
              </div>
              <div class="form-group">
                <label for="">Type Apar</label>
                <input type="text" class="form-control" name="type_apar" id="type_apar" placeholder="Type Apar">
              </div>

              <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Kapasitas (KG)</label>
                        <input type="text" class="form-control" name="kapasitas" id="kapasitas" placeholder="kapasitas">
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Media</label>
                            <select type="text" class="form-control" name='media' id="media">
                                <option value="" disabled selected>Pilih Media</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="ABC">ABC</option>
                            </select>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Expired</label>
                        <input type="date" class="form-control" name="tanggal_expired" id="tanggal_expired">
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Jadwal Refill</label>
                        <input type="date" class="form-control" name="jadwal_refill" id="jadwal_refill">
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Jadwal Hari Rutin Triwulanan</label>
                        <input type="date" class="form-control" name="jadwal_rutin" id="jadwal_rutin">
                      </div>
                  </div>
              </div>
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

        $('#gedung').on('change', function () {
            let gedung = $('#gedung').val();
            $.ajax({
          		type: 'POST',
              	url: "{{route('get_lantai')}}",
              	data: {gedung: gedung},
              	cache: false,
              	success: function(msg){
                  $("#lantai").html(msg);
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
