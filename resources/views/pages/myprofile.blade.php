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
              <div class="col-md-8">
            <form role="form" action="{{route('update_profile')}}" method="post" enctype="multipart/form-data">
               @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Full Names</label>
                  <input type="hidden" name="reportid" value="">
                  <input type="hidden" name="userId" value="{{$user->id}}">
                  <input type="text" class="form-control" id="names" name="names" value="{{$user->name}}" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" readonly>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Phone number</label>
                  <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{$user->phone_number}}" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Date Of Birth</label>
                  <input type="date" class="form-control" id="dob" name="dob" value="{{$user->date_of_birth}}" required>
                </div> 

                <div class="form-group">
                <label>Select Gender</label>
                <select class="form-control" name="gender" style="width: 100%;">
                  <option value="{{$user->gender}}">{{$user->gender}}</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
              <div class="form-group">
                <label>Level Of Education</label>
                <select class="form-control" name="level_of_education" style="width: 100%;">
                  <option value="{{$user->high_education}}">{{$user->high_education}}</option>
                  <option value="Male">Bacherol</option>
                  <option value="Female">High School</option>
                  <option value="unidentified">Unidentified</option>
                </select>
              </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Location</label>
                  <input type="text" class="form-control" id="location" name="location" value="{{$user->location}}">
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Upload Profile</label>
                  <input type="file" class="form-control" id="profile_image" name="profile_image">
                </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <div class="col-md-4">
              @if($user->image == '')
              <img src="{{asset('images/profile.jpeg')}}" height="200">
              @else
              <img src="{{asset('images/'.$user->image)}}" height="200">
              @endif

              <div class="small-box bg-yellow" style="width: 200px;">
              <div class="inner">
              <h5>{{$user->role}}</h5>
            </div>
<!--             <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
          </div>

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

<script>
$("#provinve").on("change",function(){

    // var prov = $("#provinve").val();
    // let _token   = $('meta[name="csrf-token"]').attr('content');

    // $.ajax({
    //     url: '/get_districts',
    //     type:'post',
    //     dataType:'json',
    //     data: {'province':prov},
    //         success:function(data){
    //             console.log(data);
    //         }
    // })
}); 

</script>
</body>
</html>
