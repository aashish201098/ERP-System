<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header("Location: index.php");
	}
	if($_SESSION['user'] == 'student'){
		header("Location: studenthomepage.php");
	}
	if($_SESSION['user'] == 'teacher'){
		header("Location: teacherhomepage.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Registration</title>
	<meta charset="UTF-8">	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		include 'db.php';
		$usr = $_SESSION['userid'];
		$sql = "select * from admin where id = '$usr'";
		$result = mysqli_query($conn,$sql);
		while($row = mysqli_fetch_array($result)){
		?>

		<div style="background-color: #f1f1f1;padding: 10px 10px;overflow: hidden;align-content: center;">
		<img class="img-circle col-md-4" src="images/logo.png" style="width: 8%">
		<span class="col-sm-2"></span>
		<a href="#" style="font-size: 25px;font-weight: bold;color: black;float: left;padding: 10px;line-height: 25px;text-align: center;border-radius: 4px;text-decoration: none;">MALAVIYA NATIONAL INSTITUTE OF TECHNOLOGY, JAIPUR<br>
		<div class="text-muted"><small>Enterprise Resource Planning</small></div></a>
		<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" class="img-thumnail" style="width: 80px; height: 80px;float:right;" />';  ?>
		</div>

		<?php
		}
	 ?>
<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="adminregister.php">Admin Panel</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class="active"><a href="adminregister.php">Add Admin</a></li>

		<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Student
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="studentregister.php">Add Student</a></li>
          <li><a href="viewstudentadmin.php">View Student Details</a></li>
          <li><a href="studentprofileadminupdate.php">Update Student Details</a></li>
           </ul>
      </li>

      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Teacher
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="teacherregister.php">Add Teacher</a></li>
			<li><a href="viewteacherdetails.php">View Teacher Details</a></li>
          <li><a href="viewteacher.php">Update Teacher Details</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Course
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="courseregister.php">Add Course</a></li>
          <li><a href="viewcourse.php">Update Course Details</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Department
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="departmentregister.php">Add Department</a></li>
          <li><a href="viewdepartment.php">Update Department Details</a></li>
        </ul>
      </li>

      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Hostel
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="hostelregister.php">Add Hostel</a></li>
          <li><a href="viewhostel.php">Update Hostel Details</a></li>
        </ul>
      </li>
      <li><a href="changepasswordadmin.php">Change Password</a></li>
      <li><a href="adminlogout.php"><strong>Logout</strong></a></li>
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	    	<li><a href="#">Hello, <b><?php echo $_SESSION['username']; ?></b></a></li>
	    	<span></span>
	    </ul>
	  </div>
	</nav>
	<div class="bg-img">
	<h2><center>Admin Registration Form</center></h2>
	<form class="form-horizontal" action="adminregister.php" method="post" enctype="multipart/form-data">
	  <div class="form-group">
	    <label class="control-label col-sm-2" for="name">Name:</label>
	    <div class="col-sm-4">
	      <input type="name" class="form-control" name="name" placeholder="Enter Name" required="required">
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="control-label col-sm-2" for="username">Username:</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="username" placeholder="Enter Username" required="required">
	    </div>
	    <?php 
	    	$nameok = false;
	  		if(isset($_POST['submit'])){
	  			include 'db.php';
	  			$username = $_POST['username'];
				$sql = "select * from admin where login = '$username'";
				$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result) > 0){
					echo '<div class="text-danger">Username exists !!</div>';
					$nameok = false;
				}else{
					$nameok = true;
				}
			}
	  		
	   ?>
	  </div>

	<div class="form-group">
		<label class="control-label col-sm-2">E-Mail:</label>
		<div class="col-sm-4">
			<input type="email" name="email" class="form-control" placeholder="Enter the Email" required="required">
		</div>
	</div>

	<div class="form-group">
	    <label class="control-label col-sm-2" for="image">Select image to upload:</label>
			    <div class="col-sm-4"><input type="file" name="image" id="image" required="required">
			    	<div class="text-warning">File Size should be less than 50KB.</div>
		    	</div>
	    </div>

	  <div class="form-group"> 
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-default" name='submit' id='submit'>Submit</button>
	    </div>
	  </div>
	</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#submit').click(function(){
			var image_name = $('#image').val();
			if(image_name == ''){
				alert("Please select image");
				return false;
			}else{
				var extension = $('#image').val().split('.').pop().toLowerCase();
				if(jQuery.inArray(extension,['png','jpg','jpeg']) == -1){
					alert("Inavlid Image File");
					$('#image').val('');
					return false;
				}
			}
		});
	});
</script>
<?php
	
	if($nameok){
		function randomPassword() {
	    $limit = 16;
	    $alphabet = 'abcdefghijklmnopqrstuvwxyz!@#$%^&*()_+?>;<:"ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < $limit; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }  // For Loop End
	    return implode($pass); //turn the array into a string
		} // Function End

		$pwd = randomPassword();
		$name = $_POST['name'];
		$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
		$email = $_POST['email'];
		$sql = "insert into admin(adminname,email,login,pwd,image) values('$name','$email','$username','$pwd','$file')";
		if(mysqli_query($conn,$sql)){
			echo '<div class="alert alert-success col-sm-offset-2 col-sm-4"><strong>Successfully Registered!</strong>
  					</div>';

  			$to = $email;
		//define the subject of the email
		$subject = 'Login ID and Password'; 
		//define the message to be sent. Each line should be separated with \n
		$result = mysqli_query($conn, "select login,pwd from admin order by id desc limit 1");
		$row = mysqli_fetch_array($result);
		$message = "Admin Login Deatils
		Login ID :- ".$row['login']." Password :- ".$row['pwd']; 
		//define the headers we want passed. Note that they are separated with \r\n
		$headers = "From: webmaster@example.com\r\nReply-To: webmaster@example.com";
		//send the email
		$mail_sent = @mail( $to, $subject, $message, $headers );
		//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
		// echo $mail_sent ? "Mail sent" : "Mail failed";
		}else{
			echo 'Not Registered.'.mysqli_error($conn);
		}
	}
?>
<div style="position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   color: white;
   text-align: center;">
</div>
</div>

</body>
</html>