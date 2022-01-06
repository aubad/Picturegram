<?php
  session_start();
  require_once('serverLogin.php');
  $conn = mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
  if($conn->connect_error){
    die("Connection failed".mysql_error());
  }

  mysqli_select_db($conn, $db_database)or die("Unable to select database: " . mysql_error());
  $loggedIn = false;
  $msg = "null";

  //Checking if the forms are set
  //if they are set username is used to retrieve the hashed password
  //the hashed passsword is checked using password_verify method
  //if both fields are correct the user is redirected to index.php
  // else a message is echoed out to enter the correct password
  
  if(isset($_SESSION['username']) || isset($_SESSION['password'])){
    $loggedIn = true;
  }
  $request = $_SERVER['REQUEST_METHOD'];
  if($request == "POST"){
    if(isset($_POST['username']) && $_POST['password']){
      $username = $_POST['username'];
      $password = $_POST['password'];
      
      $sql = "SELECT * FROM login where Username = '$username' ";
      $stmt1 = $conn->prepare($sql);
      $stmt1->bind_param("s",$username);
      $stmt1->execute();
      $result = $stmt1->get_result();
      $row = $result->fetch_assoc();

      if(password_verify($password, $row['Password'])){
        $_SESSION['username'] = $row['Username'];
        $_SESSION['password'] = $row['Password'];
        header("Location: index.php");
      }
      else{
        $msg = "oops! Username or Password Not Correct";
        
      }
      
        
    }
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="login.php">Picturegram</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Add Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
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
          <div class="page-heading">
            <h1>Picturegram</h1>
            <span class="subheading">LOGIN TO YOUR ACCOUNT</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <form method="post" action="login.php">
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <?php 
                if($msg == "null"){

                }
                else{
                  echo "$msg"; 
                }
              ?>
              <label>UserName</label>
              <input type="text" name="username" placeholder="UserName">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Password</label>
              <input type="Password" name="password" placeholder="Password">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <button type="submit" class="btn btn-primary" id="sendMessageButton">Submit</button>
        </form>
        <p>If you don't have an account create one</p>
        <button onclick="location.href = 'createAccount.php' " type="submit" class="btn btn-primary" id="createAccountBtn">Create Account</button>
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

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>
