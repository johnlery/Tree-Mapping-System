<?php 
include 'db_con.php';

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>BoholTCS</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="assets/img/tree-icon.png" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

     <script src="http://maps.google.com/maps/api/js?sensor=true&libraries=drawing,geometry&v=3.exp&signed_in=true"></script>
  <!-- javascript for the controls and everything about the map -->
  <script>
          function initialize(){
             //alert("ASDASD");
            var mapOption = {
              zoom: 10,
              center: new google.maps.LatLng(9.796605699999999,124.2421597),
              mapTypeId: google.maps.MapTypeId.ROADMAP,
              disableDefaultUI: false,
              zoomControl: true
            };
            var map = new google.maps.Map(document.getElementById('map'),
          mapOption);
             //Printing of polygon saved in the database
        <?php
          $query = "SELECT * FROM tbl_poly";
          $result = mysql_query($query);
          if (!$result) {
            echo "ERROR";
          }

          $num = mysql_num_rows($result);

          for($i = 0; $i < $num; $i++){
          ?> 
         var decoded_path = google.maps.geometry.encoding.decodePath("<?php echo mysql_result($result,$i,"vertices");?>");
          <?php
              $tree_id = mysql_result($result,$i, "tree_id");

              $query = "SELECT * FROM tbl_trees WHERE tree_id='$tree_id'";
              $results = mysql_query($query);
              if (!$results) {
                echo "ERROR";
              }
          ?>
          var colorPoly = "<?php echo mysql_result($results, 0, 'color');?>";
          
        // Construct the polygon.
          var drawPoly = new google.maps.Polygon({
            paths: decoded_path,
            strokeColor: colorPoly,
            strokeOpacity: 0.8,
            strokeWeight: 0,
            fillColor: colorPoly,
            fillOpacity: 0.5
          });

         drawPoly.setMap(map);
        
        <?php
        }
        ?>

        }

          google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <style type="text/css">
      #map, html, body {
        padding: 0px 0px 0px 0px;
        margin: 0;
        height: 550px;
      }
    </style>
  </head>
  <body class="skin-green">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo"><b>Bohol</b>TCS</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="index.php">
                  <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                  <span class="hidden-xs">Admin Login</span>
                </a>
                
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/user2.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>     Bohol Tree</p>
              <p>Classification System</p>

              <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            </div>
          </div>
          <!-- search form -->
          
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">         </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pagelines"></i>
                <span>Trees</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <?php
                    include 'db_con.php';
                    $query = "SELECT * FROM tbl_trees";
                    $result = mysql_query($query);
                    if(!$result){
                      die("Something went wrong!").mysql_error();
                    }
                    $num = mysql_num_rows($result);
                    for ($i=0; $i <$num ; $i++) { 
                        $tree_id = mysql_result($result, $i, "tree_id");
                        $tree_name = mysql_result($result, $i, "tree_name");
                        echo "<li><a href='#' id='$tree_id'><i class='fa fa-pagelines'></i>$tree_name</a></li>";
                    }
                    ?>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-map-marker"></i>
                <span>Directions</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
         
          <!-- Main row -->
          <div id="map"></div>
          <div id="controls" style="background-color:green; width:100%; height: 15px;"></div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2014-2015 Hello.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->
   

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
    <!-- Morris.js charts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
    <script>
      jQuery(document).ready(function() {    
         App.init(); // initlayout and core plugins

         TableEditable.init();
      });
   </script>
  </body>
</html>