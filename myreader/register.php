<?php
session_start();
if(isset($_SESSION['email']))
{
	 echo "<script>location.href = 'home.php'</script>";	
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>My reader</title>
		<link rel='stylesheet', href='stylesheets/register.css'>
		<link rel='stylesheet', href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap'>
		<link rel='stylesheet', href='https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet'>
	</head>
	<body>
		<div class="left-side"></div>

		<div class="right-side">
		<h3>FIND MY READER</h3>
		<h1>Register</h1>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

		<div class="form-group">
		<label>Email:</label>
		<br>
		<input class="form-control" type="text" name="email" placeholder="Email">

		</div>
		<div class="form-group">
		<label>First Name:</label>
		<br>

		<input class="form-control" type="text" name="firstname" placeholder="First Name">

		</div>
		<div class="form-group">
		<label>Last Name:</label>
		<br>

		<input class="form-control" type="text" name="lastname" placeholder="Last Name">

		</div>
		<div class="form-group">
		  <label>Password:</label>
		  <br>
		<input class="form-control" type="password" name="password" placeholder="Password">
		</div>

		<br>
		<input class="btn btn-primary" type="submit" name="submit" value="Register">
		  <br>
		  <p>You already have an account?</p>
		  <a href="login.php">Login here!</a>
		</form>
		</div>
	</body>
</html>

<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{	
		$email = $_POST["email"];
		$password = $_POST["password"];
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		if(strlen($email) < 5 || strlen($password) < 5 || strlen($firstname) < 2 || strlen($lastname) < 2 || !strpos($email,'@'))
		{
			echo '<script type="text/javascript">alert("Emailul trebuie sa fie valid, mai mare de 5 caractere, iar parola trebuie sa fie mai mare de 5 caractere")</script>';
			echo "<script>location.href = 'register.php'</script>";	
		}
		else
		{
			include('Includere/connection.php');
			$sql = "SELECT `email` FROM `users` WHERE `email`='$email'";
			$datas = $dbh->query($sql);
			$count = $datas->rowCount();
			if ($count == 0)
			{
				$sql = "INSERT INTO `users`(`email`, `password`, `firstname`, `lastname`) VALUES ('$email','$password','$firstname','$lastname')";
				$datas = $dbh->query($sql);
				echo '<script type="text/javascript">alert("Contul dumneavostra a fost creat cu succes.")</script>';
				echo "<script>location.href = 'login.php'</script>";		
			}
			else 
			{
				echo '<script type="text/javascript">alert("Exista deja un cont cu acest username.")</script>';
				echo "<script>location.href = 'register.php'</script>";
			}
			$dbh = null;
		}
	}
  ?>
