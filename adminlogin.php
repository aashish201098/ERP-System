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
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Login</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<?php include 'header.php'; ?>
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="homepage.php">ERP System</a>
		    </div>
		    <ul class="nav navbar-nav">
		      <li class = "active"><a href="adminlogin.php">Admin Login</a></li>
		      <li><a href="studentlogin.php">Student Login</a></li>
		      <li><a href="teacherlogin.php">Teacher Login</a></li>
		    </ul>
		  </div>
		</nav>
		<form class="form form-horizontal" action="adminlogin.php" method="post">
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="username">Username:</label>
		    <div class="col-sm-4">
		      <input type="username" class="form-control" name="username" placeholder="Enter username" required="required">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Password:</label>
		    <div class="col-sm-4"> 
		      <input type="password" class="form-control" name="pwd" placeholder="Enter password">
		    </div>
		  </div>
		  <div class="form-group"> 
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default" name="submit">Submit</button>
        	<button type="submit" class="btn btn-primary" name="fpwd">Forgot Password?</button>

			    </div>
		  </div>
		</form>
		<?php
			include 'db.php';
			if(isset($_POST['submit'])){
				$usr = mysqli_real_escape_string($conn,$_POST['username']);
				$pwd = mysqli_real_escape_string($conn,$_POST['pwd']);
				$sql = mysqli_query($conn,"select * from admin where login = '$usr' and pwd = '$pwd'");
				if(mysqli_num_rows($sql) == 1){
					$row = mysqli_fetch_array($sql);
					session_start();
					$_SESSION['user'] = 'admin';
					$_SESSION['userid'] = $row['id'];
					$_SESSION['username'] = $row['adminName'];
					header("Location: adminhomepage.php");
					exit;
				}else{
					echo "<script>alert('Invalid Username or Password');</script>";
				}
			}
			if(isset($_POST['fpwd'])){
					$usr = mysqli_real_escape_string($conn,$_POST['username']);
					$sql = "select * from admin where login = '$usr'";
					$result = mysqli_query($conn,$sql);
					if(mysqli_num_rows($result) > 0){
						$row = mysqli_fetch_array($result);
						$pwd = $row['pwd'];

						//define the receiver of the email
						$to = $row['email'];
						//define the subject of the email
						$subject = 'Password Details'; 
						//define the message to be sent. Each line should be separated with \n
						$message = "Your Password is ".$row['pwd']; 
						//define the headers we want passed. Note that they are separated with \r\n
						$headers = "From: webmaster@example.com\r\nReply-To: webmaster@example.com";
						//send the email
						$mail_sent = @mail( $to, $subject, $message, $headers );
						//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
						echo $mail_sent ? "<script>alert('Your Password Details has been sent to your registered mail ID');</script>" : "Mail failed";

					}else{
						echo "<script>alert('Invalid Student ID');</script>";
					}
			}
			include 'footer.php';
		?>
	</body>
</html>