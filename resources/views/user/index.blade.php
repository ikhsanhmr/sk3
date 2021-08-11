@extends('layout.tamplate')
@section('title', 'User List | AIL')
@section('content')

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
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">List User</h1>
</div>

<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
    <a class="nav-link" id="nav-add-tab" data-toggle="tab" href="#nav-add" role="tab" aria-controls="nav-add" aria-selected="false">Tambah Data User</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    {{-- Tabel User --}}
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
              @foreach($users as $key => $user)
              @php
              $confirmasi_user = $user['verifikasi_user'];
              @endphp
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['nip'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>
                    @if($confirmasi_user == '1')
                    {{'Aktif'}}
                    @else
                    {{'Tidak Aktif'}}
                    @endif
                </td>
                {{-- TODO: Memperbaiki Colonm Password --}}
                {{-- <td>{{ $user['password'] }}</td> --}}
                <td>
                  {{-- <form class="d-flex" action="{{ url('/admin/user', ['id' => $user['id']]) }}" method="post">
                    <a href="javascript:void()" class="btn btn-warning btn-sm btn-circle mr-2 btn-modal-edit"
                    data-email="{{ $user['email'] }}" data-name="{{ $user['name'] }}"
                    data-nip="{{ $user['nip'] }}" data-unit="{{ $user['unit_id'] }}"
                    data-id="{{ $user['id'] }}" data-role_id ="{{$user['role_id']}}"><i class="fa fa-pen"></i></a> --}}
                    <a href="{{route('editUser',$user->id)}}" class="btn btn-warning btn-sm btn-circle mr-2 btn-modal-edit"><i class="fa fa-pen"></i></a>

                    <a href="{{route('deleteUser',$user->id)}}" class="btn btn-danger btn-sm btn-circle mr-2 btn-modal-edit"><i class="fa fa-trash"></i></a>
                        {{-- <form>
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm btn-circle"><i class="fa fa-trash"></i></button>
                    </form> --}}

                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{-- Tabel User --}}

  </div>
  <div class="tab-pane fade" id="nav-add" role="tabpanel" aria-labelledby="nav-add-tab">

    {{-- FORM --}}
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <form action="{{ route('addUser') }}" method="post" class="user">
              @csrf
              <div class="form-group">
                <input type="text" class="form-control" name='name' id="name" placeholder="Nama Lengkap">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name='nip' id="nip" placeholder="NIP">
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
              </div>
              <div class="form-group">
                <select type="text" class="form-control" name='kantor_induk' id="kantor_induk">
                    <option value="" disabled selected>Kantor induk</option>
                    @foreach ($kantor_induk as $induk)
                        <option value="{{$induk->id}}">{{$induk->nama_kantor_induk}}</option>
                    @endforeach
                  </select>
              </div>

              <div class="form-group">
                <select type="text" class="form-control" name='unit_level2' id="unit_level2">
                    <option value="" disabled selected>Unit Level2</option>
                    <option value=""></option>
                  </select>
              </div>

              <div class="form-group">
                <select type="text" class="form-control" name='unit_level3' id="unit_level3">
                    <option value="" disabled selected>Unit Level3</option>
                    <option value=""></option>
                  </select>
              </div>

              <div class="form-group role_form">
                <label for="role">Role</label>
                <select type="text" class="form-control role" name='role' id="role">
                  @foreach ($roles as $role )
                      <option value="{{$role->id}}">{{$role->role}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="col-sm-6">
                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repeat Password">
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-block">
                Tambah User
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    {{-- FORM --}}

  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- <form action="{{ route('editUser') }}" method="post" class="user">
          @method('put')
          @csrf
          <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" class="form-control name" name='name' id="name" placeholder="Full Name">
          </div>
          <div class="form-group">
            <label for="nip">NIP</label>
            <input type="text" class="form-control nip" name='nip' id="nip" placeholder="NIP">
          </div>
          <div class="form-group kantor_induk_form">
            <label for="kantor_induk">Kantor Induk</label>
            <select type="text" class="form-control kantor_induk" name='kantor_induk' id="kantor_induk">
              @foreach($unit_level3 as $key => $unit)
              <option value="{{ $unit->id }}">{{ $unit->nama_unit_level3 }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group unit_level2_form">
            <label for="unit_level2">Unit level 2</label>
            <select type="text" class="form-control unit_level2" name='unit_level2' id="unit_level2">
              @foreach($unit_level3 as $key => $unit)
              <option value="{{ $unit->id }}">{{ $unit->nama_unit_level3 }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group unit_level3_form">
            <label for="unit_level3">Unit level 3</label>
            <select type="text" class="form-control unit_level3" name='unit_level3' id="unit_level3">
              @foreach($unit_level3 as $key => $unit)
              <option value="{{ $unit->id }}">{{ $unit->nama_unit_level3 }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group role_form">
            <label for="role">Role</label>
            <select type="text" class="form-control role" name='role' id="role">
              <option value="">Admin</option>
              <option value="">UPL</option>
              <option value="">UP3</option>
            </select>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control email" name="email" id="email" placeholder="Email Address">
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
          <input type="hidden" name="id" id="id" class="id">
          <button type="submit" class="btn btn-primary btn-block">
            Ubah User
          </button>
        </form> --}}
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
{{-- <script>

  $('#dataTable').on('click', '.btn-modal-edit', function(){
    console.log('ok')
    // assign variable from data paket franchise
    let name = $(this).data('name')
    let nip = $(this).data('nip')
    let unit_id = $(this).data('unit')
    let email = $(this).data('email')
    let id = $(this).data('id')
    let role = $(this).data('role_id');


    // Display value on form
    $('.name').val(name)
    $('.nip').val(nip)
    if (unit_id === 0) {
      $('.unit_level3_form').hide()
    }
    $('.unit_level3').val(unit_id).change()
    $('.email').val(email)
    $('.id').val(id)



    // Display Modal
    $('#editUserModal').modal('show')
  });

</script> --}}
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

