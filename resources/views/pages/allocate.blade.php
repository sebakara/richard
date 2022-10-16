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
              <h5>{{$user->role}}</h5>
            </div>
          </div>
          </div>

            <div class="col-lg-8">
            <form role="form" action="{{route('allocate_user_in_place')}}" method="post" enctype="multipart/form-data">
               @csrf
              <div class="form-group">
                <label>Select District</label>
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <input type="hidden" name="role_id" value="{{$user->role_id}}">
                <select class="form-control" name="district" id="district" style="width: 100%;">
                <option value="">----------select---------</option>
                @foreach($districts as $district)
                <option value="{{$district->id}}">{{$district->name}}</option>
                @endforeach
                </select>
              </div>
              @if($user->role_id == 4)
              <div class="form-group">
                <label>Select Sector</label>
                <select class="form-control" name="sector" id="sectorId" style="width: 100%;">
                </select>
              </div>

              <div class="form-group">
                <label>Select sites</label>
                <div id="sitesId"></div>
                </select>
              </div>
              @endif
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
$("#district").on("change",function(){
    $("#sectorId").empty();
    var distr = $("#district").val();
    let _token   = $('meta[name="csrf-token"]').attr('content');
    // console.log(distr);
    $.ajax({
        url: "{{url('get_sectors')}}",
        type:'post',
        dataType:'json',
        data: {'district':distr,_token:'{{ csrf_token() }}'},
            success:function(data){
                var sectors = data.data;
                // sectorId
                for(let i in sectors){
                    $("#sectorId").append('<option value="'+sectors[i].id+'">'+sectors[i].name+'</option>');
                }
            }
    })
}); 

$("#sectorId").on("change",function(){
    $("#sitesId").empty();
var sector = $("#sectorId").val();
let _token = $('meta[name="csrf-token"]').attr('content');
$.ajax({
        url: "{{url('get_sites')}}",
        type:'post',
        dataType:'json',
        data: {'sector':sector,_token:'{{ csrf_token() }}'},
            success:function(data){
                var sites = data.data;
                console.log(sites);
                // sectorId
                // sitesId
                for(let i in sites){
                    $("#sitesId").append('<input type="checkbox" name="sites[]" value="'+sites[i].id+'">'+sites[i].name+'</br>');
                }
            }
    })

});

// $(function() {  
//  $('#sitesId').multiselect({
//             includeSelectAllOption: true,
//             enableFiltering: true,
//             enableCaseInsensitiveFiltering: true,
//             filterPlaceholder: 'Search for something...'
//         }); 
// });
</script>
</body>
</html>
