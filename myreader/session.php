<?php
session_start();
if(!isset($_SESSION['email']))
{
   echo "<script>location.href = 'login.php'</script>";	
}
$email = $_SESSION['email'];
include('Includere/connection.php');
$sql = "SELECT * FROM `users` WHERE `email`='$email'";
$datas = $dbh->query($sql);
$count = $datas->rowCount();
if ($count == 1)
{
    if($datas !== false) 
    {
        foreach($datas as $row) 
        {
			$firstname = $row['firstname'];
		}
	}
}
$dbh = null;
?>