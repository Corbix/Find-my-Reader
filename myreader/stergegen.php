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
			<h3>Sterge preferinte gen</h3><br>
			<form method="post" enctype="multipart/form-data">
				<input list="gens" name="dengens">
				<datalist id="gens">
					<?php
					include('Includere/connection.php');
					$sql = "SELECT * FROM `genres_users` WHERE `email` = '$email'";
					$datas = $dbh->query($sql);
					$count = $datas->rowCount();
					if($datas !== false) 
					{
						foreach($datas as $row) 
						{
							$den = $row['denumire'];
							echo "<option value='$den'>";
						}
					}
					$dbh = null;
					?>
				</datalist>
				<input type="submit" value="Submit">
            </form>
			</center>
		</div>
	</body>
</html>

<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{	
		$dengen = $_POST["dengens"];
		include('Includere/connection.php');
		$sql = "DELETE FROM `genres_users` WHERE `denumire`='$dengen' and `email`='$email'";
		$datas = $dbh->query($sql);
		echo "<script>location.href = 'settings.php'</script>";	
	}
?>