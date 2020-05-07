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
            $sql = "SELECT * FROM `notifications` WHERE `to_user` = '$email'";
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
                    elseif ($c_state == "received"){
                        echo "<div class=received>
                                <div class=item1>
                                    User $c_from_user would like to meet you!
                                </div>
                                <button class=item2 onclick=accept($c_from_user)>accept</button>
                                <button class=item3 onclick=refuse($c_from_user)>refuse</button>
                        </div>";
                    }
                    echo "<br>";
                }
            }
            $dbh = null;

            function accept($from_user){
                $sql = "DELETE FROM `notifications`
                    WHERE `to_user` = '$email' AND `from_user` = '$from_user'";
                $sql = "DELETE FROM `notifications`
                    WHERE `to_user` = '$from_user' AND `to_user` = '$email'";
                $sql = "INSERT INTO `notifications` 
                    VALUES('$from_user', '$email', 'confirmed', sysdate)";
            }

            function refuse($from_user){
                $sql = "DELETE FROM `notifications`
                    WHERE `to_user` = '$email' AND `from_user` = '$from_user'";
                $sql = "DELETE FROM `notifications`
                    WHERE `to_user` = '$from_user' AND `to_user` = '$email'";
                $sql = "INSERT INTO `notifications` 
                    VALUES('$from_user', '$email', 'refused', sysdate)";
            }
        ?>
        </center>
        </div>
    </body>
</html>
