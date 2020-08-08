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
	<title>Teacher Profile</title>
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

	<h2><center>Profile</center></h2>
	<?php 
		include 'db.php';
		$usr = $_SESSION['userid'];
		$sql = "select * from teacher where teacherid = '$usr'";
		$result = mysqli_query($conn,$sql);
		while($row = mysqli_fetch_array($result)){
	 ?>
	<form class="form-horizontal" action="teacherprofile.php" method="post">
	  <div class="form-group">
	    <label class="control-label col-sm-2" for="name">Name:</label>
	    <div class="col-sm-4">
	      <input type="name" class="form-control" name="name" value="<?php echo $row['name']; ?>" disabled>
	    </div>
	  </div>

	  <div class="form-group">
	  	<label class="control-label col-sm-2" for="gender">Gender: </label>
	  	<?php if($row['gender'] == 'M'){ ?>
	 	<div class="col-sm-4">
	      <input type="text" class="form-control" name="gender" value="<?php echo 'M'; ?>" disabled>
	    </div>
<?php }else{ ?>
		<div class="col-sm-4">
	      <input type="text" class="form-control" name="gender" value="<?php echo 'F'; ?>" disabled>
	    </div>
<?php } ?>
</div>


	  <div class="form-group">
	    <label class="control-label col-sm-2" for="email">Email:</label>
	    <div class="col-sm-4">
	      <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required="required">
	    </div>
	  </div>


	  <div class="form-group">
	    <label class="control-label col-sm-2" for="phone">Phone:</label>
	    <div class="col-sm-4">
	      <input type="Number" class="form-control" name="phone" value="<?php echo $row['phone']; ?>" required="required">
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="control-label col-sm-2" for="qualifiaction">Qualification:</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="qualification" value="<?php echo $row['qualification']; ?>" required="required">
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="control-label col-sm-2" for="salary">Salary:</label>
	    <div class="col-sm-4">
	      <input type="Number" class="form-control" name="salary" value="<?php echo $row['salary'];?>" required="required" disabled>
	    </div>
	  </div>

	  <div class="form-group">
		  <label class="control-label col-sm-2" for="deptid">Department:</label>
		  <div class="col-sm-4">
			  <input type="text" class="form-control" name="deptid" value="<?php echo $row['deptid'];?>" required="required" disabled>
			</div>
		</div>
	<?php } ?>
	  
	  <div class="form-group"> 
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-default" name='submit'>Update</button>
	    </div>
	  </div>

	</form>

<?php 
	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$qualification = $_POST['qualification'];
		$sql = "update teacher set email = '$email' where teacherid = '$usr';";
		$sql .= "update teacher set phone = '$phone' where teacherid = '$usr';";
		$sql .= "update teacher set qualification = '$qualification' where teacherid = '$usr'";
		if (mysqli_multi_query($conn,$sql)) {
			echo "<div class='alert alert-success'> Successfully Updated!! </div>";
		}else{
			echo "Not Updted".mysqli_error();
		}
	}
 ?>

</body>
</html>