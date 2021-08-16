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
        <form action="{{ route('updateEviden',$eviden->id) }}" method="post" class="user">
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
              <div class="form-group">
                <label for="">Jadwal</label>

              </div>

              <div class="col-md-4">
                @if($eviden->url)
                <iframe width="100%" height="400px" src="{{ asset('eviden/'.$eviden->url) }}" type="pdf"></iframe>
                @else
                <div width="100%" style="height: 400px" class="d-flex border rounded justify-content-center align-items-center">
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
                <iframe width="100%" height="400px" src="{{ asset('eviden/'.$eviden->url) }}" type="pdf"></iframe>
                @else
                <div width="100%" style="height: 400px" class="d-flex border rounded justify-content-center align-items-center">
                  <p>Mohon maaf dokumen belum diupload</p>
                </div>
                @endif
                <div class="form-group">
                  <label for="surat_pengajuan" class="text-dark">Image / Video</label>
                  <input type="file" class="form-control-file" id="url" name="url">
                  <small>pilih gambar / video jika ingin mengubah</small>
                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn btn-block">
              Add Eviden
            </button>
        </form>
      </div>
    </div>
  </div>
@endsection
