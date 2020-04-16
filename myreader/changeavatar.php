<?php
include("session.php");
?>

<!DOCTYPE html>
<html>
    <head>
    <title>My reader</title>
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&amp;display=swap&quot; rel=&quot;stylesheet">
</head>
	<body>
		<?php include('menu.php'); ?>
		<div class="setarimenu">
			<center>
			<h3>Schimba Avatar</h3><br>
			<form method="post" enctype="multipart/form-data">
                <input type="file" name="avatar"><br><br>
                <input type="checkbox" name="rmphoto" value="1">Remove Photo Profile
                <br><br>
            <input type="submit" value="Submit">
            </form>
			</center>
		</div>
	</body>
</html>

<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{	
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
				echo "<script>location.href = 'changeavatar.php'</script>";
			}
		}
	}
?>