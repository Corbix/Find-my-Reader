<?php
include("session.php");

$c_email = $_GET['email'];
include('Includere/connection.php');
$sql = "SELECT * FROM `users` WHERE `email`='$c_email'";
$datas = $dbh->query($sql);
$count = $datas->rowCount();
if ($count == 1)
{
	if($datas !== false)
	{
		foreach($datas as $row)
		{
			$c_idutilizator = $row['id'];
			$c_firstname = $row['firstname'];
			$c_lastname = $row['lastname'];
			$c_avatar = $row['avatar'];
			$c_description = $row['description'];
			$c_birthday = $row['data_nasterii'];
		}
	}
}
$dbh = null;
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
		<div class="right-side" style="padding-left: 150px; padding-top: 25px">
			<div class="avatarprofile">
				<!-- <a href="<?php echo "images/avatars/".$c_avatar; ?>"><img src="<?php echo "images/avatars/".$c_avatar; ?>" alt=""></a> -->
				<img src="<?php echo "images/avatars/".$c_avatar; ?>" alt="">
			</div>
			<h3>Detalii cont</h3>
			<p>
				Prenume: <?php echo $c_firstname;?><br><br>

				Nume: <?php echo $c_lastname;?><br><br>

				Email: <?php echo $c_email;?><br><br>

				<?php if ($c_birthday){ ?>
				Varsta: <?php
				$dob = strtotime(str_replace("/","-",$c_birthday));
				$tdate = time();

				$c_age = 0;
				while( $tdate > $dob = strtotime('+1 year', $dob))
				{
					++$c_age;
				}
				echo "$c_age";
				?><br><br>
				<?php } ?>

				<?php if ($c_description){ ?>
				Descriere: <?php echo $c_description; ?><br><br>
				<?php } ?>

				<?php
				include('Includere/connection.php');
				$sql = "SELECT * FROM `genres_users` WHERE `email` = '$c_email'";
				$datas = $dbh->query($sql);
				$count = $datas->rowCount();
				if ($count >= 1)
				{
					echo "Genuri preferate: ";
					if($datas !== false)
					{
						$den="";
						foreach($datas as $row)
						{
							if($den)
							echo ", ";
							$den = $row['denumire'];
							echo $den;
						}
					}
					echo "<br><br>";
				}
				$dbh = null;
				?>


				<?php
				include('Includere/connection.php');
				$sql = "SELECT * FROM `books_users` WHERE `email` = '$c_email'";
				$datas = $dbh->query($sql);
				$count = $datas->rowCount();
				if ($count >= 1)
				{
					echo "Carti citite (ISBN): ";
					if($datas !== false)
					{
						$isbn="";
						foreach($datas as $row)
						{
							if($isbn)
							echo ", ";
							$isbn = $row['ISBN'];
							echo $isbn;
						}
					}
				}
				$dbh = null;
				?>
			</p>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<input class="btn btn-primary" type="submit" name="send_request" value="Send request">
			</form>
		</div>
	</body>
</html>
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$sql = "INSERT INTO `notifications`(`to_user`, `from_user`, `state`, `time_sent `) VALUES ('$c_email','$email','pending','SYSDATE')";
		$datas = $dbh->query($sql);
	}
?>
