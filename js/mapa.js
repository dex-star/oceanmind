    function initialize() {
      var marcadores = [
        ['Instituto Tecnologico de Felipe Carrillo Puerto',19.5830315,-88.0300896]
        
      ];
      var map = new google.maps.Map(document.getElementById('mapa'), {
        zoom: 16,
        center: new google.maps.LatLng(19.5830315,-88.0300896),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      var infowindow = new google.maps.InfoWindow();
      var marker, i;
      for (i = 0; i < marcadores.length; i++) {  
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(marcadores[i][1], marcadores[i][2]),
          map: map
        });
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent(marcadores[i][0]);
            infowindow.open(map, marker);
          }
        })(marker, i));
      }
    }
    