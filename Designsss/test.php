<?php

  include 'db_con.php';

include 'session.php';

if(!isset($_SESSION['login_user'])){
header("location: index.php");
}



 $user = $_SESSION['login_user'];
//saving the encoded vertices of a polygon
  
  if (isset($_POST["vertix"])) {
    $vertices = $_POST["vertix"];
    $color = $_POST["color"];

    $sth = mysql_query("SELECT * FROM tbl_trees");

        if(!$sth){echo "error";}

        for($i = 0; $i < mysql_num_rows($sth); $i++)
        {
          if(mysql_result($sth, $i, "color") == $color){
            $num = mysql_result($sth, $i, "tree_id");
          }
        }

    $query = mysql_query("INSERT INTO `tbl_poly` (vertices,tree_id) VALUES ('$vertices','$num')");

    if(!$query){

      //echo $vertices;
      echo $color;
      echo $vertices;
      echo $num;
      die("You have an error in your sql statement:: ").mysql_error();
    }
    else{
      ?>
        <script type="text/javascript">
        alert("Success!");
        </script>
      <?php
    }



  }

  else{

      // $query = mysql_query("SELECT vertices FROM tbl_poly");
      // if (mysql_num_rows($query)!=0) {
      //   for ($i=0; $i < mysql_num_rows($query) ; $i++) { 
      //     $vert[i] = $i["vertices"];
      //     echo $vert[$i];
      //   }
      // }

  }

if(isset($_GET['deletePoly']))
{
  $poly_id = $_GET['deletePoly'];

  $query = "DELETE FROM tbl_poly WHERE poly_id = '$poly_id'";
  $result = mysql_query($query);
  if(!$result){
    die("You have an error in your sql statement:: ").mysql_error();
  }
  else{
    ?>
        <script>
            alert("Successfully Deleted!");
        </script>
    <?php
  } 
}
if(isset($_POST['updatePoly'])&&isset($_POST['vertixUpdate'])){
  $poly_id = $_POST['updatePoly'];
  $poly_vertix = $_POST['vertixUpdate'];
  $query = "UPDATE tbl_poly SET vertices = '$poly_vertix' WHERE poly_id = '$poly_id' ";
  $result = mysql_query($query);
  if(!$result){
    die("Something went wrong!").mysql_error();
  }
  else{
    ?>
    <script>
        alert("Successfully Updated!");
    </script>
    <?php
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">
    <title>Design Tree Mapping</title>
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
    <script src="http://maps.google.com/maps/api/js?sensor=true&libraries=drawing,geometry,places&v=3.exp&signed_in=true"></script>
       <style type="text/css">
       html, body {
        padding: 0;
        margin: 0;
        height: 97.5%;
      }
      #map{
        width: 70%;
        height: 97.5%;
        float: left;
        margin-left: 3px;
      }
      .right{
        float: right;
        width: 14.8%;
      }
      #panel {
        width: 200px;
        font-family: Arial, sans-serif;
        font-size: 13px;
        float: left;
      }
      #color-palette {
        border: solid 2px white;
        padding: 0px 10px 10px 10px;
      }
      #color-palette h4{
        color: black;
      }

      .color-button {
        width: 100px;
        height: 30px;
        text-align: center;
        margin: 2px;
        float: left;
        cursor: pointer;
      }
      input{
        width: 100%;
      }

      #delete-button {
        margin-top: 5px;
      }
      .styled-select select {
   
   width: 100%;
   padding: 5px;
   font-size: 16px;
   line-height: 1;
   border: 0;
   border-radius: 0;
   height: 34px;
   }

   #directionsPanel td,#directionsPanel span{
      background-color: white;
   }
   #directionsPanel{
    height: 400px;
    overflow-y: scroll;
   }
        .controls {
        margin-top: 16px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        padding: 0 11px 0 13px;
        width: 400px;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        text-overflow: ellipsis;
      }

      #pac-input:focus {
        border-color: #4d90fe;
        margin-left: -1px;
        padding-left: 14px;  /* Regular padding-left + 1. */
        width: 401px;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
    </style>
   
    <script>


    <?php
  

        $sth = mysql_query("SELECT * FROM tbl_trees");

        if(!$sth){echo "error";}

        $rows = array();
        $tree_names = array();

        for($i = 0; $i < mysql_num_rows($sth); $i++)
        {
          $rows[] = mysql_result($sth, $i, "color");
          $tree_names[]=mysql_result($sth, $i, "tree_name");
        }
        
        // while($r = mysql_result($sth, "color") {
        //     $rows[] = $r;
        // }
        $json_array = json_encode($rows);
        $tree_array = json_encode($tree_names);
    ?>

      var drawingManager;
      var selectedShape;
      var colors = <?php echo $json_array; ?>;
      var tree_names = <?php echo $tree_array; ?>;
      var selectedColor;
      var colorButtons = {};

      function clearSelection() {
        if (selectedShape) {
          selectedShape.setEditable(false);
          selectedShape = null;
        }
      }

      function setSelection(shape) {
        clearSelection();
        selectedShape = shape;
        shape.setEditable(true);
        selectColor(shape.get('fillColor') || shape.get('strokeColor'));
  }

