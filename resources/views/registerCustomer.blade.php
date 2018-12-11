<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Daftar LogTranSawit</title>
  <link rel="icon" href="logoa.png"/>
  <link href="{{ asset('template/admin/plugins/bootstrap/bootstrap.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Montserrat:400,700'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="{{ asset('template/login/css/style.css') }}">  
  <link rel="stylesheet" type="text/css" href="{{ asset('template/sweetalert/dist/sweetalert.css') }}">
  <style>
  html
  {
    background:url('kebun.jpg') no-repeat center center fixed;
    -webkit-background-size:cover;
    -moz-background-size:cover;
    -o-background-size:cover;
    background-size:cover;
  }
  </style>
</head>

<body>
<div class="container">
  <div class="info">
    <h1>Daftar Akun LogTranSawit</h1>
  </div>
</div>
<div class="form">
  <form action = "{{ route('login.daftar') }}" method="post" class="login-form">
  {{ csrf_field() }}
    <input type="text" placeholder="Nama Pengguna" name="username" required />
    <input type="password" placeholder="Kata Sandi" name="password" required  />
    <input type="password" placeholder="Konfirmasi Kata Sandi" name="konfirmasi" required  />
    <input type="text" placeholder="Nama Lengkap" name="nama" required />
    <input type="text" placeholder="Email" name="email" required />
    <input type="text" placeholder="Nomor HP" name="no_hp" required />
    <select class="form-control" name="role">
      @foreach(\App\Role::where('id_role','<>',1)->get() as $role)
        <option value="{{ $role->id_role }}">{{ $role->deskripsi }}</option>
      @endforeach
    </select>
    <br/>
    <button>Daftar</button>
    <p class="message"><a href="{{ route('home') }}">Beranda</a> | <a href="{{ route('login.home') }}">Masuk</a></p>
  </form>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/index.js"></script>
  <script src="{{ asset('template/sweetalert/sweetalert.js') }}"></script>
  @include('sweet::alert')

</body>
</html>
