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
	<title>Department Registration</title>
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
	      <li class=""><a href="adminregister.php">Add Admin</a></li>

		<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Student
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="studentregister.php">Add Student</a></li>
          <li><a href="viewstudentadmin.php">View Student Details</a></li>
          <li><a href="studentprofileadminupdate.php">UpdateUpdatedent Details</a></li>        </ul>
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

      <li class="dropdown active">
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

	<h2><center>Department Registration Form</center></h2>
	<form class="form-horizontal" action="departmentregister.php" method="post">
	  <div class="form-group">
	    <label class="control-label col-sm-2" for="name">Name:</label>
	    <div class="col-sm-4">
	      <input type="name" class="form-control" name="name" placeholder="Enter Department Name" required="required">
	    </div>
	  </div>

	   <div class="form-group">
	    <label class="control-label col-sm-2" for="hod">Head of Department:</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="hod" placeholder="Enter Head of Department Name" required="required">
	    </div>
	  </div>
  
	  <div class="form-group"> 
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-default" name='submit'>Submit</button>
	    </div>
	  </div>
	</form>

<?php
	include 'db.php';
	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$hod = $_POST['hod'];
		$sql = "insert into dept(deptName,hod) values('$name','$hod')";
		if(mysqli_query($conn,$sql)){
			echo '<script> alert("Department Registration Successful."); </script>';
		}else{
			echo 'Not Registered.'.mysqli_error($conn);
		}
	}
?>

</body>
</html>