function checkPoly(selectedShape){

  var encode = google.maps.geometry.encoding.encodePath(selectedShape.getPath());
         // alert(encode);
          <?php 
              $query = "SELECT * FROM tbl_poly";
              $result = mysql_query($query);
              if(!$result){
                die("Something went wrong!").mysql_error();
              }
              $num = mysql_num_rows($result);
              for ($i=0; $i < $num ; $i++) { 
                ?>
                  if(encode == "<?php echo mysql_result($result, $i, 'vertices'); ?>"){
                    //alert("<?php echo mysql_result($result, $i, 'poly_id'); ?>");
                    // <?php
                    //   $poly_id = mysql_result($result, $i, 'poly_id');
                    //   //break;
                    // ?> 
                    return "<?php echo mysql_result($result, $i, 'poly_id'); ?>";
                  }
                <?php
              }
              
          ?>

}
      function deleteSelectedShape() {
        if (selectedShape) {
          var poly_id = checkPoly(selectedShape);
          //alert(poly_id);
          selectedShape.setMap(null);
          var deletePoly = document.getElementById("deletePoly");
          deletePoly.value = poly_id;
        }
      }

      function selectColor(color) {
        selectedColor = color;
        for (var i = 0; i < colors.length; ++i) {
          var currColor = colors[i];
          colorButtons[currColor].style.border = currColor == color ? '2px solid #789' : '2px solid #fff';
        }

        // Retrieves the current options from the drawing manager and replaces the
        // stroke or fill color as appropriate.

        var polygonOptions = drawingManager.get('polygonOptions');
        polygonOptions.fillColor = color;
        drawingManager.set('polygonOptions', polygonOptions);
      }

      function setSelectedShapeColor(color) {
        if (selectedShape) {
          if (selectedShape.type == google.maps.drawing.OverlayType.POLYLINE) {
            selectedShape.set('strokeColor', color);
          } else {
            selectedShape.set('fillColor', color);
          }
        }
      }

      function makeColorButton(color,tree) {
        var button = document.createElement('option');
        var colorSelect = document.getElementById('colorSelect'),
            filterSelect = document.getElementById('filterSelect');

        button.className = 'color-button';
        button.style.backgroundColor = color;
        button.innerHTML = tree;
        google.maps.event.addDomListener(button, 'click', function() {
          selectColor(color);
          setSelectedShapeColor(color);
        });

        google.maps.event.addDomListener(colorSelect,'change',function(){
            var val = colorSelect.options[colorSelect.selectedIndex].value;
            selectColor(val);
            setSelectedShapeColor(val);
            colorSelect.style.backgroundColor = val;
           });
        google.maps.event.addDomListener(filterSelect,'change',function(){
            var val = colorSelect.options[filterSelect.selectedIndex].value;
            selectColor(val);
            setSelectedShapeColor(val);
            filterSelect.style.backgroundColor = val;
           });


        return button;
      }

       function buildColorPalette() {
         var colorPalette = document.getElementById('color-palette');
         var colorSelect = document.getElementById('colorSelect'),
            filterSelect = document.getElementById('filterSelect');
         for (var i = 0; i < colors.length; ++i) {
           var currColor = colors[i];
           var currTree = tree_names[i];
           var colorButton = makeColorButton(currColor,currTree);
           
           colorSelect.options[colorSelect.options.length] = new Option(currTree,currColor);
           filterSelect.options[filterSelect.options.length] = new Option(currTree,currTree);

           colorSelect.options[i].setAttribute("id",currColor);

           filterSelect.options[i].setAttribute("id",currTree);

           var setOptionStyle = document.getElementById(currColor),
                filterOptionStyle = document.getElementById(currTree);

           setOptionStyle.style.backgroundColor = currColor;
           filterOptionStyle.style.backgroundColor = currColor;

           colorSelect.style.backgroundColor = colors[0];
           filterSelect.style.backgroundColor = colors[0];
           //colorSelect.appendChild(colorButton);
           colorButtons[currColor] = colorButton;
         }
         selectColor(colors[0]);

         filterSelect.options[filterSelect.options.length] = new Option("All","All");
         
        
       }

       function getAttribs(thiss){

          //alert(thiss.id);
              var vertices = thiss.getPath();
              var encodePath = google.maps.geometry.encoding.encodePath(vertices);

              var polyColor = thiss.get('fillColor');

              //alert(polyColor);
                var decodePath = google.maps.geometry.encoding.decodePath(encodePath);

               var doc = document.getElementById("vertix");
               doc.value = encodePath;
               var doc = document.getElementById("vertices");
               doc.value = decodePath;
               var doc = document.getElementById("color");
               doc.value = polyColor;

       }

