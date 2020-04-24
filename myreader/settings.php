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
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,300&display=swap" rel="stylesheet">
</head>
	<body>
		<?php include('menu.php'); ?>

		<div class="right-side">
		<h3>Setari cont</h3><br>
		<div class="settings-header"> 
			<h2> Setari cont 
		</div>
		<div class="setarimenu" id="setarimenu">
			<!-- <center> -->
			
			<ul>
				<li><a href="#">Schimba parola</a></li>
				<li><a href="changeavatar.php">Adauga/Modifica/Sterge poza de profil</a></li>
				<li><a href="#">Adauga/Modifica data nasterii</a></li>
				<li><a href="#">Adauga/Modifica descriere cont</a></li>
				<li><a href="#">Adauga/Modifica Google Account</a></li>
				<li><a href="#">Adauga preferinta genuri</a></li>
				<li><a href="#">Sterge preferinta genuri</a></li>
				<li><a href="#">Adauga carte citita</a></li>
				<li><a href="#">Sterge carte citita</a></li>
			</ul>
			<!-- </center> -->
		</div>
		</div>

		<script>
		function myFunction() {
			var settings = document.getElementById('setarimenu');
			if (settings.style.display == "none") {
				settings.style.display = "block";
			} else {
				settings.style.display = "none";
			}
		}
		</script>
	</body>
</html>