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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&amp;display=swap&quot; rel=&quot;stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,300&display=swap" rel="stylesheet">
</head>
	<body>
		<div class="menu" id='menu'>
			<h3>Find my reader</h3>
			<div class="avatarprofile">
				<!-- <a href="<?php echo "images/avatars/".$c_avatar; ?>"><img src="<?php echo "images/avatars/".$c_avatar; ?>" alt=""></a> -->
				<img src="<?php echo "images/avatars/".$c_avatar; ?>" alt="">
			</div>
			<p>
				<?php echo $c_firstname;?>
				<?php echo $c_lastname;?>
			</p>
		</div>
		<div class="right-side">
			<h3>Detalii cont</h3><br>
			<p>
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
				
				Genuri preferate:
				<?php
				include('Includere/connection.php');
				$sql = "SELECT * FROM `genres_users` WHERE `email` = '$c_email'";
				$datas = $dbh->query($sql);
				$count = $datas->rowCount();
				if($datas !== false) 
				{
					foreach($datas as $row) 
					{
						$den = $row['denumire'];
						echo $den;
						echo ", ";
					}
				}
				$dbh = null;
				?><br><br>
				
				Carti citite:
				<?php
				include('Includere/connection.php');
				$sql = "SELECT * FROM `books_users` WHERE `email` = '$c_email'";
				$datas = $dbh->query($sql);
				$count = $datas->rowCount();
				if($datas !== false) 
				{
					foreach($datas as $row) 
					{
						$isbn = $row['ISBN'];
						echo $isbn;
						echo ", ";
					}
				}
				$dbh = null;
				?>
			</p>
		</div>
	</body>
</html>