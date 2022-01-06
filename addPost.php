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

  <title>Add Post</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">


  <?php
  //default timezone set to halifax time
  date_default_timezone_set('America/Halifax');

  //connection is established
  require_once 'serverLogin.php';
  $conn = new mysqli($db_hostname,$db_username,$db_password,$db_database);
  if($conn->connect_error){
    die("Connection failed".mysql_error());
  }
  mysqli_select_db($conn, $db_database)or die("Unable to select database: " . mysql_error());

  //Name of the current logged in user is retrieved using postID,username from the login and users table
  $loginQuery = "SELECT UserID FROM login WHERE Username = ? ";
  $stmt1 = $conn->prepare($loginQuery);
  $stmt1->bind_param("s",$username);
  $stmt1->execute();
  $result1 = $stmt1->get_result();
  $loginRow = $result1->fetch_assoc();
  $UserID = $loginRow['UserID'];
  
  $userSql = "SELECT * FROM users WHERE UserID = ?";
  $stmt2 = $conn->prepare($userSql);
  $stmt2->bind_param("i",$UserID);
  $stmt2->execute();
  $result2 = $stmt2->get_result();
  $usersRow = $result2->fetch_assoc();
  $author = $usersRow['Name'];
  

    //checking if form is set 
    //if true the user input is retrieved and stored in varibles
    //The variables are inserted in the posts table using a prepared statement
  if(isset($_POST['formSubmit'])){
      if($_POST['formSubmit']=='Submit'){
        $post = $_POST['formPost'];
        $postImage = $_POST['formImg'];
        $currentDate = date("Y-m-d G:i:s");
        $sql = "INSERT INTO posts(`UserID`,`PostImage`,`Post`,`Date`) VALUES(?,?,?,?)";
        $stmt3 = $conn->prepare($sql);
        $stmt3->bind_param("isss",$UserID,$postImage,$post,$currentDate);
        $stmt3->execute();

      }
    }
    else {
    //echo "Error: " . $sql. "<br>" . $conn->error;
    }  

    $conn->close();
  ?>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="about.php"><?php echo $author; ?></a>
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
            <a class="nav-link" href="addPost.php">Add Post</a>
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
            <h1>picturegram</h1>
            <span class="subheading">Add NEW POST</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <hr>
  <!--  
    form is created to get user data
  --> 
  <div class="card my-4">
          <h5 class="card-header">Add a post </h5>
          <div class="card-body">
            <form method="post" action="addPost.php">
              <h5>Post:</h5>
              <input type="text" name="formPost" size="120">
              <h5>Image Filename:</h5>
              <input type="text" name="formImg" size="120">
              <input type="submit" name="formSubmit" value="Submit">
            </form>
          </div>
        </div>

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
