  @include('includes.sidebar')      
      <!-- /.search form -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Reports Details</h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Names</th>
                  <th>NAtional ID</th>
                  <th>Gender</th>
                  <th>Phone</th>
                  <th>District</th>
                  <th>Sector</th>
                  <th>Cell</th>
                  <th>Date Of Training</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($reports as $report)
                <tr>
                  <td>{{$report->names}}</td>
                  <td>{{$report->gender}}</td>
                  <td>{{$report->phone_number}}</td>
                  <td>{{$report->nationalId}}</td>
                  <td>{{$report->district}}</td>
                  <td>{{$report->sector}}</td>
                  <td>{{$report->cell}}</td>
                  <td>{{$report->date_of_training}}</td>
                  <td>
                    @if(auth()->user()->role_id == 4)
                    <a href="{{url('showtrainee',$report->id)}}">
                      ​<i class="fa fa-edit" style="font-size:24px"></i></a>
                    @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Names</th>
                  <th>NAtional ID</th>
                  <th>Gender</th>
                  <th>Phone</th>
                  <th>District</th>
                  <th>Sector</th>
                  <th>Cell</th>
                  <th>Date Of Training</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2016 Richard</strong> All rights
    reserved.
  </footer>
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
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
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