var directionsDisplay;
var directionsService = new google.maps.DirectionsService();

      function initialize(){
        directionsDisplay = new google.maps.DirectionsRenderer();

        var mapOption = {
          zoom: 10,
          center: new google.maps.LatLng(9.796605699999999,124.2421597),
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          disableDefaultUI: false,
          zoomControl: true
        };
        var map = new google.maps.Map(document.getElementById('map'),
      mapOption);
        var polyOptions = {
          strokeWeight: 0,
          fillOpacity: 0.5,
          editable: true
        };


  var input = /** @type {HTMLInputElement} */(
      document.getElementById('pac-input'));

  var types = document.getElementById('type-selector');
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);

  var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29)
  });

  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      //map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);  // Why 17? Because it looks good.
    }
    marker.setIcon(/** @type {google.maps.Icon} */({
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(35, 35)
    }));
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }

    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
    infowindow.open(map, marker);
  });

  // Sets a listener on a radio button to change the filter type on Places
  // Autocomplete.
  function setupClickListener(id, types) {
    var radioButton = document.getElementById(id);
    google.maps.event.addDomListener(radioButton, 'click', function() {
      autocomplete.setTypes(types);
    });
  }

  setupClickListener('changetype-all', []);
  setupClickListener('changetype-address', ['address']);
  setupClickListener('changetype-establishment', ['establishment']);
  setupClickListener('changetype-geocode', ['geocode']);

        // Creates a drawing manager attached to the map that allows the user to draw
        // markers, lines, and shapes.
        drawingManager = new google.maps.drawing.DrawingManager({
         // drawingMode: google.maps.drawing.OverlayType.POLYGON,
          drawingControlOptions: {
          position: google.maps.ControlPosition.TOP_CENTER,
          drawingModes: [
            google.maps.drawing.OverlayType.MARKER,
            google.maps.drawing.OverlayType.POLYGON,
          ]
        },
          markerOptions: {
            draggable: true,
            clickable: true
          },
          polygonOptions: polyOptions,
          map: map
        });
        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
            var newShape = e.overlay;
            newShape.type = e.type;

            if (e.type != google.maps.drawing.OverlayType.MARKER) {
            // Switch back to non-drawing mode after drawing a shape.
            drawingManager.setDrawingMode(null);

            // Add an event listener that selects the newly-drawn shape when the user
            // mouses down on it.
            

            google.maps.event.addListener(newShape, 'click', function() {

              // Get coordinate of the vertices of a polygon

              getAttribs(this);
              setSelection(newShape);
            });
            setSelection(newShape);
          }
          else{
            if(newShape.type=='marker'){
              

              google.maps.event.addListener(newShape,'rightclick',function(){
                
                var lat2 = newShape.getPosition().lat(),
                    longi2 = newShape.getPosition().lng();

                var foo = document.getElementById("markerEndLat");
                foo.value = lat2;
                foo = document.getElementById("markerEndLong");
                foo.value = longi2;

                //newShape.setMap(null);
              })
            }
          }
        });

        //Printing of polygon saved in the database
        <?php

          if(isset($_GET['filter'])&& ($_GET['filter'] != "All"))
          {
            $tree_name = $_GET['filter'];
            $query = "SELECT tree_id FROM tbl_trees WHERE tree_name = '$tree_name'";
            $result = mysql_query($query);
            if(!$result){
              die("Something went wrong!").mysql_error();
            }
            $tree_id = mysql_result($result, 0);

            $query = "SELECT * FROM tbl_poly WHERE tree_id = '$tree_id'";
          }
          else{
            $query = "SELECT * FROM tbl_poly";
          }
          
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
              $poly_id = mysql_result($result,$i,"poly_id");
              $query = "SELECT * FROM tbl_trees WHERE tree_id='$tree_id'";
              $results = mysql_query($query);
              if (!$results) {
                echo "ERROR";
              }
          ?>
          var colorPoly = "<?php echo mysql_result($results, 0, 'color');?>";
          
        // Construct the polygon.
          var drawPoly = new google.maps.Polygon({
            id: <?php echo $poly_id ?>,
            paths: decoded_path,
            strokeColor: colorPoly,
            strokeOpacity: 0.8,
            strokeWeight: 0,
            fillColor: colorPoly,
            fillOpacity: 0.5
          });
         drawPoly.setMap(map);

         google.maps.event.addListener(drawPoly, 'click', function() {
              getAttribs(this);
              setSelection(this);
              var doc = document.getElementById("updatePoly");
              doc.value = this.id;           
        }); 

        <?php
        }
        ?>
       
        // Clear the current selection when the drawing mode is changed, or when the
        // map is clicked.
        google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
        google.maps.event.addListener(map, 'click', clearSelection);
        // google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById("directionsPanel"));
        
        buildColorPalette();

        calcRoute();

    }

    function calcRoute() {
    
    var lat2 = document.getElementById("markerEndLat").value,
        longi2 = document.getElementById("markerEndLong").value;
    var start = document.getElementById("pac-input").value;
    
    var end = new google.maps.LatLng(parseFloat(lat2),parseFloat(longi2));
    //alert(start+" "+end);
    var request = {
        origin:start,
        destination:end,
        travelMode: google.maps.TravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
      }
    });
  }

      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
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
                  <li><a href="extra_profile.html"><i class="icon-user"></i> My Profile</a>
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


      <div id="panel">
        <div id="color-palette">
          <div class="portlet box">
            <div class="portlet-title">
              <div class="caption"><i class="icon-edit"></i>Select Tree</div>
                 <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="javascript:;" class="reload"></a>
                 </div>
              </div>
            <div class="portlet-body">
              <div class="styled-select">
                <select id="colorSelect"></select>
                <br/>
                <h4>Filter by:</h4>
                <form method="GET" action="ako.php" role="form">
                  <select id="filterSelect" name="filter">
                  </select><br/>
                  <button type="submit">Filter</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <br/>
         <div id="color-palette">
          <div class="portlet box">
            <div class="portlet-title">
              <div class="caption"><i class="icon-edit"></i>Polygon</div>
                 <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                    <a href="javascript:;" class="reload"></a>
                 </div>
              </div>
            <div class="portlet-body">
              <form method="GET" action="ako.php" role="form">
                <input type="text" id="deletePoly" name="deletePoly" hidden />
                <button type="submit" onclick="deleteSelectedShape()" id="delete-button">Delete Selected Shape</button>
              </form>
            <br/>
              <form method="POST" action="ako.php" role="form">
                <textarea id="vertix" name="vertixUpdate" hidden></textarea>
                <input type="text" id="updatePoly" name="updatePoly" hidden />
                <button type="submit" onclick="updateSelectedShape()" id="update-button">Update Selected Shape</button>
              </form>
            <br/>
            <form method="POST" action="ako.php">
            <textarea id="vertix" name="vertix" hidden></textarea>
            <textarea id="vertices" style="height:100px; width:100%;" placeholder="Vertices Location"></textarea>
            <input type="text" name="color" id="color" placeholder="Color"/>
            
            <input type="submit" value="Save"/>
          </form>
            </div>
          </div>
      </div>
      <br/>

      </div>
      
  </div>
      <input id="pac-input" class="controls" type="text"
        placeholder="Enter a location">
    <div id="type-selector" class="controls">
      <input type="radio" name="type" id="changetype-all" checked="checked">
      <label for="changetype-all">All</label>

      <input type="radio" name="type" id="changetype-establishment">
      <label for="changetype-establishment">Establishments</label>

      <input type="radio" name="type" id="changetype-address">
      <label for="changetype-address">Addresses</label>

      <input type="radio" name="type" id="changetype-geocode">
      <label for="changetype-geocode">Geocodes</label>
    </div>

  <div id="map"></div>

  <div class="right">
           <div id="color-palette">
         <div class="portlet box">
              <div class="portlet-title">
                <div class="caption"><i class="icon-edit"></i>Directions</div>
                   <div class="tools">
                      <a href="javascript:;" class="collapse"></a>
                      <a href="javascript:;" class="reload"></a>
                   </div>
                </div>
              <div class="portlet-body">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><!-- 
              <input id="pac-input" class="controls" type="text" placeholder="Destination Search"> -->
              <label>Destination:</label>
        <input type="text" name="markerEndLat" id="markerEndLat" placeholder="Latitude" />
        <input type="text" name="markerEndLong" id="markerEndLong" placeholder="Longitude"/>
        <button onclick="calcRoute();">Get Direction</button>

                <br/>
        <div id="directionsPanel"></div> 
            </div>
          </div>
        </div>
  </div>
  
       <!-- end portlet for directions panel -->
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
</html>
