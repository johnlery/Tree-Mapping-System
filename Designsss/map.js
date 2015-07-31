
      var drawingManager;
      var selectedShape;
      var colors = ['#1E90FF', '#FF1493', '#32CD32', '#FF8C00', '#4B0082','#FFF000','000FFF'];
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

      function deleteSelectedShape() {
        if (selectedShape) {
          selectedShape.setMap(null);
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
        var polylineOptions = drawingManager.get('polylineOptions');
        polylineOptions.strokeColor = color;
        drawingManager.set('polylineOptions', polylineOptions);

        var rectangleOptions = drawingManager.get('rectangleOptions');
        rectangleOptions.fillColor = color;
        drawingManager.set('rectangleOptions', rectangleOptions);

        var circleOptions = drawingManager.get('circleOptions');
        circleOptions.fillColor = color;
        drawingManager.set('circleOptions', circleOptions);

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

      function makeColorButton(color) {
        var button = document.createElement('span');
        button.className = 'color-button';
        button.style.backgroundColor = color;
        google.maps.event.addDomListener(button, 'click', function() {
          selectColor(color);
          setSelectedShapeColor(color);
        });

        return button;
      }

       function buildColorPalette() {
         var colorPalette = document.getElementById('color-palette');
         for (var i = 0; i < colors.length; ++i) {
           var currColor = colors[i];
           var colorButton = makeColorButton(currColor);
           colorPalette.appendChild(colorButton);
           colorButtons[currColor] = colorButton;
         }
         selectColor(colors[0]);
       }

      function initialize() {
        var mapOption = {
          zoom: 10,
          center: new google.maps.LatLng(9.796605699999999,124.2421597),
          mapTypeId: google.maps.MapTypeId.TERRAIN,
          disableDefaultUI: false,
          zoomControl: true
        };

        var map = new google.maps.Map(document.getElementById('map'),
      mapOption);






        var polyOptions = {
          strokeWeight: 0,
          fillOpacity: 0.45,
          editable: true
        };
        // Creates a drawing manager attached to the map that allows the user to draw
        // markers, lines, and shapes.
        drawingManager = new google.maps.drawing.DrawingManager({
          drawingMode: google.maps.drawing.OverlayType.POLYGON,
          markerOptions: {
            draggable: true
          },
          polylineOptions: {
            editable: true
          },
          rectangleOptions: polyOptions,
          circleOptions: polyOptions,
          polygonOptions: polyOptions,
          map: map


        });
        




        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
            if (e.type != google.maps.drawing.OverlayType.MARKER) {
            // Switch back to non-drawing mode after drawing a shape.
            drawingManager.setDrawingMode(null);

            // Add an event listener that selects the newly-drawn shape when the user
            // mouses down on it.
            var newShape = e.overlay;
            newShape.type = e.type;

            google.maps.event.addListener(newShape, 'click', function() {

            	// Get coordinate of the vertices of a polygon
            	var vertices = this.getPath();
              var encodePath = google.maps.geometry.encoding.encodePath(vertices);
               var decodePath = google.maps.geometry.encoding.decodePath(encodePath);

               var doc = document.getElementById("vertix");

               doc.value = encodePath;

             //  alert(encodePath);
             //   alert(decodePath);
             //   alert(vertices);



		  // for (var i =0; i < vertices.getLength(); i++) {
		  //   var xy = vertices.getAt(i);
		  //   alert('Coordinate ' + i + ':latitude: ' + xy.lat() + ', longitude: ' +
		  //       xy.lng());
		  // }
              setSelection(newShape);
            });
            setSelection(newShape);
          }
        });


// var encoded_path = 'cwf{@_mvtVxsO`z]h_MiyY';

//         var decoded_path = google.maps.geometry.encoding.decodePath(encoded_path.replace(/\\/g,"\\\\"));
//         alert(encoded_path);
//         // Construct the polygon.
//           bermudaTriangle = new google.maps.Polygon({
//             paths: decoded_path,
//             strokeColor: '#FF0000',
//             strokeOpacity: 0.8,
//             strokeWeight: 2,
//             fillColor: '#FF0000',
//             fillOpacity: 0.35
//           });

//           bermudaTriangle.setMap(map);
          

        // Clear the current selection when the drawing mode is changed, or when the
        // map is clicked.
        google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
        google.maps.event.addListener(map, 'click', clearSelection);
        google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);

        buildColorPalette();
      }
      google.maps.event.addDomListener(window, 'load', initialize);
 