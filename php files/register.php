<!DOCTYPE HTML>
<html>
<head>
  <title>Register</title>
<style>
.error {color: #FF0000;}
</style>
<link rel='stylesheet', href='/stylesheets/register.css'>
<link rel='stylesheet', href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap'>
<link rel='stylesheet', href='https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet'>
</head>
<body>
  <!--<block content>-->
<?php
// define variables and set to empty values
$usernameErr = $passwordErr = $password0Err = "";
$username = $password = $password0 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $usernameErr = "field is required";
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

  if (empty($_POST["password0"])) {
    $password0Err = "password is required";
  } else {
    //$password = test_input($_POST["password"]);
    $password0 = $_POST["password0"];
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

<body>
<div class="left-side"></div>

<div class="right-side">
<h3>FIND MY READER</h3>
<h1>Register</h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<div class="form-group">
<label>Email:</label>
<br>
<input class="form-control" type="text" name="email" placeholder="Email" value="<?php echo $username;?>">
<span class="error"><?php echo $usernameErr;?></span>

</div>
<div class="form-group">
<label>First Name:</label>
<br>

<input class="form-control" type="text" name="username" placeholder="First Name" value="<?php echo $username;?>">
<span class="error"><?php echo $usernameErr;?></span>

</div>
<div class="form-group">
<label>Last Name:</label>
<br>
<!--
<input class="form-control" name="lastname" type="text" wtx-context="5CBCDC5D-18BE-43BE-8796-4B898D4F715F" wtx-rule-v3="{{myInfo.LastName}}">
-->

<input class="form-control" type="text" name="username" placeholder="Last Name" value="<?php echo $username;?>">
<span class="error"><?php echo $usernameErr;?></span>

</div>
<div class="form-group">
  <label>Password:</label>
  <br>
<input class="form-control" type="password" name="password" placeholder="Password" value="<?php echo $password;?>">
<span class="error"><?php echo $passwordErr;?></span>
</div>
<div class="form-group">
  <label>Confirm Password:</label>
  <br>
<input class="form-control" type="password" name="password0" placeholder="Password" value="<?php echo $password0;?>">
<span class="error"><?php echo $password0Err;?></span>

<div style="position: relative; width: 0px; margin: 0px; padding: 0px; display: block;">


</div>
</div>
<br>
<input class="btn btn-primary" type="submit" name="submit" value="Register">
  <br>
  <p>You already have an account?</p>
  <a href="login.php">Login here!</a>
</form>
</div>

  <?php
  if($password&&$password0){
if($password==$password0){
  error_reporting(E_ALL);
  ini_set('display_errors', 'On');
$success = true;
$password=strtoupper(md5($password));
  $query = "BEGIN accounts.create_account(:a_username, :a_password, :a_succes); END;";


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

  oci_bind_by_name($s,':a_username',$username);
  oci_bind_by_name($s,':a_password',$password);
  oci_bind_by_name($s,':a_succes',$succes,1);

  $r = oci_execute($s);
  if (!$r) {
      $m = oci_error($s);
      trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
  }

  if($succes){
  header('Location: login.php');
  }
  else{
  echo "<span class=error>User already exists.</span>";
    }
}
else{
echo "<span class=error>Incorect data.</span>";
  }
}
  ?>
</body>
</html>
