<?php session_start();
  $username = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Picturegram</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">
  <?php
  	//connection is established to database
	require_once 'serverLogin.php';
	$conn = new mysqli($db_hostname,$db_username,$db_password,$db_database);
	if($conn->connect_error){
		die("Connection failed".mysql_error());
	}
	mysqli_select_db($conn, $db_database)or die("Unable to select database: " . mysql_error());

	//Name of the author is retrieved using UserID,username from the login and users table
	$loginQuery = "SELECT UserID FROM login WHERE Username = ? ";
  $stmt1 = $conn->prepare($loginQuery);
  $stmt1->bind_param("s",$username);
  $stmt1->execute();
  $result1= $stmt1->get_result();
	$loginRow = $result1->fetch_assoc();
	$UserID = $loginRow['UserID'];


	
  $userSql = "SELECT * FROM users WHERE UserID = ?";
  $stmt2 = $conn->prepare($userSql);
  $stmt2->bind_param("s",$UserID);
  $stmt2->execute();
  $result2 = $stmt2->get_result();
  $usersRow = $result2->fetch_assoc();
  $author = $usersRow['Name'];
  
  ?>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="about.php"><?php echo "$author"; ?>  </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addpost.php">Add post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/logo.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Picturegram</h1>
            <span class="subheading">your life in pictures</span>
          </div>
        </div>
      </div>
    </div>
  </header>
  
  <?php


  	//All posts from posts table is retrieved in order of latest post first
	$myquery = "SELECT * FROM  posts ORDER BY `Date` desc";
	
	//checking if the query returns a value 
	//if true the the data is stored in the assosciated array $postAuthorRow 
	//data is retrieved using the column names as key and stored in variables
	//the variables are echoed or passed on to post.php

	if($result = $conn->query($myquery)){
		while($row = $result->fetch_assoc()){
			$id = $row['PostID'];
			$imgLocation = $row['PostImage'];
			$associatedText = $row['Post'];
			$date = $row['Date'];
      $postUserID = $row['UserID'];
			$formatDate = date("F jS, Y -g:ia",strtotime($date)); //formatting date

			$postAuthorSql = "SELECT Name FROM users WHERE UserID = ?";
      $stmt3 = $conn->prepare($postAuthorSql);
      $stmt3->bind_param("s",$postUserID);
      $stmt3->execute();
      $result3 = $stmt3->get_result();
      $postAuthorRow = $result3->fetch_assoc();
      $postAuthor = $postAuthorRow['Name'];
      
			
			?>
			<center>
			<a href="post.php?image=<?php echo$imgLocation;?>&id=<?php echo$id;?>&postAuthor=<?php echo$postAuthor;?>">	
			<img src="img/<?php echo ($imgLocation);?>" style = "width: 720px;height: 380px">
			</a>
			<?php
			echo "<br>$associatedText<br> Posted by:"; ?> <a href="about.php?id=<?php echo("$postUserID");?> "><? echo "<b>$postAuthor</b>";?></a> 
      <?php 
      echo "on $formatDate";
      
			echo "<br>";

		}
	}
  	
			$conn->close();
  ?>
  		</center>
  		<br><br>
  
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>
      </div>
    </div>
  </div>

  <hr>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <p class="copyright text-muted">Copyright &copy; Your Website 2020</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>
