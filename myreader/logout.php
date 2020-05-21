<?php
include("session.php");
include('Includere/connection.php');
$sql = "UPDATE `users` SET `last_latitude` = NULL , `last_longitude` = NULL WHERE `email` = '$email'";
$datas = $dbh->query($sql);
session_unset();
session_destroy();
echo "<script>location.href = 'login.php'</script>";
?>
