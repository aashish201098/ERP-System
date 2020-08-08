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
	<title>Evaluate Assignments</title>
	<meta charset="utf-8">
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
	<h2><center>Evaluate Assignments</center></h2>
	<div class="container">
	<span class="row"></span>

	<?php 
		// include 'db.php';
		// if(isset($_GET['file'])){
		// 	$filename = $_GET['file'];
		// 	$err = "Sorry, the file you are requesting is unavailable.";
		// 	$path = 'uploads/'.$filename;
		// 	if(file_exists($path) && is_readable($path)){
		// 		header('Content-Description: File Transfer');
		// 		header('Content-Type: application/pdf;');
		// 		header('Content-Disposition: attachment; filename='.basename($path));
		// 		header('Content-Transfer-Encoding: binary');
		// 		header('Expires: 0');
		// 		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		// 		header('Pragma: public');
		// 		header('Content-Length: ' . filesize($path));
		// 		ob_clean();
		// 		flush();
		// 		readfile($path);
		// 		exit;
		// 	}else{
		// 		echo $err;
		// 	}
		// }
	 ?>

	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<td>Course Name </td>
				<td>Name of Assignment</td>
				<td>Deadline for Submission</td>
				<!-- <td>Description</td> -->
				<td>Student ID</td>
				<td>Student Name</td>
				<td>Time of Submission</td>
				<td>File</td>
				<td>Grade</td>
			</tr>
		</thead>
		
	<?php 
		include 'db.php';
		$usr = $_SESSION['userid'];
		$sql = "select student.stid,stname,course.name as course_name ,assignment.id,assignment.name ,assignment.deadline ,assignment.description, assign_status.path,assign_status.time,assign_status.grade from assignment inner join assign_status on assignment.id = assign_status.id inner join student on assign_status.stid = student.stid  inner join course on course.courseid = assignment.courseid where status = 1 and grade = '' and course.courseid in (select courseid from teaches where teacherid = '$usr')";
		$result = mysqli_query($conn,$sql);
		// echo mysqli_error($conn);
		while($row = mysqli_fetch_array($result)){ ?>
			
			<tr>
				<td><?php echo $row['course_name']; ?></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['deadline']; ?></td>
				<!-- <td><?php //echo $row['description']; ?></td> -->
				<td><?php echo $row['stid']; ?></td>
				<td><?php echo $row['stname']; ?></td>
				<td><?php echo $row['time']; ?></td>
				<!-- <td><a href="evaluateassignment.php?file=<?php //echo $row['path']; ?>" style="none">Download</a></td> -->
				<td><a href="uploads/<?php echo $row['path']; ?>" download>Download</a></td>
				<td>
					<form class="form-inline" action="evaluateassignment.php" method="post">
					<div class="form-group">
						  <select class="form-control" name="grade" value="<?php if(isset($row['grade'])) echo $row['grade']; ?>">
						    <option value="A">A</option>
						    <option value="B">B</option>
						    <option value="C">C</option>
						    <option value="D">D</option>
						    <option value="E">E</option>
						    <option value="F">F</option>
						  </select>
						  <input type="hidden" name="stid" value="<?php echo $row['stid']; ?>">
					<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
					</div>
					<div class="form-group">
						<button class="btn btn-primary" name="submit" type="submit">Submit</button>
					</div>
				</form>
				</td>
			</tr>

	<?php	}
		if(isset($_POST['submit'])){
			$grade = $_POST['grade'];
			$stid = $_POST['stid'];
			$id = $_POST['id'];
			$sql = "update assign_status set grade = '$grade' where stid = '$stid' and id = '$id'";
			if(mysqli_query($conn,$sql)){
				echo "<script>alert('Assignment graded successfully.');</script>";
			}
		}
	 ?>
	</table>
</div>
</body>
</html>


