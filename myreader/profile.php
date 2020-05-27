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
	<link rel="stylesheet" href="stylesheets/profile.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;display=swap">
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&amp;display=swap&quot; rel=&quot;stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,300&display=swap" rel="stylesheet">
</head>

<body>
	<?php include('menu.php'); ?>
	<?php
		if ($email != $c_email) {
		include('Includere/connection.php');
		$sql = "SELECT * FROM `notifications` WHERE `state` = 'pending' and ((`to_user` = '$c_email' and `from_user` = '$email') or (`to_user` = '$email' and `from_user` = '$c_email'))";
		$datas = $dbh->query($sql);
		$count = $datas->rowCount();
		if ($count > 0)
		{
			$msg = "Request pending";
		}
		else
		{

			$msg = 'Request meeting';
		}
	}
	else
	{
		$msg = "You can't meet yourself!";
	}
		?>

	<div class="right-side">
		<center>
			<div class='background'>
			</div>
		</center>
		<div class="avatarprofile">
			<!-- <a href="<?php echo "images/avatars/".$c_avatar; ?>"><img src="<?php echo "images/avatars/".$c_avatar; ?>" alt=""></a> -->
			<img src="<?php echo "images/avatars/".$c_avatar; ?>" alt="">
		</div>


		<div class='name'>
		<?php echo "<h3> $c_firstname  $c_lastname, ";
			if ($c_birthday){

				$dob = strtotime(str_replace("/","-",$c_birthday));
				$tdate = time();

				$c_age = 0;
				while( $tdate > $dob = strtotime('+1 year', $dob))
				{
					++$c_age;
				}
				echo "$c_age </h3>";

				}
			else {
				$c_age = '';
			}
		?>
			<form method="post" class='desktop-request' action="<?php echo "profile.php?email=$c_email";?>">
			<input class="btn btn-primary" id='button' type="submit" name="send_request" value="<?php echo $msg;?>">
			</form>
		</div>
		<div class='bottom-side'>

		<div class='da'>

		<h4 class='mobile-name'> <?php echo "$c_firstname $c_lastname, $c_age"; ?> </h4>
		<form method="post" class='mobile-send-request'>
			<input class="btn btn-primary" id='button' type="submit" name="send_request" value="<?php echo $msg;?>">
		</form>
		<script>
				const send = document.getElementById('button');
				if (send.value == "You can't meet yourself!" || send.value == "Request pending") {
					send.disabled = true;
					send.style.cursor = 'not-allowed';
				}
		</script>
		<div class='desc' id='desc'>

			<?php if ($c_description){
				echo "<h4> About: </h4>";
				echo "<p id='paragr'>";
				echo $c_description;
				echo "</p>";
			}
			?><br><br>
			<script>
			const paragr = document.getElementById('paragr');
			if(paragr == null) {
				document.getElementById('desc').style.display = 'none';
			}
			</script>
		</div>


		<div class='favorite-genre' id='favorite-genre'>

			<?php
				include('Includere/connection.php');
				$sql = "SELECT * FROM `genres_users` WHERE `email` = '$c_email'";
				$datas = $dbh->query($sql);
				$count = $datas->rowCount();
				if ($count >= 1)
				{
					echo "<h4> Favorite genres: </h4>";
					echo "<p id=paragraph>";
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
					echo "</p>";

				}
				$dbh = null;
				?>
				<script>
			const para = document.getElementById('paragraph');
			if(para == null) {
				document.getElementById('favorite-genre').style.display = 'none';
			}
		</script>
		</div>
		</div>

		<div class='books' id='books'>

			<?php
				include('Includere/connection.php');
				$sql = "SELECT * FROM `books_users` WHERE `email` = '$c_email' ORDER BY `time_add`";
				$datas = $dbh->query($sql);
				$count = $datas->rowCount();
				if ($count >= 1)
				{

					if($datas !== false)
					{

						foreach($datas as $row)
						{
							$isbn = $row['ISBN'];
							echo "<script>
							link = 'https://www.googleapis.com/books/v1/volumes?q=$isbn';
							console.log(link);
							var app = document.getElementById('books');
							fetch(link)
          					.then(
            				function (response) {
              				if (response.status !== 200) {
                				console.log('Looks like there was a problem. Status code: ' + response.status);
                				return;
              				}

              				response.json().then(function (data) {
								for (var i = 0; i < 1; i++) {
									var item = data.items[i];
									if (item) {
									const ahref = document.createElement('a');
									ahref.href = item.volumeInfo.infoLink;
									const card = document.createElement('div');
									card.setAttribute('class', 'book-cover');

									const cover = document.createElement('img');
									if (item.volumeInfo.imageLinks) {
									cover.src = item.volumeInfo.imageLinks.smallThumbnail;
									cover.href = item.volumeInfo.infoLink;
									}
									else {
										cover.src = 'images/default-book.png'
									}

									const h2 = document.createElement('h2');
									h2.innerHTML += item.volumeInfo.title;
									h2.style.color = 'rgb(111, 155, 111)';
									const h4 = document.createElement('h4');
									h4.innerHTML += item.volumeInfo.authors;

									app.appendChild(card);
									card.append(ahref);
									ahref.append(cover);
									card.appendChild(h2);
									card.appendChild(h4);
									}
                  					}
                			});
            				})
                			.catch(function (err) {
                  			console.log('Fetch error: -S', err);
                			});
							</script>";
						}
					}
				}
				$dbh = null;
				?>
		</div>


	</div>
	</div>
</body>

</html>

<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		include('Includere/connection.php');
		$sql = "INSERT INTO `notifications`(`to_user`, `from_user`, `state`, `time_sent`) VALUES ('$c_email','$email','pending',now())";
		$datas = $dbh->query($sql);
		$dbh = null;
	}
?>
