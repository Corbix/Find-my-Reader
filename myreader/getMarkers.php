<?php
include("session.php");
include('Includere/connection.php');

$sql1 = "SELECT b.ISBN FROM `users` AS u JOIN `books` AS b JOIN `books_users` AS bu ON bu.ISBN = b.ISBN AND bu.email = '$email'";
$datas = $dbh->query($sql1);
$count = $datas->rowCount();

if($count > 0){
    if($datas !== false) {
        foreach($datas as $row) 
        {
            $books_user[] = $row['ISBN'];
		}
    }
}

$sql2 = "SELECT last_latitude, last_longitude from `users` WHERE email = '$email'";
$datas = $dbh->query($sql2);
if ($datas !== false) {
    foreach($datas as $row) {
        $lat = $row['last_latitude'];
        $long = $row['last_longitude'];  
    }
}

$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);
$sql = "SELECT *  FROM `users` AS u 
        JOIN `books` AS b 
        JOIN `books_users` AS bu 
        ON bu.ISBN = b.ISBN AND bu.email = u.email 
        WHERE bu.ISBN IN ('" . implode("','", $books_user) . "')  
        AND ((u.last_latitude <= '$lat' + 0.0015 AND u.last_longitude <= '$long' + 0.004) OR (u.last_latitude <= '$lat' - 0.0015 AND u.last_longitude <= '$long' - 0.004)
        OR (u.last_latitude <= '$lat' + 0.0015 AND u.last_longitude <= '$long' - 0.004) OR (u.last_latitude <= '$lat' - 0.0015 AND u.last_longitude <= '$long' + 0.004))";

$datas = $dbh->query($sql);
$count = $datas->rowCount();
header("Content-type: text/xml");
    if ($count > 0) {
        if($datas !== false) {
           foreach($datas as $row) {
               $node = $dom->createElement("marker");
               $newnode = $parnode->appendChild($node);
               $newnode->setAttribute("email", $row['email']);
               $newnode->setAttribute("firstname", $row['firstname']);
               $newnode->setAttribute("lastname", $row['lastname']);
               $newnode->setAttribute("lat", $row['last_latitude']);
               $newnode->setAttribute("long", $row['last_longitude']);
               $newnode->setAttribute("avatar", $row['avatar']);
               $newnode->setAttribute("books", $row['title']);
	        }
        }
    }

echo $dom->saveXML();

$dbh = null;

