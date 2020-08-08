<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header("Location: studentlogin.php");
	}
	if($_SESSION['user'] == 'student'){
		header("Location: studenthomepage.php");
	}
	if($_SESSION['user'] == 'admin'){
		header("Location: adminhomepage.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register for Courses</title>
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
		$sql = "select * from teacher where teacherid = '$usr'";
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
	      <a class="navbar-brand" href="teacherprofile.php">Teacher Panel</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class=""><a href="teacherviewregcourse.php">Registered Courses</a></li>
	      <li class=""><a href="teacherregcourse.php">Register for Courses</a></li>
		<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Assignment
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="aasignassignment.php">Assign Assignment</a></li>
          <li><a href="evaluateassignment.php">Evaluate Assignment</a></li>
        </ul>
      </li>
      <li><a href="viewstudentteacher.php">View Student Details</a></li>
      <li><a href="changepasswordteacher.php">Change Password</a></li>
      <li><a href="adminlogout.php"><strong>Logout</strong></a></li>
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	    	<li class="active"><a href="teacherprofile.php">Hello, <b><?php echo $_SESSION['username']; ?></b></a></li>
	    	<span></span>
	    </ul>
	  </div>
	</nav>

	<h2><center>Register for Courses</center></h2>
	<div class="container">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<td>Select</td>
					<td>Course Name</td>
					<td>Number of Credits</td>
				</tr>
			</thead>
			<form class="form-horizontal" action="teacherregcourse.php" method="post">
	<?php 
		include 'db.php';
		$sql = "select * from teacher where teacherid = '$usr'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($result);
		$deptid = $row['deptid'];
		$sql = "select * from course where deptid = '$deptid'";
		$result = mysqli_query($conn,$sql);
		while($row = mysqli_fetch_array($result)){ ?>
			<tr>
				<td><input type="checkbox" name = "courseid[]" value="<?php echo $row['courseid']; ?>"></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['noc']; ?></td>
			</tr>
	<?php	}
	 ?>
	 </table>
	  <div class="form-group"> 
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-default" name="submit">Register</button>
	    </div>
	  </div>
	</form>
	 	
	</div>
<?php 
	if(isset($_POST['submit'])){
		$success = true;
		$courseid = $_POST['courseid'];
		foreach ($courseid as $var) {
			$sql = "select * from teaches where teacherid = '$usr' and courseid = '$var'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result) > 0){

			}else{
				$sql = "insert into teaches(teacherid,courseid) values('$usr','$var')";
				if(!mysqli_query($conn,$sql)){
					$success = false;
				}
			}
		}
		echo "<br>";
		if(!$success){
			echo "<div class='alert alert-warning'>Not Registerd!!".mysqli_error($conn)."</div>";
		}else{
			echo "<div class='alert alert-success'>Registered Successfully!!</div>";
		}
	}
 ?>

</body>
</html>