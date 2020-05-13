<?php
include("session.php");
?>


<!DOCTYPE html>
<html>

<head>
	<title>My reader</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
	<script>
    const menu = document.getElementById('menu-settings');
    menu.setAttribute('class', 'active');
    </script>
	<div class="right-side">
		<h3>Account settings</h3><br>

		<!-- CHANGE PASSWORD -->
		<div class="settings-header" onclick="myFunction('changePassword')">
			<h2 style="text-align:left;float:left;"> Change password
				<h2 style="text-align:right;float:right;"> &#709
		</div>

		<div id='changePassword'>
			<form method="post" enctype="multipart/form-data">
				<input class="form-control" type="password" name="password" placeholder="New password"
					style="opacity:0.7;"><br>
				<input class="btn btn-primary" type="submit" value="Submit" name='password-submit'>
			</form>

		</div>

		<!-- CHANGE PROFILE PICTURE -->
		<div class="settings-header" onclick="myFunction('changeAvatar')">
			<h2 style="text-align:left;float:left;"> Change profile photo
				<h2 style="text-align:right;float:right;"> &#709
		</div>

		<div id="changeAvatar">
			<form method="post" enctype="multipart/form-data">
				<input class="form-control" type="file" name="avatar"><br>
				<input class='checkbox' type="checkbox" name="rmphoto" value="1">Remove Photo Profile
				<br><br>
				<input class="btn btn-primary" type="submit" value="Submit" name='avatar-submit'>
			</form>
		</div>

		<!-- CHANGE DATE OF BIRTH -->
		<div class="settings-header" onclick="myFunction('changeBirth')">
			<h2 style="text-align:left;float:left;"> Change date of birth
				<h2 style="text-align:right;float:right;"> &#709
		</div>

		<div id='changeBirth'>
		<form method="post" enctype="multipart/form-data">
			<label>Tell other readers when your birthday is:</label> <br>
			<input class="form-control" type="date" name="birthdate"><br>
			<input class="btn btn-primary" type="submit" value="Submit" name="birth-submit">
		</form>
		</div>

		<!-- CHANGE DESCRIPTION -->

		<div class="settings-header" onclick="myFunction('changeDescription')">
			<h2 style="text-align:left;float:left;"> Change profile description
				<h2 style="text-align:right;float:right;"> &#709
		</div>

		<div id='changeDescription'> 
		<form method="post" enctype="multipart/form-data">
			<label>Say a few words about yourself: </label><br>
			<textarea class="form-control" type="text" name="description" rows="5" cols="80"></textarea><br>
			<input class="btn btn-primary" type="submit" value="Submit" name="desc-submit">
		</form>
		</div>

		<!-- MODIFY GENRES -->

		<div class="settings-header" onclick="myFunction('addGenres')">
			<h2 style="text-align:left;float:left;"> Modify favorite genres
				<h2 style="text-align:right;float:right;"> &#709
		</div>

		<div id='addGenres'>
			<h4> Your genres</h4><br>
			<div class='book-cover' id='genre1'>
			<?php
			include('Includere/connection.php');
			$sql = "SELECT * FROM `genres_users` WHERE `email` = '$email'";
			$datas = $dbh->query($sql);
			$count = $datas->rowCount();
			if($datas !== false) 
			{
				foreach($datas as $row) 
				{
					echo "<div id='bk'>
						<h3> {$row['denumire']}
						</div>
						";
				}
			}
			$dbh = null;
			?>
			</div>
			<br>

			<!-- ADD GENRES -->

			<label>Add your favorite genres:</label><br>
				<form method="post" enctype="multipart/form-data">
					<input class="form-control" list="gens" name="dengens">
					<datalist id="gens">
						<?php
					include('Includere/connection.php');
					$sql = "SELECT * FROM `genres`";
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
					$dbh = null;?>
					</datalist>
					<input class="btn btn-primary" type="submit" value="Add" name='genre-submit'>
				</form>

				<!-- DELETE GENRES -->

				<label>Delete genres:</label><br>
					<form method="post" enctype="multipart/form-data">
						<input class="form-control" list="gens" name="dengens">
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
						<input class="btn btn-primary" type="submit" value="Delete" name='delete-genre-submit'>
					</form>
		</div>

		<!-- ADD BOOKS -->

		<div class="settings-header" onclick="myFunction('modifyBooks')">
			<h2 style="text-align:left;float:left;"> Modify books
				<h2 style="text-align:right;float:right;"> &#709
		</div>

		<div id='modifyBooks'>
			<label>Search for books or authors: </label> <br>
			<input id="source" class='form-control' placeholder='Search..'">
  			<button class="btn btn-primary" id='search' type='button' onclick="addBooks()"> Search</button>
  			<div id='books'></div>
  			<div id='formular'></div>
		</div>

		<script>

    function addBooks() {
      document.getElementById('books').innerHTML = "";
      var input = document.getElementById('source');
      // var auth = document.getElementById('author');
      link = "https://www.googleapis.com/books/v1/volumes?q=" + input.value.split(' ').join('+')+"&orderBy=relevance";
      var app = document.getElementById('books');

	  const config = { attributes: true, childList: true, subtree: true };
	  const callback = function(mutationsList, observer) {
    	for(let mutation of mutationsList) {
        	if (mutation.type === 'childList') {
            	document.getElementById('books').scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
        }
        else if (mutation.type === 'attributes') {
            console.log('The ' + mutation.attributeName + ' attribute was modified.');
        }
    	}
		};

	const observer = new MutationObserver(callback);
	observer.observe(app, config);

        fetch(link)
          .then(
            function (response) {
              if (response.status !== 200) {
                console.log('Looks like there was a problem. Status code: ' + response.status);
                return;
              }

              response.json().then(function (data) {
                  let cover;
                  for (var i = 0; i < data.items.length; i++) {
                    var item = data.items[i];
                    const title = item.volumeInfo.title;
                    const author = item.volumeInfo.authors;
                    const isbn = item.volumeInfo.industryIdentifiers[0].identifier;

                    const card = document.createElement('div');
                    card.setAttribute('class', 'book-cover');
                    card.setAttribute('id', 'resulted-books');
                    card.addEventListener('click', function() {
                      fillForm(isbn, title, author);
                    }, true);
					card.addEventListener('click', function() {
                      card.style.background = 'rgba(255, 254, 254, 0.459)';
					  card.style.borderRadius = '8px';
                    }, true);

                    const h2 = document.createElement('h2');
                    h2.innerHTML += item.volumeInfo.title;
					const h3 = document.createElement('h3');
					h3.innerHTML += 'by';
                    const h4 = document.createElement('h4');
                    h4.innerHTML += item.volumeInfo.authors;

                    app.appendChild(card);
                    card.appendChild(h2);
					card.appendChild(h3);
                    card.appendChild(h4);
                  }
                });
            }
          )
                .catch(function (err) {
                  console.log('Fetch error: -S', err);
                });


            }

      function fillForm(isbn, title, author) {
		
        var app = document.getElementById('formular');
		app.innerHTML = '';

        const form = document.createElement('form');
        form.method = 'post';

        const input = document.createElement('input');
        input.setAttribute('class', 'form-control');
        input.setAttribute('type','hidden');
        input.setAttribute('name', 'isbn');
        input.setAttribute('value', isbn);

        const titlu = document.createElement('input');
        titlu.setAttribute('class', 'form-control');
        titlu.setAttribute('type','hidden');
        titlu.setAttribute('name', 'title');
        titlu.setAttribute('value', title);

        const autor = document.createElement('input');
        autor.setAttribute('class', 'form-control');
        autor.setAttribute('type','hidden');
        autor.setAttribute('name', 'author');
        autor.setAttribute('value', author);

        const send = document.createElement('input');
        send.setAttribute('class', 'btn btn-control');
        send.setAttribute('type', 'submit');
        send.setAttribute('value', 'Add book');
        send.setAttribute('name', 'book-submit');

        app.appendChild(form);
        form.appendChild(input);
        form.appendChild(titlu);
        form.appendChild(autor);
        form.appendChild(send);
      }


    
  </script>

	<!-- DELETE BOOKS -->
		<div class="settings-header" onclick="myFunction('deleteBooks')">
			<h2 style="text-align:left;float:left;"> Delete books
				<h2 style="text-align:right;float:right;"> &#709
		</div>

		<div id='deleteBooks'>
			<label>Search for books: </label> <br>
			<form method="post" enctype="multipart/form-data">
				<input class="form-control" list="gens" name="dengens">
				<datalist id="gens">
			</form>
		</div>

	<!-- SHOW/HIDE HEADERS -->
		<script>
			function myFunction(id) {
				var settings = document.getElementById(id);
				settings.style.display = settings.style.display == "block" ? "none" : "block";
				settings.scrollIntoView({behavior: "smooth", block: "end", inline: "nearest"});
			}

		</script>

