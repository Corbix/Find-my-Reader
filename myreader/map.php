<?php
include("session.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Find my reader</title>
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&amp;display=swap&quot; rel=&quot;stylesheet">
    <link rel="stylesheet" href="stylesheets/map.css">
</head>

<body>
    <?php include('menu.php'); ?>
    <div class="map" id="map">
        <script>
            var map, infoWindow;

            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: -34.397,
                        lng: 150.644
                    },
                    zoom: 15
                });
                infoWindow = new google.maps.InfoWindow;

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        infoWindow.setPosition(pos);
                        infoWindow.setContent('You are here.');
                        infoWindow.open(map);
                        map.setCenter(pos);
                    }, function () {
                        handleLocationError(true, infoWindow, map.getCenter());
                    });
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }
            }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.');
                infoWindow.open(map);
            }
        </script>
        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAi3LWaYOYnfZL0FMmeNbVgzMDfOtTFxzM&callback=initMap">
        </script>
    </div>
</body>

</html>

<!-- TODO: extract data from database and place markers for users -->