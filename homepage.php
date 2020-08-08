<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<?php include 'header.php'; ?>

	<nav class="navbar navbar-inverse" style="padding-bottom: 0;">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" style="color: white;" href="homepage.php">ERP System</a>
		    </div>
		    <ul class="nav navbar-nav">
		      <li><a href="adminlogin.php">Admin Login</a></li>
		      <li><a href="studentlogin.php">Student Login</a></li>
		      <li><a href="teacherlogin.php">Teacher Login</a></li>
		    </ul>
		  </div>
		</nav>
	 <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {

      width: 85%;
      margin: auto;
      border-radius: 8px;
      height: 600px;

  }
  </style>
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="images/mnit6.jpg" alt="MNIT">
      <div class="carousel-caption">
        <h3>MNIT</h3>
        <p>Prabha Bhawan</p>
      </div>
    </div>

    <div class="item">
      <img src="images/mnit3.jpeg" alt="MNIT">
      <div class="carousel-caption">
        <h3>MNIT</h3>
        <p>VLTC</p>
      </div>
    </div>

    <div class="item">
      <img src="images/mnit5.jpg" alt="MNIT">
      <div class="carousel-caption">
        <h3>MNIT</h3>
        <p>Prabha Bhawan</p>
      </div>
    </div>

    <div class="item">
      <img src="images/mnit2.jpeg" alt="MNIT">
      <div class="carousel-caption">
        <h3>MNIT</h3>
        <p>Prabha Bhawan</p>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<br>

	<?php include 'footer.php'; ?>
</body>
</html>