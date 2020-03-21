<!DOCTYPE HTML>
<html>
<head>
  <title>Find My Reader</title>
<style>
.error {color: #FF0000;}
</style>
<link rel="stylesheet" href="style.css">
</head>
<body style="background-image:url(background.jpeg);//width:99%;height:900px;">

<?php
// define variables and set to empty values
$usernameErr = $passwordErr = $password0Err = "";
$username = $password = $password0 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $usernameErr = "username is required";
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

<form class="box" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<h1>Register to Find My Reader</h1>

  <span class="error"><?php echo $usernameErr;?></span>
  <input type="text" name="username" placeholder="Username" value="<?php echo $username;?>">

  <span class="error"><?php echo $passwordErr;?></span>
  <input type="password" name="password" placeholder="Password" value="<?php echo $password;?>">

  <span class="error"><?php echo $password0Err;?></span>
  <input type="password" name="password0" placeholder="Password" value="<?php echo $password0;?>">

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
<hr>
  <input type="submit" name="submit" value="Register">
  <input type="submit" name="" value="Cancel" formaction="login.php">
</form>

</body>
</html>
