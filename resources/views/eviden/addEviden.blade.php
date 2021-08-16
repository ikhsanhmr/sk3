@extends('layout.template')

@section('title')
SK3 | Eviden
@endsection


@section('content-header')
<h5>Add Eviden</h5>
@endsection

@section('content-body')
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('addEviden') }}" method="post" class="user" enctype="multipart/form-data">
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
                <label for="">Jadwal</label>
                <select type="text" class="form-control" name='id_jadwal' id="id_jadwal">
                    @foreach($jadwal as $value)
                    <option value="{{$value->id}}">{{$value->deskripsi}}</option>
                    @endforeach
                  </select>
              </div>

            <div class="form-group">
              <label for="">Image / Video</label>
              <input type="file" class="form-control form-control" name="url" id="url" placeholder="url">
            </div>
             <div class="form-group">
                <label for="">PDF</label>
                <input type="file" class="form-control form-control" id="pdf" name="pdf" placeholder="pdf">
            </div>
            <button type="submit" class="btn btn-primary btn btn-block">
              Add Eviden
            </button>
        </form>
      </div>
    </div>
  </div>
@endsection
