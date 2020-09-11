<?php
session_start();

if(!$_SESSION['email'])
{

    header("Location: Login.php");//redirect to login page to secure the welcome page without login access.
}

?>

<html>
<head>
<title>Welcome</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			
			<ul class="nav navbar-nav">
				<li class="active"><a href="Welcome.php">Home</a></li>
				<?php if(!$_SESSION['email']){ ?>
				<li class=""><a href="Login.php">Signin</a></li>
				<?php } ?>
				<?php if($_SESSION['email']){ ?>
				<li class=""><a href="Logout.php">Logout</a></li>
				<?php } ?>
			</ul>
		</div>
	</nav>
<div class="container">
	<?php
	include("database/Db_conection.php");
	$view_videos_query="select * from videos";
	$run=mysqli_query($dbcon,$view_videos_query);
	while($row=mysqli_fetch_array($run))
	{
		$id=$row['id'];
		$title=$row['title'];
		?>
	<div class="col-lg-3 col-md-4 col-6">
      <a href="play-video.php?id=<?php echo $id; ?>" class="d-block mb-4 h-100">
      		<img class="img-fluid img-thumbnail" src="" alt="">
            <h1><?php echo $title;  ?></h1>
          </a>
    </div>

	<?php } ?>
</div>

</body>

</html>

