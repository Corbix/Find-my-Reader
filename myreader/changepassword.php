<?php
include("session.php");
?>

<!DOCTYPE html>
<html>
    <head>
    <title>My reader</title>
	<link rel="stylesheet" href="stylesheets/style.css">
	<link rel="stylesheet" href="stylesheets/settings.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&amp;display=swap&quot; rel=&quot;stylesheet">
</head>
	<body>
		<?php include('menu.php'); ?>
		<div class="setarimenu">
			<center>
			<h3>Schimba Parola</h3><br>
			<form method="post" enctype="multipart/form-data">
                <input type="password" name="password"><br><br>
                <br><br>
            <input type="submit" value="Submit">
            </form>
			</center>
		</div>
	</body>
</html>


<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
    $newpassword = $_POST["password"];
    if(strlen($newpassword) < 5)
		{
			echo '<script type="text/javascript">alert("Parola trebuie sa fie mai mare de 5 caractere")</script>';
			echo "<script>location.href = 'changepassword.php'</script>";
		}
    else{
	$newpassword = strtoupper(hash('whirlpool', $newpassword));
    include('Includere/connection.php');
    $sql = "UPDATE `users` set password = '$newpassword'  WHERE `email`='$email'";
    $datas = $dbh->query($sql);
    $dbh = null;
    echo '<script type="text/javascript">alert("Parola a fost schimbata cu succes")</script>';
    echo "<script>location.href = 'settings.php'</script>";
    }
	}
?>
