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
	<title>Submit Assignment</title>
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
	<h2><center>Submit Assignments</center></h2>
	 <div class="container">
	<span class="row"></span>
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<td>Course Name </td>
				<td>Name of Assignment</td>
				<td>Deadline for Submission</td>
				<td>Description</td>
				<td>Submission</td>
			</tr>
		</thead>
	<?php 
		include 'db.php';
		$usr = $_SESSION['userid'];
		$sql = "select assignment.*,status,course.name as course_name FROM assignment inner join course on assignment.courseid = course.courseid inner join assign_status on assignment.id = assign_status.id where course.courseid in (select courseid from registered where stid = '$usr')";
		$result = mysqli_query($conn,$sql);
		// echo mysqli_error($conn);
		while($row = mysqli_fetch_array($result)){ ?>
			<tr>
				<td><?php echo $row['course_name']; ?></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['deadline']; ?></td>
				<td><?php echo $row['description']; ?></td>
				<td>
					<form class="form form-inline" action="submitassignment.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
							<input type="file" name="file" id="file">
							<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
					</div>

					<div class="form-group">
						<button class="btn btn-primary" name="submit" type="submit">Submit</button>
					</div>
					<?php 
						if($row['status'] == 1){
							echo " <div class='text-success'>Already Submitted.</div>";
						}
					 ?>
					</form>
				</td>
			</tr>

	<?php
		}
		if(isset($_POST['submit'])){
				$file=$_FILES['file'];
				$upload_directory='uploads/';
				$ext_str = "gif,jpg,jpeg,mp3,tiff,bmp,doc,docx,ppt,pptx,txt,pdf";
				$allowed_extensions=explode(',',$ext_str);
				$max_file_size = 2097152;//2 mb remember 1024bytes =1kbytes /* check allowed extensions here */
				$ext = substr($file['name'], strrpos($file['name'], '.') + 1); //get file extension from last sub string from last . character
				if (!in_array($ext, $allowed_extensions) ) {
				echo "<div class='text-warning col-sm-offset-2'>only ".$ext_str." files allowed to upload</div>"; // exit the script by warning

				}else if($file['size']>=$max_file_size){

				echo "<div class='text-warning col-sm-offset-2'>only the file less than ".$max_file_size."mb  allowed to upload</div>"; // exit the script by warning

				}else{

					$path= md5(microtime()).'.'.$ext;

					if(move_uploaded_file($file['tmp_name'],$upload_directory.$path)){
						$id = $_POST['id'];
						$time = date("Y-m-d H:i:s");
						$sql = "update assign_status set path = '$path' where id = '$id' and stid = '$usr'";
						$sql1 = "update assign_status set status = 1 where id = '$id' and stid = '$usr'";
						// $sql2 = "update assign_status set time = '$time' where id = '$id' and stid = '$usr'";
						if(mysqli_query($conn,$sql) && mysqli_query($conn,$sql1)){
							echo "<script> alert('Assignment submitted successfully.'); </script>";
						}
					}
			}
		}
	 ?>
	</table>
</div>
</body>
</html>