<!DOCTYPE html>
<html> 
<head> 
   
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Google Maps Multiple Markers</title> 
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIguRNZw2LgNNNwnxQQAbGgTRf6dUrhfM&callback=initMap" 
          type="text/javascript">
  </script>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$( document ).ready(function() {
   getData();
    $(document).on('change','#userFilter',function(){        
        getData()    
    });
    function getData(){
        var values = $('#userFilter').serialize();
        $.ajax({
            url: "getUserData.php",
            type: "post",
            dataType: 'json',
            data: values ,
            success: function (response) {

                mapOpen(response);
               // you will get response from your php page (what you echo or print)                 

            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
    }            
});
</script>          
          
</head> 
<body>   
    <div> Select Status
        <select name="userFilter" id="userFilter">
            <option value="">Please Select</option>
            <option value="restaurant">Restaurant</option>
            <option value="bar">bar</option>
        </select>
    </div>
  <div id="map" style="width: 500px; height: 400px;"></div>

<script type="text/javascript">
function mapOpen(locations){   
   
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(-33.92, 151.25),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
}
  </script>
</body>
</html>