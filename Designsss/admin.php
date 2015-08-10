<?php 
include 'db_con.php';
include 'session.php';

if(!isset($_SESSION['login_user'])){
header("location: index.php");
}



 $user = $_SESSION['login_user'];

//$user = 'Gwapo ko!';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>BoholTCS</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 --> 
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


   <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>


   <link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      td,th{
        text-align: center;
      }
     
   </style>
<!--- Adding Admin-->
   <?php if (isset($_POST['username'])&&isset($_POST['password'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];
  // Prevention of SQL Injection
  $username = stripslashes($username);
  $password = stripslashes($password);
  $username = mysql_real_escape_string($username);
  $password = mysql_real_escape_string($password);

  $query = "SELECT * FROM tbl_admin WHERE username = '$username' OR password = '$password' ";
  $result = mysql_query($query);
  if(!$result){
    die("Could not connect to database!").mysql_error();
  }
  $num = mysql_num_rows($result);

  if ($num > 0 ) { 
    ?>
      <script type="text/javascript">
      alert("Username and/or Password is already existing");
      </script>

      <?php
      //header("location:profile.php#add-admin");
  }

  else{
    $query = "INSERT INTO `tbl_admin` (username,password) VALUES ('$username','$password')";
    $result = mysql_query($query);
    if (!$result) {
      die("something went wrong!").mysql_error();
    }
    else{
      ?>
        <script type="text/javascript">
        alert("Successfully saved!");
        window.location.href = "admin.php#add-admin";
        </script>
      <?php
    }
  }

  }
// End of adding Admin
// Add Tree
$tree = null;
  if (isset($_POST['color'])&&isset($_POST['tree'])) {

    $color = $_POST['color'];
    $tree = $_POST['tree'];

    $sth = mysql_query("SELECT * FROM tbl_trees");

        if(!$sth){echo "error";}

        $sentinel = 0;
        for($i = 0; $i < mysql_num_rows($sth); $i++)
        {
          $colorData = mysql_result($sth, $i, "color");
          $treeData = mysql_result($sth, $i, "tree_name");
          if($color == $colorData|| $tree == $treeData){
            $sentinel++;
          }
        }

        if ($sentinel>0) {
          ?>
            <script type="text/javascript">
                alert("Color and/or Tree name is already existing!");
                window.location.href = "admin.php#add-trees";
            </script>
          <?php
        }
        else{

            $query = mysql_query("INSERT INTO tbl_trees (tree_name, color) VALUES ('$tree','$color') ");
            if(!$query){
              die("Something went wrong!").mysql_error();
            }
            else{
              ?>
                  <script>
                      alert("Successfully Saved!");
                      window.location.href = "admin.php#add-trees";
                  </script>
              <?php
            }
        }
  }
// End Add Tree
?>
  <!-- script for google map -->
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
           $vertixReplace = mysql_result($result,$i,"vertices");
            $vertixReplace = str_replace("\\","\\\\",$vertixReplace);
          ?> 
         var decoded_path = google.maps.geometry.encoding.decodePath("<?php echo $vertixReplace; ?>");
          console.log("<?php echo $vertixReplace; ?>");
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
            fillOpacity: 0.8
          });

         drawPoly.setMap(map);
        
        <?php
        }
        ?>

} //End function initialize()

google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <style type="text/css">
      #map, html, body {
        padding: 0px 0px 0px 0px;
        margin: 0;
        height: 650px;
      }
    </style>
  </head>
  <body class="skin-green">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo"><b>Bohol</b>TCS</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <div class="row">
                  <div class="col-md-6">
                    <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                  </div>
                  <div class="col-md-1">  
                    <span class="hidden-xs"><?php echo $user ; ?></span>
                  <div class="col-md-6">
                </div>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $user; ?>
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
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
              <p>Bohol Tree</p>
              <p>Classification System</p>
             <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            </div>
          </div>
          <!-- search form -->
          
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
              <a href="admin.php">
                <i class="fa fa-home"></i> <span>Home</span> 
              </a>
            </li>
           
            <li class="treeview">
              <a href="javascript:;">
                <i class="fa fa-gears"></i> <span>File</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="javascript:;"><i class="fa fa-user"></i> Admin <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#add-admin" data-toggle="modal"><i class="fa fa-plus"></i> Add Admin</a></li>
                    <li><a href="#update-admin" data-toggle="modal"><i class="fa fa-pencil"></i> Edit Admin</a></li>
                    <li><a href="#delete-admin" data-toggle="modal"><i class="fa fa-trash"></i> Delete Admin</a></li>
                  </ul>
                </li>
                <li>
                  <a href="javascript:;"><i class="fa fa-pagelines"></i> Trees <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#add-trees" data-toggle="modal"><i class="fa fa-plus"></i> Add Trees</a></li>
                    <li><a href="#update-trees" data-toggle="modal"><i class="fa fa-pencil"></i> Edit Trees</a></li>
                    <li><a href="#delete-trees" data-toggle="modal"><i class="fa fa-trash"></i> Delete Trees</a></li>
                  </ul>
                </li>
                <li>
                  <a href="javascript:;"><i class="fa fa-map-marker"></i> Map <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="edit_map.php"><i class="fa fa-pencil"></i> Edit Map</a></li>
                  </ul>
                </li>
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
         <?php 
    include 'modal.php';
?>
          <!-- Main row -->
          <div id="map"></div>
          <div id="controls" style="background-color:green; width:100%; height: 15px;"></div>
     

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->s
           
     <!-- <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

   <script type="text/javascript">
    $(function(){
      var message_status = $("#status");
      $("td[contenteditable=true]").blur(function(){
        var field_userid = $(this).attr("id");
        var value = $(this).text();
        $.post('ajax.php',field_userid + "=" + value, function(data){
          if(data != '')
          {
            message_status.show();
            message_status.text(data);
            setTimeout(function(){message_status.hide()},5000);
          }
        });
      });
    });

    function deletes(ide,tabler){
      //alert(ide);
      
      var dat = "id="+encodeURIComponent(ide)+"&table="+encodeURIComponent(tabler);
      alert(dat);
    $.ajax({
           type: "POST",
           url: "delete.php",
           data: dat,
           success: function(msg){
             alert("Deleted!");
             //window.location.href = "admin.php";
           }
    });
}

  function checkColor(colorValue){
      //alert(colorValue);
      var foobar = document.getElementById("colorValue");
      foobar.innerHTML = "Color chosen: "+colorValue;
     // alert(foobar);
  }
  function deleteTree(ide){
    var dat = "id="+ide;
      //alert(dat);
    $.ajax({
           type: "POST",
           url: "deleteTree.php",
           data: dat,
           success: function(msg){
             alert("Deleted!");
             window.location.href = "admin.php";
           }
    });
  }
   </script>
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->

   <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
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