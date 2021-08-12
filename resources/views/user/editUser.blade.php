@extends('layout.template')

@section('title')
SK3 | Edit User
@endsection


@section('content-header')
<b>Edit User</b>
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
<!-- Page Heading -->
{{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
</div> --}}
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <form action="{{route('updateUser',$user->id)}}" method="post" class="user">
            <div class="row">
            @method('put')
            @csrf
            <div class="col-md-6">

                <div class="form-group">
                  <label for="name">Nama Lengkap</label>
                  <input type="text" class="form-control name" name='name' value="{{$user->name}}">
                </div>
                <div class="form-group">
                  <label for="nip">NIP</label>
                  <input type="text" class="form-control nip" name='nip' value="{{$user->nip}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control email" name="email" value="{{$user->email}}">
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label for="password">Password Baru</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="col-sm-6">
                      <label for="password_confirmation"> Password Confirmasi</label>
                      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repeat Password">
                    </div>
                  </div>
                  <div class="form-group">
                    @if($user->verifikasi_user == 0)
                      <div class="form-group row">
                        <label for="id_pel" class="col-sm-4 col-form-label">Verifikasi User</label>
                        <div class="col-sm-8">
                            <a href="{{route('userAktif',$user->id)}}" class="btn btn-danger btn-sm mb-2" style="font-size:15px;font-weight:bold;"><i title="Belum Terverifikasi" class="fas fa-exclamation"></i> Confirm</a>
                            {{-- <button type="submit" name="verifikasi_identitas_pelanggan" value="confirm" class="btn btn-primary btn-sm mb-2" style="font-size:15px;font-weight:bold;">Confirm </button> --}}
                        </div>
                      </div>
                      @else
                      <div class="form-group row">
                        <label for="id_pel" class="col-sm-4 col-form-label">Verifikasi User</label>
                        <div class="col-sm-8">
                            <a href="{{route('userNonaktif',$user->id)}}" class="btn btn-success btn-sm mb-2" style="font-size:15px;font-weight:bold;"><i title="Terverifikasi" class="fas fa-check"></i> Confirm</a>
                            {{-- <h5><span class="badge badge-success p-2"><i title="Terverifikasi" class="fas fa-check"></i> Confirm</span></h5> --}}
                        </div>
                      </div>
                      @endif
                  </div>

            </div>

            <div class="col-md-6">
                <div class="form-group kantor_induk_form">
                    <label for="kantor_induk">Kantor Induk</label>
                    <select type="text" class="form-control kantor_induk" name='kantor_induk' id="kantor_induk">
                        <option value="" selected disabled>--Kantor Induk--</option>
                        @foreach ($kantor_induk as $kantor )
                            <option value="{{$kantor->id }}" @if($kantor->id == $user->id_kantor_induk) selected = "selected" @endif>{{$kantor->nama_kantor_induk}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group unit_level2_form">
                    <label for="unit_level2">Unit level 2</label>
                    <select type="text" class="form-control unit_level2" name='unit_level2' id="unit_level2">
                        @foreach ($unit_level2 as $level2 )
                            <option value="{{$level2->id }}" @if($level2->id == $user->id_unit_level2) selected = "selected" @endif>{{$level2->nama_unit_level2}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group unit_level3_form">
                    <label for="unit_level3">Unit level 3</label>
                    <select type="text" class="form-control unit_level3" name='unit_level3' id="unit_level3">
                        @foreach ($unit_level3 as $level3 )
                        <option value="{{$level3->id }}" @if($level3->id == $user->id_unit_level3) selected = "selected" @endif>{{$level3->nama_unit_level3}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group role_form">
                    <label for="role">Role</label>
                    <select type="text" class="form-control role" name='role' id="role">
                      @foreach ($roles as $role )
                          <option value="{{$role->id}}" @if($role->id == $user->role_id) selected = "selected"
                          @endif>{{$role->role}}</option>
                      @endforeach
                    </select>
                  </div>
                  <a href="{{ route('user') }}" class="btn btn-warning btn-sm">
                    Kembali
                  </a>
                  <button class="btn btn-primary btn-sm" type="submit">
                    Simpan
                  </button>

            </div>
            </div>



          </form>
      </div>
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
