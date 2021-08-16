<!DOCTYPE html>
<html lang="en">
@include('layout.header')
@section('title')
SK3 | Register
@endsection
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              {{-- <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> --}}
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form action="{{ route('register') }}" method="post" class="user">
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
                      <input type="text" class="form-control form-control-user" name='name' id="name" placeholder="Full Name">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name='nip' id="nip" placeholder="NIP">
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

                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Email Address">
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                      </div>
                      <div class="col-sm-6">
                        <input type="password" class="form-control form-control-user" id="password_confirmation" name="password_confirmation" placeholder="Repeat Password">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Register Account
                    </button>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Stisla 2018
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  @include('layout.js')
  {{-- <script src="{{asset('assets')}}/js/page/auth-register.js"></script> --}}

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
</body>
</html>
