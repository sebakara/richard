@include('auth.header')
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Richard</b></a>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
    @endif

    <!--  -->
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to the Richard</p>
    <form action="{{route('signin')}}" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
          @if ($errors->has('email'))
          <span class="text-danger">{{ $errors->first('email') }}</span>
          @endif
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
          @if ($errors->has('password'))
          <span class="text-danger">{{ $errors->first('password') }}</span>
          @endif
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
    <!-- <a href="{{url('register')}}" class="text-center">Register a new membership</a> -->

  </div>
</div>
@include('auth.footer')