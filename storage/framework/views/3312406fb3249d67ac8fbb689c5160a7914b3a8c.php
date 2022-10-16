<script src="<?php echo e(URL::asset('bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('plugins/iCheck/icheck.min.js')); ?>"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\richard\resources\views/auth/footer.blade.php ENDPATH**/ ?>