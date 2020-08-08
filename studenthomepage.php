<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header("Location: index.php");
	}
	if($_SESSION['user'] == 'admin'){
		header("Location: adminhomepage.php");
	}
	if($_SESSION['user'] == 'teacher'){
		header("Location: teacherhomepage.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Home Page</title>
	<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php
		header("Location: studentprofile.php");
	?>
</body>
</html>