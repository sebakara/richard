@include('includes.sidebar')      
      <!-- /.search form -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Trainers and Supervisors</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Image</th>
                  <th>Names</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Sex</th>
                  <th>Phone Number</th>
                  <th>Education</th>
                  <th>Site</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                <tr>
                  @if($user->image == '')
                  <td>
                  <img height="40" src="{{asset('images/profile.jpeg')}}" class="img-circle" alt="User Image">
                  </td>
                  @else
                  <td>
                  <img height="40" src="{{asset('images/'.$user->image)}}" class="img-circle" alt="User Image">
                  </td>
                  @endif
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->role}}</td>
                  <td>{{$user->gender}}</td>
                  <td>{{$user->phone_number}}</td>
                  <td>{{$user->high_education}}</td>
                  <td>
                      @if(!empty($user->sites))
                      Allocated
                      @else
                      Not Allocated
                      @endif
                  
                </td>
                  <td><a href="{{url('showAllocating',$user->id)}}">​Allocate</a></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Image</th>
                  <th>Names</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Sex</th>
                  <th>Phone Number</th>
                  <th>Education</th>
                  <th>Site</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
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
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('dist/js/demo.js')}}"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
