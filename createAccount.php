<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">
	<title>Create Account</title>
	<?php
		//establishing connection
		require_once 'serverLogin.php';
		$conn = new mysqli($db_hostname,$db_username,$db_password,$db_database);
		if($conn->connect_error){
			die("Connection Failed".mysql_error());
		}
		mysqli_select_db($conn, $db_database)or die("Unable to select database: " . mysql_error());
		$request = $_SERVER['REQUEST_METHOD'];
		/*
		Using POST to get the user input from the form tag and storing it varibles 
		These variables are then inserted in the users table and login table
		to create a new user 
		password pattern checked using regex statements. if the password does not match a message of the pattern is echoed
		if the insertion is successful the user is redirected to the login.php page where he/she can login
		*/
		$msg = null;
		if(isset($_POST['Submit'])){
			if(isset($_POST['name'])&&isset($_POST['about'])&&isset($_POST['about'])&&isset($_POST['userName'])&&isset($_POST['password'])){
				$name = $_POST['name'];
				$about = $_POST['about'];
				$img = $_POST['img'];
				$userName = $_POST['userName'];
				$password = $_POST['password'];
				if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)){

					//password is hashed before insertion
					$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
					$sql = "INSERT INTO users(`Name`,`About`,`AboutImage`) VALUES (?,?,?)";
					$stmt1 = $conn->prepare($sql);
					$stmt1->bind_param("sss",$name,$about,$img);
					$stmt1->execute();

					
					
	        		
	        		$UserId = "";
					$sqlSelect = "SELECT * FROM users where Name = ? ";
					$stmt2 = $conn->prepare($sqlSelect);
					$stmt2->bind_param("s",$name);
					$stmt2->execute();
					$result = $stmt2->get_result();
					$row = $result->fetch_assoc();
					$UserId = $row['UserID'];
					echo "$UserId";

					
					
					//$sqlLogin = "INSERT INTO login(`UserID`,`Username`,`Password`) VALUES ('$UserId','$userName','$password') ";
					$sqlLogin = "INSERT INTO login(`UserID`,`Username`,`Password`) VALUES (?,?,?) ";
					$stmt3 = $conn->prepare($sqlLogin);
					$stmt3->bind_param("iss",$UserId,$userName,$hashedPassword);
					$stmt3->execute();
					header("Location: login.php");
				}
				else{
					$msg = "Please make sure the password contains atleast 1 special character,1 uppercase letter, a number and the length is atlest 7 characters";
				}
			}
		}


	 ?>
</head>
<body>
	  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="createAccount.php">Picturegram</a>
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

	<form method="POST" action="createAccount.php">
		<?php if($msg!=null){
			echo "$msg";
		} 
		?>
		<p>Name:</p>
		<input type="text" name="name" placeholder="Name:">
		<p>Tell me about you:</p>
		<input type="text" name="about" placeholder="Tell me about you">
		<p>Image:</p>
		<input type="text" name="img" placeholder="Image">
		<p>Userame</p>
		<input type="text" name="userName" placeholder="UserName:">
		<p>Password</p>
		<input type="password" name="password" placeholder="Password">
		<button type="submit" class="btn btn-primary" name="Submit">Submit</button>

	</form>
</body>
</html>