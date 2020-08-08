<?php
	session_start();
	if(!isset($_SESSION['user'])){
		header("Location: studentlogin.php");
	}
	if($_SESSION['user'] == 'teacher'){
		header("Location: teacherhomepage.php");
	}
	if($_SESSION['user'] == 'admin'){
		header("Location: adminhomepage.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Assignment</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		include 'db.php';
		$usr = $_SESSION['userid'];
		$sql = "select * from student where stid = '$usr'";
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
	      <a class="navbar-brand" href="studentprofile.php">Student Panel</a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li class=""><a href="stviewregcourse.php">Registered Courses</a></li>
	      <li class=""><a href="stregistercourse.php">Register for Courses</a></li>
		<li class="dropdown active">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Assignment
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="viewassignment.php">View Assignment</a></li>
          <li><a href="submitassignment.php">Submit Assignment</a></li>
        </ul>
      </li>
      		<li><a href="changepasswordstudent.php">Change Password</a></li>

      <li><a href="adminlogout.php"><strong>Logout</strong></a></li>
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	    	<li class="active"><a href="studentprofile.php">Hello, <b><?php echo $_SESSION['username']; ?></b></a></li>
	    	<span></span>
	    </ul>
	  </div>
	</nav>
	<h2><center>View Assignments</center></h2>
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
		// 		header('Content-Type: application/octet-stream; charset=utf-8');
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

		// 	$name= $_GET['file'];

  //   header('Content-Description: File Transfer');
  //   header('Content-Type: application/force-download');
  //   header("Content-Disposition: attachment; filename=\"" . basename($name) . "\";");
  //   header('Content-Transfer-Encoding: binary');
  //   header('Expires: 0');
  //   header('Cache-Control: must-revalidate');
  //   header('Pragma: public');
  //   header('Content-Length: ' . filesize($name));
  //   ob_clean();
  //   flush();
  //   readfile("uploads/".$name); //showing the path to the server where the file is to be download
  //   exit;
		// }
	 ?>
	
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<td>Course Name </td>
				<td>Name of Assignment</td>
				<td>Deadline for Submission</td>
				<td>Description</td>
				<td>File</td>
			</tr>
		</thead>
	<?php 
		include 'db.php';
		$usr = $_SESSION['userid'];
		$sql = "select assignment.*,course.name as course_name FROM assignment inner join course on assignment.courseid = course.courseid where course.courseid in (select courseid from registered where stid = '$usr')";
		$result = mysqli_query($conn,$sql);
		// echo mysqli_error($conn);
		while($row = mysqli_fetch_array($result)){ ?>
			
			<tr>
				<td><?php echo $row['course_name']; ?></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['deadline']; ?></td>
				<td><?php echo $row['description']; ?></td>
				<!-- <td><a href="viewassignment.php?file=<?php //echo $row['path']; ?>" download>Download</a></td> -->
				<td><a href="uploads/<?php echo $row['path']; ?>" download>Download</a></td>
			</tr>

	<?php	}
	 ?>
	</table>
</div>
</body>
</html>