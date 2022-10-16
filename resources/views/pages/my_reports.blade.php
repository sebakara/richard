@include('includes.sidebar')      
      <!-- /.search form -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        All Reports
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
              @if(auth()->user()->role_id == 4)
              <a class="btn btn-default" href="{{url('create_report')}}">Create a Report</a>
              @endif
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- success -->
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Names</th>
                  <th>Site</th>
                  <th>Date Of Report</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($myreports as $report)
                <tr>
                  <td>{{$report->report_name}}</td>
                  <td>{{$report->site}}</td>
                  <td>{{$report->date_of_training}}</td>
                  <td>
                      @if($report->status == 1)
                      approved
                      @else
                      Pending
                      @endif
                  </td>
                  <td><a href="{{url('show_report_details',$report->id)}}"><i class="fa fa-eye" style="font-size:24px"></i></a>
                  @if(auth()->user()->role_id == 3)
                    <a href="{{url('change_status',$report->id)}}"><i class="fa fa-check" style="font-size:24px"></i></a>
                    <a href="{{url('put_comment',$report->id)}}"><i class="fa fa-comments-o" aria-hidden="true" style="font-size:24px"></i></a>
                    @endif
                  </td>
                  <!-- <td><a href="{{url('showtrainee',$report->id)}}">​View Details</a></td> -->
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Names</th>
                  <th>Site</th>
                  <th>Date Of Report</th>
                  <th>Status</th>
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
