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
		<link rel='stylesheet', href='stylesheets/login.css'>
		<link rel='stylesheet', href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap'>
		<link rel='stylesheet', href='https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet'>
	</head>
	<body>
		<div class="left-side"></div>

		<div class="right-side">
		<h3>FIND MY READER</h3>
		<h1>Login</h1>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="form-group">
			<label>Email:</label>
			<br>
			<input class="form-control" type="text" name="email" placeholder="Email">
			</div>
			
			<div class="form-group">
			<label>Password:</label>
			<br>
			<input class="form-control" type="password" name="password" placeholder="Password">
			</div>
			<br>
			
			<input class="btn btn-primary" type="submit" name="submit" value="Login">
			<br>
			<p>You don't have an account? </p>
			<a href="register.php">Register here!</a>
		</form>
		</div>
	</body>
</html>


<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{	
		$email = $_POST["email"];
		$password = $_POST["password"];
		$password = strtoupper(hash('whirlpool', $password));
		include('Includere/connection.php');
		$sql = "SELECT * FROM `users` WHERE `email`='$email' AND `password`='$password'";
		$datas = $dbh->query($sql);
		$count = $datas->rowCount();
		if ($count == 1)
		{
			$_SESSION['email']=$email;
			echo "<script>location.href = 'home.php'</script>";
		}
		else
		{
			echo '<script type="text/javascript">alert("Ai introdus emailul sau parola gresit.")</script>';
			echo "<script>location.href = 'login.php'</script>";
		}
		$dbh = null;
	}
?>
