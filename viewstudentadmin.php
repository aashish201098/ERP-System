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
	<title>View Student</title>
	<meta charset="UTF-8">
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
	  </div>
	</nav>

	<h2><center>View Student Details</center></h2>
	<span class="row"></span>
	<div class="container">
		<form class="form form-inline" action="viewstudentadmin.php" method="post">
		
		<div class="form-group">
		  <label for="year">Year:</label>
			  <select class="form-control" name="year">
			  	<option value="NULL">-- Please select an year --</option>
			    <option value="1">I</option>
			    <option value="2">II</option>
			    <option value="3">III</option>
			    <option value="4">IV</option>
			  </select>
		</div>
		<div class="form-group col-sm-offset-2">
		  <label for="deptid">Department:</label>		 
			  <select class="form-control" name="deptid">
			  	<option value="NULL">-- Please select a department --</option>
			    <?php
			    	include 'db.php';
			    	$result = mysqli_query($conn,"select * from dept");
			    	while($row = mysqli_fetch_array($result)){
			    ?>

			    <option value="<?php echo $row['deptid'] ?>"><?php echo $row['deptName']?> </option>

			    <?php
			    }
			    ?>
			  </select>
		</div>
		<div class="form-group col-sm-offset-2"> 
	      <button type="submit" class="btn btn-default" name='submit' id='submit'>View</button>
	  </div>
		</form>
		<span class="row"></span>
		<table class="table table-hover table-bordered" style="text-align: center;">
			<thead style="font-weight: bold;">
				<tr>
					<td>Student ID</td>
					<td>Student Name</td>
					<td>Gender</td>
					<td>Year</td>
					<td>Date of Birth</td>
					<td>Address</td>
					<td>Phone</td>
					<td>E-Mail</td>
					<td>City</td>
					<td>State</td>
					<td>Father's Name</td>
					<td>Hostel ID</td>
					<td>Dept ID</td>
					<td>Image</td>
				</tr>
			</thead>
		<?php 
			if(isset($_POST['submit'])){
				include 'db.php';
				if(($_POST['year']!= 'NULL') && ($_POST['deptid']!='NULL')){
					$year = $_POST['year'];
					$deptid = $_POST['deptid'];
					$sql = "select * from student where year = '$year' and deptid = '$deptid'";
					$result = mysqli_query($conn,$sql);
					while($row = mysqli_fetch_array($result)){ ?>
						
						<tr>
							<td><?php echo $row['stid']; ?></td>
							<td><?php echo $row['stname']; ?></td>
							<td><?php echo $row['gender']; ?></td>
							<td><?php echo $row['year']; ?></td>
							<td><?php echo $row['dob']; ?></td>
							<td><?php echo $row['address']; ?></td>
							<td><?php echo $row['phone']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['city']; ?></td>
							<td><?php echo $row['state']; ?></td>
							<td><?php echo $row['fname']; ?></td>
							<td><?php echo $row['hostelid']; ?></td>
							<td><?php echo $row['deptid']; ?></td>
							<td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" class="img-thumnail" style="width: 80px; height: 80px;float:right;" />';  ?></td>
						</tr>

			<?php		}
				}else if(($_POST['year']!='NULL')){
					$year = $_POST['year'];
					$sql = "select * from student where year = '$year'";
					$result = mysqli_query($conn,$sql);
					while($row = mysqli_fetch_array($result)){ ?>
						<tr>
							<td><?php echo $row['stid']; ?></td>
							<td><?php echo $row['stname']; ?></td>
							<td><?php echo $row['gender']; ?></td>
							<td><?php echo $row['year']; ?></td>
							<td><?php echo $row['dob']; ?></td>
							<td><?php echo $row['address']; ?></td>
							<td><?php echo $row['phone']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['city']; ?></td>
							<td><?php echo $row['state']; ?></td>
							<td><?php echo $row['fname']; ?></td>
							<td><?php echo $row['hostelid']; ?></td>
							<td><?php echo $row['deptid']; ?></td>
							<td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" class="img-thumnail" style="width: 80px; height: 80px;float:right;" />';  ?></td>
						</tr>
			<?php		}
				}else if(($_POST['deptid'])!='NULL'){
					$deptid = $_POST['deptid'];
					$sql = "select * from student where deptid = '$deptid'";
					$result = mysqli_query($conn,$sql);
					while($row = mysqli_fetch_array($result)){ ?>
						<tr>
							<td><?php echo $row['stid']; ?></td>
							<td><?php echo $row['stname']; ?></td>
							<td><?php echo $row['gender']; ?></td>
							<td><?php echo $row['year']; ?></td>
							<td><?php echo $row['dob']; ?></td>
							<td><?php echo $row['address']; ?></td>
							<td><?php echo $row['phone']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['city']; ?></td>
							<td><?php echo $row['state']; ?></td>
							<td><?php echo $row['fname']; ?></td>
							<td><?php echo $row['hostelid']; ?></td>
							<td><?php echo $row['deptid']; ?></td>
							<td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" class="img-thumnail" style="width: 80px; height: 80px;float:right;" />';  ?></td>
						</tr>
			<?php		}
				}else{
					$sql = "select * from student";
					$result = mysqli_query($conn,$sql);
					while($row = mysqli_fetch_array($result)){ ?>
						<tr>
							<td><?php echo $row['stid']; ?></td>
							<td><?php echo $row['stname']; ?></td>
							<td><?php echo $row['gender']; ?></td>
							<td><?php echo $row['year']; ?></td>
							<td><?php echo $row['dob']; ?></td>
							<td><?php echo $row['address']; ?></td>
							<td><?php echo $row['phone']; ?></td>
							<td><?php echo $row['email']; ?></td>
							<td><?php echo $row['city']; ?></td>
							<td><?php echo $row['state']; ?></td>
							<td><?php echo $row['fname']; ?></td>
							<td><?php echo $row['hostelid']; ?></td>
							<td><?php echo $row['deptid']; ?></td>
							<td><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" class="img-thumnail" style="width: 80px; height: 80px;float:right;" />';  ?></td>
						</tr>
			<?php		}
				}
			}
		 ?>
		</table>
	</div>
</body>
</html>