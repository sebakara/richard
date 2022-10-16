<?php echo $__env->make('auth.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Richard</b></a>
    <?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
    <?php elseif(session('message')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('message')); ?>

    </div>
    <?php endif; ?>

    <!--  -->
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to the Richard</p>
    <form action="<?php echo e(route('signin')); ?>" method="post">
      <?php echo csrf_field(); ?>
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
          <?php if($errors->has('email')): ?>
          <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
          <?php endif; ?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
          <?php if($errors->has('password')): ?>
          <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
          <?php endif; ?>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
    <!-- <a href="<?php echo e(url('register')); ?>" class="text-center">Register a new membership</a> -->

  </div>
</div>
<?php echo $__env->make('auth.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\richard\resources\views/pages/login.blade.php ENDPATH**/ ?>