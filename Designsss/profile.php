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
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.0
Version: 1.5.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title>Design Mapping</title>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <meta name="MobileOptimized" content="320">
   <!-- BEGIN GLOBAL MANDATORY STYLES -->          
   <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
   <!-- END GLOBAL MANDATORY STYLES -->
   <!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 
   <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
   <link href="assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
   <link href="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css"/>
   <!-- END PAGE LEVEL PLUGIN STYLES -->
   <!-- BEGIN THEME STYLES --> 
   <link href="assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/plugins.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/pages/tasks.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
   <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
   <!-- END THEME STYLES -->
   <link rel="shortcut icon" href="favicon.ico" />

   <style type="text/css">
      td,th{
        text-align: center;
      }
     
   </style>

   <?php if (isset($_POST['username'])&&isset($_POST['password'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];

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
        window.location.href = "profile.php#add-admin";
				</script>
			<?php
		}
	}

	}

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
                window.location.href = "profile.php#add-trees";
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
                      window.location.href = "profile.php#add-trees";
                  </script>
              <?php
            }
        }
  }
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
        padding: 5px 5px 5px 5px;
        margin: 0;
        height: 550px;
      }
    </style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
   <!-- BEGIN HEADER -->   
   <div class="header navbar navbar-inverse navbar-fixed-top">
      <!-- BEGIN TOP NAVIGATION BAR -->
      <div class="header-inner">
         <!-- BEGIN LOGO -->  
         <a class="navbar-brand" href="index.html">
         <img src="assets/img/logo.png" alt="logo" class="img-responsive" /> 
         </a>
         <!-- END LOGO -->
         <!-- BEGIN RESPONSIVE MENU TOGGLER --> 
         <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
         <img src="assets/img/menu-toggler.png" alt="" />
         </a> 
         <!-- END RESPONSIVE MENU TOGGLER -->

         <!-- BEGIN TOP NAVIGATION MENU -->
         <ul class="nav navbar-nav pull-right">
            
            <!-- BEGIN USER LOGIN DROPDOWN -->
            <li class="dropdown user">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
               <img alt="" src="assets/img/avatar1_small.jpg"/>
               <span class="username"><?php echo $user; ?></span>
               <i class="icon-angle-down"></i>
               </a>
               <ul class="dropdown-menu">
                  <li><a href="#"><i class="icon-user"></i><?php echo $user; ?></a>
                  </li>
                  <li class="divider"></li>
                  <li><a href="javascript:;" id="trigger_fullscreen"><i class="icon-move"></i> Full Screen</a>
                  </li>
                  <li><a href="logout.php"><i class="icon-key"></i> Log Out</a>
                  </li>
               </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
         </ul>
         <!-- END TOP NAVIGATION MENU -->
      </div>
      <!-- END TOP NAVIGATION BAR -->
   </div>
   <!-- END HEADER -->
   <div class="clearfix"></div>

   <!-- BEGIN CONTAINER -->
   <div class="page-container">

      <!-- BEGIN SIDEBAR -->

      <div class="page-sidebar navbar-collapse collapse">

         <!-- BEGIN SIDEBAR MENU -->        
         <ul class="page-sidebar-menu">
          <br>
          <br>
         <!--  <hr/> -->

            <li class="start active ">
               <a href="profile.php">
               <i class="icon-home"></i> 
               <span class="title">Home</span>
               <span class="selected"></span>
               </a>
            </li>
            <li class="">
               <a href="javascript:;">
               <i class="icon-cogs"></i> 
               <span class="title">File</span>
               <span class="arrow "></span>
               </a>
               <ul class="sub-menu">
                  <li >
                     <a href="">
                     Admin <span class="arrow "></span>
                     </a>
                     <ul class="sub-menu">
                     	<li>
                        <i class="icon-user-md"></i> 
                     		<a href="#add-admin" data-toggle="modal">Add Admin</a>
                     	</li>
                     	<li>
                     		<a href="#update-admin" data-toggle="modal">Update Admin</a>
                     	</li>
                     	<li>
                     		<a href="#delete-admin" data-toggle="modal">Delete Admin</a>
                     	</li>
                     </ul>
                  </li>
                  <li >
                     <a href="javascript:;">
                     Trees
                     <span class="arrow "></span>
                     </a>
                     <ul class="sub-menu">
                     	<li>
                     		<a href="#add-trees" data-toggle="modal">Add Trees</a>
                     	</li>
                     	<li>
                     		<a href="#update-trees" data-toggle="modal">Update Trees</a>
                     	</li>
                     	<li>
                     		<a href="#delete-trees" data-toggle="modal">Delete Trees</a>
                     	</li>
                     </ul>
                  </li>
                  <li >
                     <a href="javascript:;">
                     Map
                     <span class="arrow "></span></a>
                     <ul class="sub-menu">
                     	<li>
                     		<a href="test.php">Edit Map</a>
                     	</li>
                     </ul>
                  </li>
                  
               </ul>
            </li>
         </ul>
         <!-- END SIDEBAR MENU -->

      </div>
      <!-- END SIDEBAR -->

      <div class="page-content">
               <!-- BEGIN STYLE CUSTOMIZER -->
         <div class="theme-panel hidden-xs hidden-sm">
            <div class="toggler"></div>
            <div class="toggler-close"></div>
            <div class="theme-options">
               <div class="theme-option theme-colors clearfix">
                  <span>THEME COLOR</span>
                  <ul>
                     <li class="color-black current color-default" data-style="default"></li>
                     <li class="color-blue" data-style="blue"></li>
                     <li class="color-brown" data-style="brown"></li>
                     <li class="color-purple" data-style="purple"></li>
                     <li class="color-grey" data-style="grey"></li>
                     <li class="color-white color-light" data-style="light"></li>
                  </ul>
               </div>
               <div class="theme-option">
                  <span>Layout</span>
                  <select class="layout-option form-control input-small">
                     <option value="fluid" selected="selected">Fluid</option>
                     <option value="boxed">Boxed</option>
                  </select>
               </div>
               <div class="theme-option">
                  <span>Header</span>
                  <select class="header-option form-control input-small">
                     <option value="fixed" selected="selected">Fixed</option>
                     <option value="default">Default</option>
                  </select>
               </div>
               <div class="theme-option">
                  <span>Sidebar</span>
                  <select class="sidebar-option form-control input-small">
                     <option value="fixed">Fixed</option>
                     <option value="default" selected="selected">Default</option>
                  </select>
               </div>
               <div class="theme-option">
                  <span>Footer</span>
                  <select class="footer-option form-control input-small">
                     <option value="fixed">Fixed</option>
                     <option value="default" selected="selected">Default</option>
                  </select>
               </div>
            </div>
         </div>
         <!-- END BEGIN STYLE CUSTOMIZER --> 
