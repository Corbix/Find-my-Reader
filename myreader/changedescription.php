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
			<h3>Schimba Descrierea</h3><br>
			<form method="post" enctype="multipart/form-data">
                <input type="text" name="description"><br><br>
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
    $description = $_POST["description"];
    include('Includere/connection.php');
    $sql = "UPDATE `users` set description = '$description'  WHERE `email`='$email'";
    $datas = $dbh->query($sql);
    $dbh = null;
    echo '<script type="text/javascript">alert("Descrierea a fost schimbata cu succes")</script>';
    echo "<script>location.href = 'settings.php'</script>";
	}
?>
