@extends('layout.template')

@section('title')
SK3 | Eviden
@endsection


@section('content-header')
<h5>Edit Eviden</h5>
@endsection

@section('content-body')
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('updateEviden',$eviden->id) }}" method="post" class="user" enctype="multipart/form-data">
            @csrf
            @method('put')
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

            <div class="row">

            <div class="col md-4">
              <div class="form-group">
                <label for=""><h6>JADWAL</h6></label>
                <hr>
                    <table cellpadding="5">
                        <tr>
                            <td><b> Lokasi </b></td>
                            <td>:</td>
                            <td><b>{{$eviden->Jadwal->lokasi}}</b></td>
                        </tr>
                        <tr>
                            <td><b>Koordinat </b></td>
                            <td>:</td>
                            <td><b>{{$eviden->Jadwal->koordinat}}</b></td>
                        </tr>
                        <tr>
                            <td><b>Deskripsi </b> </td>
                            <td>:</td>
                            <td><b>{{$eviden->Jadwal->deskripsi}}</b> </td>
                        </tr>
                    </table>
              </div>
            </div>

              <div class="col-md-4">
                @if($eviden->url)
                <iframe width="100%" height="350px" src="{{ asset('eviden/'.$eviden->url) }}" type="pdf"></iframe>
                @else
                <div width="100%" style="height: 350px" class="d-flex border rounded justify-content-center align-items-center">
                  <p>Mohon maaf dokumen belum diupload</p>
                </div>
                @endif
                <div class="form-group">
                  <label for="surat_pengajuan" class="text-dark">Image / Video</label>
                  <input type="file" class="form-control-file" id="url" name="url">
                  <small>pilih gambar / video jika ingin mengubah</small>
                </div>
              </div>

              <div class="col-md-4">
                @if($eviden->pdf)
                <iframe width="100%" height="350px" src="{{ asset('eviden/'.$eviden->pdf) }}" type="pdf"></iframe>
                @else
                <div width="100%" style="height: 350px" class="d-flex border rounded justify-content-center align-items-center">
                  <p>Mohon maaf dokumen belum diupload</p>
                </div>
                @endif
                <div class="form-group">
                  <label for="surat_pengajuan" class="text-dark">Pdf</label>
                  <input type="file" class="form-control-file" id="pdf" name="pdf">
                  <small>pilih file Pdf jika ingin mengubah</small>
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn btn-block">
              Update Eviden
            </button>
        </form>
      </div>
    </div>
  </div>
@endsection
