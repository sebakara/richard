<?php echo $__env->make('includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
  </aside>
  <div class="content-wrapper">
     <!-- <section class="content">
      
    </section> -->

    <section class="content">

    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo e($districts); ?></h3>
              <p>Districts</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo e($provinces); ?></h3>
              <p>Provinces</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
        </div>
        </div>
          <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo e($trained); ?></h3>
              <p>Trainees</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
      </div>
        </div>
        <div class="col-lg-3 col-xs-6">
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo e($user_type); ?></h3>
              <p>User Types</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly trainees Reports</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                  </p>
                  <div class="chart">
                    <canvas id="salesChart" style="height: 180px;"></canvas>
                  </div>
                </div>
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Goal Completion</strong>
                  </p>
                  <div class="progress-group">
                    <span class="progress-text">Add Products to Cart</span>
                    <span class="progress-number"><b>160</b>/200</span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                    </div>
                  </div>
                  <div class="progress-group">
                    <span class="progress-text">Complete Purchase</span>
                    <span class="progress-number"><b>310</b>/400</span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                    </div>
                  </div>
                  <div class="progress-group">
                    <span class="progress-text">Visit Premium Page</span>
                    <span class="progress-number"><b>480</b>/800</span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                    </div>
                  </div>
                  <div class="progress-group">
                    <span class="progress-text">Send Inquiries</span>
                    <span class="progress-number"><b>250</b>/500</span>
                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Members</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger">4 New Members</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="users-list clearfix" id="last_users">
                  </ul>
                </div>
                <div class="box-footer text-center">
                  <a href="<?php echo e(url('getusers')); ?>" class="uppercase">View All Users</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">

          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Recent Reports</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked" id="recentreports">
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>


  </div>
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2016 Richard</strong> All rights
    reserved.
  </footer>  <div class="control-sidebar-bg"></div>
</div>
<script src="<?php echo e(asset('bower_components/jquery/dist/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/jquery-ui/jquery-ui.min.js')); ?>"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?php echo e(asset('bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/raphael/raphael.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/morris.js/morris.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/jquery-knob/dist/jquery.knob.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/moment/min/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')); ?>"></script>
<script src="<?php echo e(asset('bower_components/fastclick/lib/fastclick.js')); ?>"></script>
<script src="<?php echo e(asset('dist/js/adminlte.min.js')); ?>"></script>
<script src="<?php echo e(asset('dist/js/pages/dashboard.js')); ?>"></script>
<script src="<?php echo e(asset('dist/js/demo.js')); ?>"></script>
<script src="bower_components/chart.js/Chart.js"></script>
<script>
$.ajax({
        url: "<?php echo e(url('get_last_user')); ?>",
        type:'get',
        dataType:'json',
        data: {_token:'<?php echo e(csrf_token()); ?>'},
            success:function(data){
                var foto = 'images/profile.jpeg';
                var users = data.data;
                for(let i in users){
                    $("#last_users").append('<li>'+
                      '<a class="users-list-name" href="#">'+users[i].name+'</a>'+
                      '<span class="users-list-date">'+users[i].role+'</span>'+
                    '</li>');
                }
            }
    })
    // 
// recentreports
    $.ajax({
        url: "<?php echo e(url('get_recent_report')); ?>",
        type:'get',
        dataType:'json',
        data: {_token:'<?php echo e(csrf_token()); ?>'},
            success:function(data){
                var reports = data.data;
                for (let t in reports){
             $("#recentreports").append('<li>'+
             '<a href="#">'+reports[t].report_name+
                  '<span class="pull-right text-red">'+
                '</li>')
                }
            }
    })

  $.ajax({
  url: "<?php echo e(url('get_data_for_charts')); ?>",
  type:'get',
  dataType:'json',
  success:function(data){
          var reports = data.reports;
          var montths=[];
          var datainmonths=[];
          for(let i in reports){
            montths.push(reports[i].month);
            datainmonths.push(reports[i].data);
          }

  var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
  var salesChart       = new Chart(salesChartCanvas);

  var salesChartData = {
    labels  : montths,
    datasets: [
      // {
      //   label               : 'Electronics',
      //   fillColor           : 'rgb(210, 214, 222)',
      //   strokeColor         : 'rgb(210, 214, 222)',
      //   pointColor          : 'rgb(210, 214, 222)',
      //   pointStrokeColor    : '#c1c7d1',
      //   pointHighlightFill  : '#fff',
      //   pointHighlightStroke: 'rgb(220,220,220)',
      //   data                : datainmonths
      // }
      // ,
      {
        label               : 'Digital Goods',
        fillColor           : 'rgba(60,141,188,0.9)',
        strokeColor         : 'rgba(60,141,188,0.8)',
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : datainmonths
      }
    ]
  };

  var salesChartOptions = {
    showScale               : true,
    scaleShowGridLines      : false,
    scaleGridLineColor      : 'rgba(0,0,0,.05)',
    scaleGridLineWidth      : 1,
    scaleShowHorizontalLines: true,
    scaleShowVerticalLines  : true,
    bezierCurve             : true,
    bezierCurveTension      : 0.3,
    pointDot                : false,
    pointDotRadius          : 4,
    pointDotStrokeWidth     : 1,
    pointHitDetectionRadius : 20,
    datasetStroke           : true,
    datasetStrokeWidth      : 2,
    datasetFill             : true,
    legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
    maintainAspectRatio     : true,
    responsive              : true
  };
  salesChart.Line(salesChartData, salesChartOptions);
      }
})
</script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\richard\resources\views/pages/dashboard.blade.php ENDPATH**/ ?>