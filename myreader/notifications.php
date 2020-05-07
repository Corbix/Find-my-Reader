<?php
include("session.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My reader</title>
	    <link rel="stylesheet" href="stylesheets/style.css">
        <link rel="stylesheet" href="stylesheets/notifications.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;display=swap">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&amp;display=swap&quot; rel=&quot;stylesheet">
	    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,300&display=swap" rel="stylesheet">
    </head>
	<body>
		<?php include('menu.php'); ?>
        <div class="right-side">
        <center>
        <?php
			include('Includere/connection.php');
            $sql = "SELECT * FROM `notifications` WHERE `to_user` = '$email' ORDER BY `time_sent` DESC";
            $datas = $dbh->query($sql);
            $count = $datas->rowCount();
			if ($count > 0)
				echo "PRIMITE";
            if($datas !== false) 
            {
                foreach($datas as $row) 
                {
                    $c_from_user = $row['from_user'];
					$c_to_user = $row['to_user'];
                    $c_state = $row['state'];
                    $c_time_sent = $row['time_sent'];
            
					if ($c_state == "pending"){
					?>
                        <div class="received">
                            <div class="item1">
                                <?php echo "User $c_from_user would like to meet you!"; ?>
                            </div>
							<?php
							if(isset($_POST['accept'])) { 
								$sql = "UPDATE `notifications` SET `state`='confirmed' WHERE `to_user` = '$c_to_user' and `from_user` = '$c_from_user'";
								$datas = $dbh->query($sql);
								echo "<script>location.href = 'notifications.php'</script>";
							} 
							if(isset($_POST['refuse'])) { 
								$sql = "UPDATE `notifications` SET `state`='refused' WHERE `to_user` = '$c_to_user' and `from_user` = '$c_from_user'";
								$datas = $dbh->query($sql);
								echo "<script>location.href = 'notifications.php'</script>";
							} 
							?>
							
                            <form method="post"> 
								<input type="submit" name="accept" value="accept"/> 
								<input type="submit" name="refuse" value="refuse"/> 
							</form> 
                        </div>
                    <?php
					}
					elseif ($c_state == "confirmed"){
                        echo "<div class=notification>
                        Ai acceptat invitatia utilizatorului $c_from_user!
                        </div>";
                    }
                    elseif ($c_state == "refused") {
                        echo "<div class=notification>
                        Ai refuzat invitatia utilizatorului $c_from_user!
                        </div>";
                    }
				}
			}
			$dbh = null;
		
			if ($count > 0)
				echo "TRIMISE";
            include('Includere/connection.php');
            $sql = "SELECT * FROM `notifications` WHERE `from_user` = '$email' ORDER BY `time_sent` DESC";
            $datas = $dbh->query($sql);
            $count = $datas->rowCount();
            if($datas !== false) 
            {
                foreach($datas as $row) 
                {
                    $c_from_user = $row['from_user'];
                    $c_state = $row['state'];
                    $c_time_sent = $row['time_sent'];
            
                    if ($c_state == "pending"){
                        echo "<div class=notification>
                        Your request to user $c_from_user is pending...
                        </div>";
                    }
                    elseif ($c_state == "confirmed"){
                        echo "<div class=notification>
                        User $c_from_user accepted your request!
                        </div>";
                    }
                    elseif ($c_state == "refused") {
                        echo "<div class=notification>
                        User $c_from_user refused your request.
                        </div>";
                    }
                }
            }
            $dbh = null;
        ?>
        </center>
        </div>
    </body>
</html>
