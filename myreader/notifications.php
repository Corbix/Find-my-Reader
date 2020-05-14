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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
	<body>
		<?php include('menu.php'); ?>
        <script>
        const menu = document.getElementById('menu-notifications');
        menu.setAttribute('class', 'active');
        </script>
        <div class="right-side">
        <?php
			include('Includere/connection.php');
            $sql = "SELECT * FROM `notifications` WHERE `to_user` = '$email' ORDER BY `time_sent` DESC";
            $datas = $dbh->query($sql);
            $count = $datas->rowCount();
				
            if($datas !== false) 
            {
                echo "<div class=primite>";
                echo "Received";
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
								<input type="submit" name="accept" value="accept" class='btn'/> 
								<input type="submit" name="refuse" value="refuse" class='btn'/> 
							</form> 
                        </div>
                    <?php
					}
					elseif ($c_state == "confirmed"){
                        echo "<div class=notification>
                        You accepted the meeting request from $c_from_user!
                        </div>";
                    }
                    elseif ($c_state == "refused") {
                        echo "<div class=notification>
                        You declined the meeting request from $c_from_user!
                        </div>";
                    }
                }
                echo "</div>";
			}
			$dbh = null;
		
			
            include('Includere/connection.php');
            $sql = "SELECT * FROM `notifications` WHERE `from_user` = '$email' ORDER BY `time_sent` DESC";
            $datas = $dbh->query($sql);
            $count = $datas->rowCount();
            if($datas !== false) 
            {
                echo "<div class=trimise id=trimise>";
                echo "Sent";
                foreach($datas as $row) 
                {
                    $c_to_user = $row['to_user'];
                    $c_state = $row['state'];
                    $c_time_sent = $row['time_sent'];
            
                    if ($c_state == "pending"){
                        // echo "<div class=notification>
                        // Your request to user $c_to_user is pending...
                        // </div>";
                        echo "<script>
                        var app = document.getElementById('trimise');
                        var newDiv = document.createElement('div');
                        newDiv.setAttribute('class', 'notification');
                        newDiv.textContent = `Your request to user $c_to_user is pending...`
                        app.appendChild(newDiv);
                        </script>";
                    }
                    elseif ($c_state == "confirmed"){
                        // echo "<div class=notification>
                        // User $c_to_user accepted your request!
                        // </div>";
                        echo "<script>
                        var app = document.getElementById('trimise');
                        var newDiv = document.createElement('div');
                        newDiv.setAttribute('class', 'notification');
                        newDiv.textContent = `User $c_to_user accepted your request!`
                        app.appendChild(newDiv);
                        </script>";
                    }
                    elseif ($c_state == "refused") {
                        // echo "<div class=notification>
                        // User $c_to_user refused your request.
                        // </div>";
                        echo "<script>
                        var app = document.getElementById('trimise');
                        var newDiv = document.createElement('div');
                        newDiv.setAttribute('class', 'notification');
                        newDiv.textContent = `User $c_to_user refused your request!`
                        app.appendChild(newDiv);
                        </script>";
                    }
                }
                echo "</div>";
            }
            $dbh = null;
        ?>

        </div>
    
    </body>
</html>
