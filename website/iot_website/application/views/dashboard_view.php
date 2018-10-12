<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="temoerature and himidity logs">
  <meta name="author" content="Fatemeh Rahimi">
  <title>IOT system</title>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url("assets/dash/vendor/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url("assets/dash/vendor/font-awesome/css/font-awesome.min.css") ?>"  rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="<?php echo base_url("assets/dash/vendor/datatables/dataTables.bootstrap4.css") ?>"  rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url("assets/dash/css/sb-admin.css") ?>"  rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">IOT System</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<?php echo base_url('index.php/Dashboard') ?>">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="<?php echo base_url('index.php/Dashboard/temerature_chart') ?>">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Temerature Chart</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="<?php echo base_url('index.php/Dashboard/humidity_chart') ?>">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Humidity Chart</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="<?php echo base_url('index.php/Dashboard/temerature_table') ?>">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Temerature Table</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="<?php echo base_url('index.php/Dashboard/humidity_table') ?>">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Humidity Table</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="<?php echo base_url('index.php/EditInfo') ?>">
            <i class="fa fa-edit"></i>
            <span class="nav-link-text">Edit System Info</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
    <?php
// echo "this is dashborad view!";
if(isset($login_wrong)){
    echo '<div dir="rtl" class="alert-box error"><span>message:&nbsp;&nbsp;</span>';
    echo $msgg;
    echo '</div>';
}
if(isset($infosuc)){
    echo '<div  class="alert-box error"><span>message:&nbsp;&nbsp;</span>';
    echo $infosuc;
    echo '</div>';
    unset($infosuc);
}
echo "Here are the system information:";
echo "<br>";
echo "username: ".$username;
echo "<br>";
echo "email: ".$email;
echo "<br>";
echo "name: ".$name;
echo "<br>";
echo "temp_min: ".$min_temp;
echo "<br>";
echo "temp_max: ".$max_temp;
echo "<br>";
echo "humidity_min: ".$min_humidity;
echo "<br>";
echo "humidity_max: ".$max_humidity;
echo "<br>";
?>



          <!-- Example Notifications Card-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bell-o"></i> Notification</div>
            <div class="list-group list-group-flush small">
            <?php
              foreach( $data as $d){
                  if($d['type']=='temp'){
                    if($d['data']>$max_temp || $d['data']<$min_temp){
                      echo '<a class="list-group-item list-group-item-action" href="#">
                      <div class="media">
                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                        <div class="media-body">
                        <strong>'.$d['data'].'</strong> --  <strong> Temperature</strong> out of range.
                          <div class="text-muted smaller">'.$d['date'].'</div>
                        </div>
                      </div>
                    </a>'; 
                    }
                  }
                  if($d['type']=='humidity'){
                    if($d['data']>$max_humidity || $d['data']<$min_humidity){
                      echo '<a class="list-group-item list-group-item-action" href="#">
                      <div class="media">
                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                        <div class="media-body">
                        <strong>'.$d['data'].'</strong>  -- <strong> Humidity</strong> out of range.
                          <div class="text-muted smaller">'.$d['date'].'</div>
                        </div>
                      </div>
                    </a>'; 
                    }
                  }
              }
            ?>          
              <!-- <a class="list-group-item list-group-item-action" href="#">
                <div class="media">
                  <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
                  <div class="media-body">
                    <strong>Temperature</strong>out of range.
                    <div class="text-muted smaller">date and time</div>
                  </div>
                </div>
              </a> -->
            </div>
            
          </div>
        </div>
      </div>
     
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © IOT System</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="<?php echo base_url('index.php/Dashboard/logout') ?>">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url("assets/dash/vendor/jquery/jquery.min.js") ?>" ></script>
    <script src="<?php echo base_url("assets/dash/vendor/bootstrap/js/bootstrap.bundle.min.js") ?>" ></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url("assets/dash/vendor/jquery-easing/jquery.easing.min.js") ?>"></script>
    <!-- Page level plugin JavaScript-->
    <script src="<?php echo base_url("assets/dash/vendor/chart.js/Chart.js") ?>" ></script>
    <script src="<?php echo base_url("assets/dash/vendor/datatables/jquery.dataTables.js") ?>" ></script>
    <script src="<?php echo base_url("assets/dash/vendor/datatables/dataTables.bootstrap4.js") ?>" ></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url("assets/dash/js/sb-admin.min.js") ?>" ></script>
    <!-- Custom scripts for this page-->
    <script src="<?php echo base_url("assets/dash/js/sb-admin-datatables.min.js") ?>" ></script>
    <script src="<?php echo base_url("assets/dash/js/sb-admin-charts.min.js") ?>" ></script>
  </div>
</body>

</html>
