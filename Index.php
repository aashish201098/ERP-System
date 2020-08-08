<?php
	session_start();
	if(isset($_SESSION['user'])){
		if($_SESSION['user'] == 'student'){
			header("Location: studenthomepage.php");
		}
		if($_SESSION['user'] == 'teacher'){
			header("Location: teacherhomepage.php");
		}
		if($_SESSION['user'] == 'admin'){
			header("Location: adminhomepage.php");
		}
	}
	header("Location: homepage.php");
?>