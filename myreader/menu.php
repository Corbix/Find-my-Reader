<div class="menu" id='menu'>
	<h3>Find my reader</h3>
	<center>
	<div class="avatarprofile">
		<!-- <a href="<?php echo "images/avatars/".$avatar; ?>"><img src="<?php echo "images/avatars/".$avatar; ?>" alt=""></a> -->
		<img src="<?php echo "images/avatars/".$avatar; ?>" alt="">
	</div>
	</center>
	<p>Hello,
		<?php echo $firstname;?>
	</p>
	<a id='menu-home' href="home.php">Home</a>
	<hr><a id='menu-map' href="map.php">Map</a>
	<hr><a id='menu-notifications' href="notifications.php">Notifications <?php
	include('Includere/connection.php');
	$sql = "SELECT * FROM `notifications` WHERE `to_user` = '$email' and `state` = 'pending'";
	$datas = $dbh->query($sql);
	$count = $datas->rowCount();
	if ($count > 0)
	echo "($count)"?></a>
	<hr><a id='menu-settings' href="settings.php">Settings</a>
	<hr id="logouthr"><a href="logout.php" id="logout">Logout</a>

</div>
