@include('auth.header')
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Richard</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Welcome <strong>{{$user->name}}</strong>, Now Update your Password </p>
    <form action="{{route('activate_user')}}" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input type="hidden" name="user_id" value="{{$user->id}}">
        <input type="password" name="password" id="password2" onkeyup="checkPass();" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="confirm2" onkeyup="checkPass();" class="form-control" placeholder="Retype password">
        <span id="confirm-message2" class="confirm-message"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
function checkPass()
{
    //Store the password field objects into variables ...
    var password = document.getElementById('password2');
    var confirm  = document.getElementById('confirm2');
        var message = document.getElementById('confirm-message2');
    var good_color = "#66cc66";
    var bad_color  = "#ff6666";
    if(password.value == confirm.value){
        confirm.style.backgroundColor = good_color;
        message.style.color           = good_color;
        message.innerHTML             = '<h3>Passwords Match!</h3>';
    }else{
        confirm.style.backgroundColor = bad_color;
        message.style.color           = bad_color;
        message.innerHTML             = '<h3>Password Mismatch!</h3>';
    }
}
  </script>
@include('auth.footer')