<?php 
    include 'modal.php';
?>
                     
      	<div class="container">
      		<div id="map"></div>
          <div id="controls" style="background-color:blue; width:100%; height: 20px;"></div>
      	</div>
      </div>
   </div>
   <!-- END CONTAINER -->
   <!-- BEGIN FOOTER -->
   <div class="footer">
      <div class="footer-inner">
         2015 &copy; Apollojohn15.
      </div>
      <div class="footer-tools">
         <span class="go-top">
         <i class="icon-angle-up"></i>
         </span>
      </div>
   </div>
   <!-- END FOOTER -->
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

    function deletes(ide){
      //alert(ide);
      
      var dat = "id="+ide;
      //alert(dat);
    $.ajax({
           type: "POST",
           url: "delete.php",
           data: dat,
           success: function(msg){
             alert("Deleted!");
             window.location.href = "profile.php";
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
             window.location.href = "profile.php";
           }
    });
  }
   </script>

   <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
   <!-- BEGIN CORE PLUGINS -->   
   <!--[if lt IE 9]>
   <script src="assets/plugins/respond.min.js"></script>
   <script src="assets/plugins/excanvas.min.js"></script> 
   <![endif]-->   
   <script src="assets/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>   
   <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
   <script src="assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
   <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
   <script src="assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
   <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
   <script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
   <script src="assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
   <script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
   <!-- END CORE PLUGINS -->
   <!-- BEGIN PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="assets/scripts/app.js" type="text/javascript"></script>
   <script src="assets/scripts/tasks.js" type="text/javascript"></script>        
   <!-- END PAGE LEVEL SCRIPTS -->  
    <!-- END CORE PLUGINS -->
   <!-- BEGIN PAGE LEVEL PLUGINS -->
   <script type="text/javascript" src="assets/plugins/select2/select2.min.js"></script>
   <script type="text/javascript" src="assets/plugins/data-tables/jquery.dataTables.js"></script>
   <script type="text/javascript" src="assets/plugins/data-tables/DT_bootstrap.js"></script>
   <!-- END PAGE LEVEL PLUGINS -->
   <!-- BEGIN PAGE LEVEL SCRIPTS -->
   <script src="assets/scripts/table-editable.js"></script>     
   <script>
      jQuery(document).ready(function() {    
         App.init(); // initlayout and core plugins

         TableEditable.init();
      });
   </script>
   <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>