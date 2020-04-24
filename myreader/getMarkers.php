<?php
include('Includere/connection.php');

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

$sql = "SELECT * FROM `users` WHERE 1";
$datas = $dbh->query($sql);
$count = $datas->rowCount();
header("Content-type: text/xml");
    if ($count > 0) {
        if($datas !== false) {
           foreach($datas as $row) {
               $node = $dom->createElement("marker");
               $newnode = $parnode->appendChild($node);
               $newnode->setAttribute("id", $row['id']);
               $newnode->setAttribute("firstname", $row['firstname']);
               $newnode->setAttribute("lastname", $row['lastname']);
               $newnode->setAttribute("lat", $row['last_latitude']);
               $newnode->setAttribute("long", $row['last_longitude']);
               $newnode->setAttribute("avatar", $row['avatar']);
	        }
        }
    }

echo $dom->saveXML();


