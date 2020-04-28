<?php
include("session.php");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Find my reader</title>
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="stylesheet" href="stylesheets/map.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&amp;display=swap&quot; rel=&quot;stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,300&display=swap" rel="stylesheet">
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
                    zoom: 18
                });
                infoWindow = new google.maps.InfoWindow;

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        let str = `You are here!`;
                        var newurl = "/myreader/map.php?lat=" + pos.lat + "&long=" + pos.lng;
                        window.onload = window.history.pushState({
                            path: newurl
                        }, '', newurl);
                        infoWindow.setPosition(pos);
                        infoWindow.setContent(str);
                        infoWindow.open(map);
                        map.setCenter(pos);
                    }, function () {
                        handleLocationError(true, infoWindow, map.getCenter());
                    });
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }

                downloadUrl('/myreader/getMarkers.php', function (data) {
                    var xml = data.resnponseXML;
                    var xml = data.responseXML;
                    var markers = xml.documentElement.getElementsByTagName('marker');
                    Array.prototype.forEach.call(markers, function (markerElem) {
                        var email = markerElem.getAttribute('email');
                        var firstname = markerElem.getAttribute('firstname');
                        var lastname = markerElem.getAttribute('lastname');
                        var avatar = markerElem.getAttribute('avatar');
                        var title = markerElem.getAttribute('books');

                        var point = new google.maps.LatLng(
                            parseFloat(markerElem.getAttribute('lat')),
                            parseFloat(markerElem.getAttribute('long')));

                        var infowincontent = document.createElement('div');
                        infowincontent.style.display = 'flex';
                        infowincontent.style.flexDirection = 'row';

                        var infoLeft = document.createElement('div');
                        infoLeft.style.display = 'flex';
                        infoLeft.style.flexDirection = 'column';
                        infoLeft.style.padding = '15px';
                        infoLeft.style.marginRight = '15px';
                        
                        var strong = document.createElement('strong');
                        strong.textContent = firstname + " " + lastname;
                        infowincontent.appendChild(infoLeft);
                        infoLeft.appendChild(strong);
                        // infowincontent.appendChild(document.createElement('br'));
                        
                        var br = document.createElement('br');
                        infoLeft.appendChild(br);

                        var text = document.createElement('text');
                        text.textContent = `"` + title + `"`;
                        text.style.fontWeight = '500';
                        text.style.color = '#A7CCA7';
                        infoLeft.appendChild(text);

                        var button = document.createElement('button');
                        button.textContent = 'View profile';
                        button.setAttribute('id', 'view-profile');
                        button.style.position = 'absolute';
                        button.style.bottom = '15px';
                        infoLeft.appendChild(button);

                        // var sendNotification = document.createElement('button')
                        // sendNotification.textContent = 'See profile';
                        // infoLeft.appendChild(sendNotification);

                        var infoRight = document.createElement('div');
                        infoRight.className = 'avatarDiv';
                        var user_avatar = document.createElement('img');
                        user_avatar.src = 'images/avatars/' + avatar;
                        infowincontent.appendChild(infoRight);
                        infoRight.appendChild(user_avatar);

                        var icon = {};
                        var marker = new google.maps.Marker({
                            map: map,
                            position: point,
                            label: icon.label
                        });
                        marker.addListener('click', function () {
                            infoWindow.setContent(infowincontent);
                            infoWindow.open(map, marker);
                        });
                    });
                });
            }

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.');
                infoWindow.open(map);


            }

            function downloadUrl(url, callback) {
                var request = window.ActiveXObject ?
                    new ActiveXObject('Microsoft.XMLHTTP') :
                    new XMLHttpRequest;

                request.onreadystatechange = function () {
                    if (request.readyState == 4) {
                        request.onreadystatechange = doNothing;
                        callback(request, request.status);
                    }
                };

                request.open('GET', url, true);
                request.send(null);
            }

            function doNothing() {}

        // TODO: show only markers that are close to the user and have the same read books 
        // add the same read books for each marker

        </script>
        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAi3LWaYOYnfZL0FMmeNbVgzMDfOtTFxzM&callback=initMap">
        </script>
        <?php 

include('Includere/connection.php');
if ($_GET['lat'] == NULL || $_GET['long'] == NULL){
    ;
} else {
    $sql = "SELECT `last_latitude`, `last_longitude` FROM `users` WHERE `email`='$email'";
    $datas = $dbh->query($sql);
    $count = $datas->rowCount();
    if ($count == 1) {
        if($datas !== false) {
            foreach($datas as $row) {
                $last_longitude = $row['last_longitude'];
                $last_latitude = $row['last_latitude'];
            }
        }
    }
    $lat = $_GET['lat'];
    $long = $_GET['long'];

    if($last_longitude != $long || $last_latitude != $lat) {
    $sql = "UPDATE `users` set last_latitude = '$lat', last_longitude = '$long' WHERE `email`='$email'";
    $datas = $dbh->query($sql);
    $dbh = null;
    }
}
?>

    </div>
    
</body>

</html>