</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!empty($_POST['password-submit'])) {
    		$newpassword = $_POST["password"];
    		if(strlen($newpassword) < 5) {
				$msg = "Your password must be at least 5 characters long";
			}
    		else{
				$newpassword = strtoupper(hash('whirlpool', $newpassword));
    			include('Includere/connection.php');
    			$sql = "UPDATE `users` set password = '$newpassword'  WHERE `email`='$email'";
    			$datas = $dbh->query($sql);
    			$dbh = null;
				echo "<script>location.href = 'settings.php'</script>";
    			}
		}
		if (!empty($_POST['birth-submit'])) {
			$birthdate = $_POST["birthdate"];
			include('Includere/connection.php');
			$sql = "UPDATE `users` set data_nasterii = '$birthdate'  WHERE `email`='$email'";
			$datas = $dbh->query($sql);
			$dbh = null;
			echo "<script>location.href = 'settings.php'</script>";
		}
		if (!empty($_POST['desc-submit'])) {
			$description = $_POST["description"];
			include('Includere/connection.php');
			$sql = "UPDATE `users` set description = '$description'  WHERE `email`='$email'";
			$datas = $dbh->query($sql);
			$dbh = null;
			echo '<script type="text/javascript">alert("Descrierea a fost schimbata cu succes")</script>';
			echo "<script>location.href = 'settings.php'</script>";
		}
		if (!empty($_POST['genre-submit'])) {
			$dengen = $_POST["dengens"];
			include('Includere/connection.php');
			$sql = "SELECT `email` FROM `genres_users` WHERE `denumire`='$dengen' AND `email` ='$email'";
			$datas = $dbh->query($sql);
			$count = $datas->rowCount();
			if ($count == 0)
			{
				$sql = "INSERT INTO `genres_users`(`email`, `denumire`) VALUES ('$email','$dengen')";
				$datas = $dbh->query($sql);
				$dbh = null;
				echo "<script>location.href = 'settings.php'</script>";	
			}
			else
			{
				echo '<script type="text/javascript">alert("Ai deja adaugat acest gen.")</script>';
				echo "<script>location.href = 'settings.php'</script>";
			}
		}
		if(!empty($_POST['delete-genre-submit'])) {
			$dengen = $_POST["dengens"];
			include('Includere/connection.php');
			$sql = "DELETE FROM `genres_users` WHERE `denumire`='$dengen' and `email`='$email'";
			$datas = $dbh->query($sql);
			echo "<script>location.href = 'settings.php'</script>";	
			echo "Genre deleted!";
		}
		if(!empty($_POST['avatar-submit'])) {	
			$rmphoto = $_POST["rmphoto"];
			if ($rmphoto == '1')
			{
				if ($avatar != 'basic.jpg')
				{
					unlink("images/avatars/".$avatar);
					include('Includere/connection.php');
					$sql = "UPDATE `users` set avatar = 'basic.jpg' WHERE `email`='$email'";
					$datas = $dbh->query($sql);
					$dbh = null;
					echo "<script>location.href = 'settings.php'</script>";	
				}
			}
			else
			{
				$okay = 0;
				if (!empty($_FILES['avatar']) and $removeok == 0) 
				{
					if (isset($_FILES["avatar"]["name"]) && $_FILES["avatar"]["tmp_name"] != "")
					{
						$fileName = $_FILES["avatar"]["name"];
						$fileTmpLoc = $_FILES["avatar"]["tmp_name"];
						$fileType = $_FILES["avatar"]["type"];
						$fileSize = $_FILES["avatar"]["size"];
						$fileErrorMsg = $_FILES["avatar"]["error"];
						$kaboom = explode(".", $fileName);
						$fileExt = end($kaboom);
						list($width, $height) = getimagesize($fileTmpLoc);
						if ($width >= 10 && $height >= 10) 
						{
							$db_file_name = $idutilizator."_".$fileName;
							if($fileSize <= 10485765) 
							{
								if (preg_match("/\\.(gif|jpg|png)$/i", $fileName)) 
								{
									if ($fileErrorMsg == 0) 
									{
										$moveResult = move_uploaded_file($fileTmpLoc, "images/avatars/".$db_file_name);
										if ($moveResult == true) 
										{
											if ($avatar != 'basic.jpg')
											{
												unlink("images/avatars/".$avatar);
											}
											include('Includere/connection.php');
											$sql = "UPDATE `users` set avatar = '$db_file_name' WHERE `email`='$email'";
											$datas = $dbh->query($sql);
											$dbh = null;
											$okay = 1;
											echo "<script>location.href = 'settings.php'</script>";	
										}
									}
								}
							}
						}
					}
				}
				if ($okay == 0)
				{
					echo '<script type="text/javascript">alert("Imaginea nu a putut fi schimbata. Verifica ca dimensiunea sa fie mai mica de 10mb")</script>';
					echo "<script>location.href = 'settings.php'</script>";
				}
			}
		}
		if (!empty($_POST['book-submit'])) {
			$isbn = $_POST["isbn"];
			$author = $_POST["author"];
			$title = str_replace("'", "\'", $_POST["title"]);

			include('Includere/connection.php');
			$sql = "INSERT IGNORE INTO `books`(`ISBN`, `title`, `author`) VALUES ('$isbn','$title','$author')";
			$datas = $dbh->query($sql);
			$sql1 = "INSERT INTO `books_users`(`email`, `ISBN`, `time_add`) VALUES ('$email','$isbn', now())";
			$datas = $dbh->query($sql1);
			$dbh = null;
			echo '<script type="text/javascript">alert("Ai adaugat cartea cu succes")</script>';
			echo "<script>location.href = 'settings.php'</script>";
		}
}
?>