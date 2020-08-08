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
	<title>Give Assignments</title>
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
	<h2><center>Give Assignments</center></h2>
	<span class="row"></span>
	<form method="post" action="aasignassignment.php" enctype="multipart/form-data" class="form-horizontal">
		<div class="form-group">
		  <label class="control-label col-sm-2" for="courseid">Course:</label>
		  <div class="col-sm-4">
			  <select class="form-control" name="courseid" required="required">
			    <?php
			    	include 'db.php';
			    	$usr = $_SESSION['userid'];
			    	$result = mysqli_query($conn,"select * from course natural join teaches where teacherid = '$usr'");
			    	while($row = mysqli_fetch_array($result)){
			    ?>

			    <option value="<?php echo $row['courseid'] ?>"><?php echo $row['name'];?> </option>

			    <?php
			    }
			    ?>
			  </select>
			</div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-2">Name of Assignment:</label>
			<div class="col-sm-4">
				<input type="name" name="name" class="form-control" placeholder="Enter the name of assignment" required="required">
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2">Deadline for Submission:</label>
			<div class="col-sm-4">
				<input type="date" name="deadline" class="form-control" required="required">
			</div>
		</div>		
		
		<div class="form-group">
			<label class="control-label col-sm-2">Description:</label>
			<div class="col-sm-4">
				<textarea rows="2" cols="59" name="description" placeholder="Enter the description" class="form-control"></textarea>
			</div>
		</div>


		<div class="form-group">
			<label class="control-label col-sm-2">Upload file:</label>
			<div class="col-sm-4">
				<input type="file" name="file" id="file">
			</div>
		</div>
			
		<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default" name="submit">Assign</button>
			</div>
		</div>			

	</form>
</body>
</html>


<?php

if(isset($_POST['submit'])){
include 'db.php';
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
		$courseid = $_POST['courseid'];
		$name = $_POST['name'];
		$deadline = $_POST['deadline'];
		$description = $_POST['description'];
		$sql = "insert into assignment(courseid,name,description,deadline,path) values('$courseid','$name','$description','$deadline','$path')";
		$sql1 = "insert into assign_status(stid,id) select stid,id from registered natural join assignment where registered.courseid = '$courseid' and id = (select id from assignment order by id desc limit 1)";
		if(mysqli_query($conn,$sql)){
			if(mysqli_query($conn,$sql1)){
				echo "<script> alert('Assignment successfully assigned'); </script>";
			}
		}
	}

	else{
		echo "<script>alert('The file cant moved to target directory.');</script>";
	}
}
}
?>