<?php
session_start();
if(!empty($_SESSION))
{
  if(isset($_SESSION["username"]))
  {
    header('Location: home.php');
  }
}
?>
<!DOCTYPE HTML>
<html>
<head>
  <title>Login</title>
<style>
.error {color: #FF0000;}
</style>
<link rel='stylesheet', href='/stylesheets/login.css'>
<link rel='stylesheet', href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap'>
<link rel='stylesheet', href='https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet'>
</head>
<body>
  <!--<block content>-->
<?php

// define variables and set to empty values
$usernameErr = $passwordErr = "";
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $usernameErr = "email is required";
  } else {
    //$username = test_input($_POST["username"]);
    // check if username only contains letters and whitespace
$username = $_POST["username"];
/*
    if (!preg_match("/^[_a-zA-Z1-9 ]*$/",$username)) {
      $usernameErr = "Only letters and white space allowed";
    }*/
  }

  if (empty($_POST["password"])) {
    $passwordErr = "password is required";
  } else {
    //$password = test_input($_POST["password"]);
    $password = $_POST["password"];
  }
}
/*
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}*/
?>
<div class="left-side"></div>

<div class="right-side">
<h3>FIND MY READER</h3>
<h1>Login</h1>
<!--
<form method="POST" action="/login" wtx-context="CF67E3E1-BD51-4DAD-81DB-EA49B1B79C8F">
-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<div class="form-group">
<label>Email:</label>
<br>
<!--
<input class="form-control" name="email" type="text" wtx-context="C3DA9422-3363-4AAE-9D29-BDB15F858B10" wtx-rule-v3="{{login.EmailAddress}}">
-->
  <input class="form-control" type="text" name="email" placeholder="Email" value="<?php echo $username;?>">
  <span class="error"><?php echo $usernameErr;?></span>

</div>
<div class="form-group">
<label>Password:</label>
<br>
<!--
<input class="form-control" name="password" type="password" wtx-context="27FCA426-ABE6-472D-8CFA-9CFBDD379512" wtx-rule-v3="{{login.Password}}">
-->
<input class="form-control" type="password" name="password" placeholder="Password" value="<?php echo $password;?>">
<span class="error"><?php echo $passwordErr;?></span>

</div>
<br>
<!--
<input class="btn btn-primary" type="submit" value="Login" wtx-context="D9209AEE-3413-471B-88BD-C94BE0AAA030">
-->
<input class="btn btn-primary" type="submit" name="submit" value="Login">

<br>
<p>You don't have an account? </p>
<a href="register.php">Register here!</a>
</form>
</div>


  <?php

  error_reporting(E_ALL);
  ini_set('display_errors', 'On');

  $query = "BEGIN accounts.login_account(:a_username, :a_password, :a_succes); END;";


  $c = oci_connect("STUDENT", "STUDENT", "");

  if (!$c) {
      $m = oci_error();
      trigger_error('Could not connect to database: '. $m['message'], E_USER_ERROR);
  }

  $s = oci_parse($c, $query);
  if (!$s) {
      $m = oci_error($c);
      trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
  }
  $password=strtoupper(md5($password));
  oci_bind_by_name($s,':a_username',$username);
  oci_bind_by_name($s,':a_password',$password);
  oci_bind_by_name($s,':a_succes',$succes,1);

  $r = oci_execute($s);
  if (!$r) {
      $m = oci_error($s);
      trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
  }

  if($succes){
  $_SESSION["username"]=$username;

  header('Location: home.php');
  }
  else{
  if($username&&$password)
  echo "<span class=error>Incorect data.</span>";
  }
  ?>
  </body>
</html>
