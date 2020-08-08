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
<head><title>Update Teacher Details</title>
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
          <li><a href="studentprofileadminupdate.php">Update Student Details</a></li>        </ul>
      </li>Update

      <li class="dropdown active">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Teacher
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="teacherregister.php">Add Teacher</a></li>
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

	<h2><center>View and Update Teacher Details</center></h2>
	<form class="form-horizontal" action="viewteacher.php" method="post">
		<div class="form-group">
			<label class="control-label col-sm-2" for='teacherid'>Select Teacher: </label>
			<div class="col-sm-2">
			<select class="form-control" name="teacherid" required="required">
			    <?php
			    	include 'db.php';
			    	$result = mysqli_query($conn,"select * from teacher");
			    	while($row = mysqli_fetch_array($result)){
			    ?>

			    <option value="<?php echo $row['teacherid'] ?>"><?php echo $row['teacherid'].' '.$row['name'];?> </option>

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
		if(isset($_POST['view'])){
			include 'db.php';
			$usr = $_POST['teacherid'];
			$sql = "select * from teacher where teacherid = '$usr'";
			$result = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_array($result)){
	 ?>
	<form class="form-horizontal" action="viewteacher.php" method="post">

	<div class="form-group">
			<label class="control-label col-sm-2">Image:</label>
			<div class="col-sm-4">
				<?php echo '  
                          <tr>  
                               <td>  
                                    <img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'"  class="img-thumnail" style="width:25%"/>  
                               </td>  
                          </tr>  
                     ';   ?>
			</div>
		</div>
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for="id">Teacher ID:</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name='teacherid' value="<?php echo $row['teacherid']; ?>" readonly>
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="control-label col-sm-2" for="name">Name:</label>
	    <div class="col-sm-4">
	      <input type="name" class="form-control" name="name" value="<?php echo $row['name']; ?>" required="required">
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
	    <label class="control-label col-sm-2" for="email">Email:</label>
	    <div class="col-sm-4">
	      <input type="email" class="form-control" name="email"  value="<?php echo $row['email']; ?>" required="required">
	    </div>
	  </div>


	  <div class="form-group">
	    <label class="control-label col-sm-2" for="phone">Phone:</label>
	    <div class="col-sm-4">
	      <input type="Number" class="form-control" name="phone"  value="<?php echo $row['phone']; ?>" required="required">
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="control-label col-sm-2" for="qualifiaction">Qualification:</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="qualification"  value="<?php echo $row['qualification']; ?>" required="required">
	    </div>
	  </div>

	  <div class="form-group">
	    <label class="control-label col-sm-2" for="salary">Salary:</label>
	    <div class="col-sm-4">
	      <input type="Number" class="form-control" name="salary" value="<?php echo $row['salary']; ?>" required="required">
	    </div>
	  </div>

	 <div class="form-group">
	  <label class="control-label col-sm-2" for="deptid">Department:</label>
	  <div class="col-sm-4">
		<input type="text" class="form-control" name="deptid" disabled="disabled" value="<?php echo $row['deptid']; ?>">

		</div>
	</div>
	<?php } ?>
	  
	  <div class="form-group"> 
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-default" name='submit'>Update</button>
	    </div>
	  </div>
	<?php } ?>
	</form>

<?php
	include 'db.php';
	if(isset($_POST['submit'])){
		$usr = $_POST['teacherid'];
		$name = $_POST['name'];
		$gender = $_POST['gender'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$qualification = $_POST['qualification'];
		$salary = $_POST['salary'];
		$sql = "update teacher set name = '$name' where teacherid = '$usr';";
		$sql .= "update teacher set gender = '$gender' where teacherid = '$usr';";
		$sql .= "update teacher set email = '$email' where teacherid = '$usr';";
		$sql .= "update teacher set qualification = '$qualification' where teacherid = '$usr';";
		$sql .= "update teacher set salary = '$salary' where teacherid = '$usr';";
		$sql .= "update teacher set phone = '$phone' where teacherid = '$usr'";
		
		if (mysqli_multi_query($conn,$sql)) {
			echo "<div class='alert alert-success'> Successfully Updated!! </div>";
		}else{
			echo "Not Updated".mysqli_error();
		}
	}
?>

</body>
</html>