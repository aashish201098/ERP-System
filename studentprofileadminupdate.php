<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header("Location: studentlogin.php");
	}
	if($_SESSION['user'] == 'teacher'){
		header("Location: teacherhomepage.php");
	}
	if($_SESSION['user'] == 'student'){
		header("Location: studenthomepage.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Profile</title>
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

		<li class="dropdown active">
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
	    </ul>
	  </div>
	</nav>

	<h2><center>View and Update Student Details</center></h2>
	<form class="form-horizontal" action="studentprofileadminupdate.php" method="post">
		<div class="form-group">
			<label class="control-label col-sm-2" for='stid'>Select Student: </label>
			<div class="col-sm-2">
			<select class="form-control" name="stid" required="required">
			    <?php
			    	include 'db.php';
			    	$result = mysqli_query($conn,"select * from student");
			    	while($row = mysqli_fetch_array($result)){
			    ?>

			    <option value="<?php echo $row['stid'] ?>"><?php echo $row['stid'].' '.$row['stname'];?> </option>

			    <?php
			    }
			    ?>
			  </select>
			</div>
		</div>
		
		<div class="form-group"> 
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-default" name='view'>View</button>
	    </div>
	  </div>

	</form>
	<?php 
		if(isset($_POST['view'])) {
			include 'db.php';
			$usr = $_POST['stid'];
			$sql = "select * from student where stid = '$usr'";
			$result = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_array($result)){
	 ?>
	<form class="form-horizontal" action="studentprofileadminupdate.php" method="post">

		<div class="form-group">
			<label class="control-label col-sm-2">Image:</label>
			<div class="col-sm-4">
				<?php echo '  
                          <tr>  
                               <td>  
                                    <img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'"  class="img-thumnail" style="width: 100px; height: 100px;"/>  
                               </td>  
                          </tr>  
                     ';   ?>
			</div>
		</div>

	<div class="form-group">
	    <label class="control-label col-sm-2" for="id">Student ID:</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name='stid' value="<?php echo $row['stid']; ?>" readonly>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="control-label col-sm-2" for="name">Name:</label>
	    <div class="col-sm-4">
	      <input type="name" class="form-control" name="name" value="<?php echo $row['stname']; ?>" required>
	    </div>
	  </div>
	
	<div class="form-group">
		  <label class="control-label col-sm-2" for="year">Year:</label>
		  <div class="col-sm-4">
			  <select class="form-control" name="year" required="required">
			  	<?php 
			  		if($row['year'] == 1){ ?>
						<option value="1" selected>I</option>
			    <option value="2">II</option>
			    <option value="3">III</option>
			    <option value="4">IV</option>
			  	<?php	}else if($row['year'] == 2){ ?>
						<option value="1">I</option>
			    <option value="2" selected="">II</option>
			    <option value="3">III</option>
			    <option value="4">IV</option>
			  	<?php	}else if($row['year'] == 3){ ?>
						<option value="1">I</option>
			    <option value="2">II</option>
			    <option value="3" selected="">III</option>
			    <option value="4">IV</option>
			  	<?php	}else{ ?>
						<option value="1">I</option>
			    <option value="2">II</option>
			    <option value="3">III</option>
			    <option value="4" selected="">IV</option>
			  	<?php	}
			  	 ?>
			  </select>
			</div>
		</div>

	  <div class="form-group">
	  	<label class="control-label col-sm-2" for="gender">Gender: </label>
	  	<?php if($row['gender'] == 'M'){ ?>
	 	<div class="col-sm-4">
	      <input type="text" class="form-control" name="gender" value="<?php echo 'M'; ?>" required>
	    </div>
<?php }else{ ?>
		<div class="col-sm-4">
	      <input type="text" class="form-control" name="gender" value="<?php echo 'F'; ?>" required>
	    </div>
<?php } ?>
</div>

	<div class="form-group">
	    <label class="control-label col-sm-2">Date Of Birth:</label>
	    <div class="col-sm-4">
	      <input type="date" class="form-control" name="dob" value="<?php echo $row['dob']; ?>" required>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="control-label col-sm-2" for="address">Address:</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="address" value="<?php echo $row['address']; ?>" required>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="control-label col-sm-2" for="phone">Phone:</label>
	    <div class="col-sm-4">
	      <input type="Number" class="form-control" name="phone" value="<?php echo $row['phone'] ?>" required>
	    </div>
	  </div>

	   <div class="form-group">
	    <label class="control-label col-sm-2" for="email">Email:</label>
	    <div class="col-sm-4">
	      <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="control-label col-sm-2" for="city">City:</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="city" value="<?php echo $row['city']; ?>" required>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="control-label col-sm-2" for="state">State:</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="state" value="<?php echo $row['state']; ?>" required>
	    </div>
	  </div>

		<div class="form-group">
	    <label class="control-label col-sm-2" for="name">Father's Name:</label>
	    <div class="col-sm-4">
	      <input type="name" class="form-control" name="fname" value="<?php echo $row['fname']; ?>" required>
	    </div>
	  </div>

	   <div class="form-group">
		  <label class="control-label col-sm-2" for="hostelid">Hostel:</label>
		  <div class="col-sm-4">
			   <input type="text" class="form-control" name="hostelid" value="<?php echo $row['hostelid']; ?>" readonly>
			</div>
		</div>

		<div class="form-group">
		  <label class="control-label col-sm-2" for="deptid">Department:</label>
		  <div class="col-sm-4">
			<input type="text" class="form-control" name="deptid" value="<?php echo $row['deptid']; ?>" readonly>

			</div>
		</div>
	<?php } ?>

	  <div class="form-group"> 
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-default" name='submit'>Update</button>
	    </div>
	  </div>
		  
	</form>
<?php } ?>
<?php 
	if(isset($_POST['submit'])){
		$usr = $_POST['stid'];
		$name = $_POST['name'];
		$year = $_POST['year'];
		$gender = $_POST['gender'];
		$dob = $_POST['dob'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$fname = $_POST['fname'];
		$sql = "update student set stname = '$name' where stid = '$usr';";
		$sql .= "update student set year = '$year' where stid = '$usr';";
		$sql .= "update student set gender = '$gender' where stid = '$usr';";
		$sql .= "update student set dob = '$dob' where stid = '$usr';";
		$sql .= "update student set address = '$address' where stid = '$usr';";
		$sql .= "update student set phone = '$phone' where stid = '$usr';";
		$sql .= "update student set email = '$email' where stid = '$usr';";
		$sql .= "update student set city = '$city' where stid = '$usr';";
		$sql .= "update student set state = '$state' where stid = '$usr';";
		$sql .= "update student set fname = '$fname' where stid = '$usr'";
		if (mysqli_multi_query($conn,$sql)) {
			echo "<div class='alert alert-success'> Successfully Updated!! </div>";
		}else{
			echo "Not Updated".mysqli_error($conn);
		}
	}
 ?>

</body>
</html>