@include('includes.sidebar')
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        My Profile
        <!-- <small>Preview</small> -->
      </h1>

      @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- form start -->
            <div class="row container" >
            <div class="col-md-4 col-lg-4">
              @if($user->image == '')
              <img src="{{asset('images/profile.jpeg')}}" height="200">
              @else
              <img src="{{asset('images/'.$user->image)}}" height="200">
              @endif
              <div class="small-box bg-yellow" style="width: 200px;">
              <div class="inner">
              <h5>{{$user->name}}</h5>
            </div>
          </div>
          </div>

            <div class="col-lg-8">
            <form role="form" action="{{route('send_comment')}}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
               <label>Report</label></br>
               <input type="hidden" name="report_id" value="{{$user->id}}">
                <input type="text" name="report" value="{{$user->report_name}}" readonly>
              </div>
               <!-- reveiving email -->
               <div class="form-group">
               <label>Send Email To</label></br>
                <input type="text" name="email_to" value="{{$user->email}}" readonly>
              </div>

              <div class="form-group">
                <label>Compose The message</label></br>
                <textarea name="message" cols="45" rows="5"></textarea>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>

        </div>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2016 Richard</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('dist/js/demo.js')}}"></script>

<!-- <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

<script>
</script>
</body>
</html>
