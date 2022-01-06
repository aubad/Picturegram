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

  <title>Post</title>

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
    <?php
    //default timezone set to halifax time
    date_default_timezone_set('America/Halifax');
    /*
    checking $request type and setting the variables accordingly
    */
    $request = $_SERVER['REQUEST_METHOD'];

    //connection is established
    require_once 'serverLogin.php';
    $conn = new mysqli($db_hostname,$db_username,$db_password,$db_database);
    if($conn->connect_error){
    die("Connection failed".mysql_error());
    }
    mysqli_select_db($conn, $db_database)or die("Unable to select database: " . mysql_error());
  	

  	//Using GET or POST to get the picture location user id of of the postAuthor and the name of the post Author
    if($request == "GET"){
      if(isset($_GET['id']) && isset($_GET['image'])){
        $pictureName = $_GET['image'];
        $id = $_GET['id'];
        $postAuthor = $_GET['postAuthor'];

      }
    
    }
    else{
      $pictureName = $_POST['image'];
      $id = $_POST['id'];
      $postAuthor = $_POST['postAuthor'];
    }
    

    //Name of the current logged in user is retrieved using postID,username from the login and users table
    $loginQuery = "SELECT UserID FROM login WHERE Username = ? ";
    $stmt1 = $conn->prepare($loginQuery);
    $stmt1->bind_param("s",$username);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $loginRow = $result1->fetch_assoc();
    $UserID = $loginRow['UserID'];

  	
  	$userSql = "SELECT * FROM users WHERE UserID = ? ";
  	$stmt2 = $conn->prepare($userSql);
  	$stmt2->bind_param("i",$UserID);
  	$stmt2->execute();
  	$result2 = $stmt2->get_result();
    $usersRow = $result2->fetch_assoc();
    $author = $usersRow['Name'];
  	

    //new comments are inserted using a prepared statement
    $insertSql = "INSERT INTO comments(`UserID`, `PostID`, `Comment`, `Date`)  VALUES (?,?,?,?)";
    if(!$stmt3=$conn->prepare($insertSql)){
    	echo "Error in comment insertion";
    }
    else{
    	$stmt3->bind_param("iiss",$UserID,$id,$newComment,$currentDate);
    }

    

    if(isset($_POST['formSubmit'])){
      if($_POST['formSubmit']=='Submit'){
        $newComment = $_POST['formComment'];
        $currentDate = date("Y-m-d G:i:s");
        $stmt3->execute();

        /*if($conn->query($sql)){
        }
        else{
          echo "Error" . $sql ."<br>".$conn->error ;
        }*/

      }
    }
    else {
    //echo "Error: " . $sql. "<br>" . $conn->error;
    }

    
  
  ?>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      
      <a class="navbar-brand" href="about.php"> <?php echo $author; ?> </a>
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
 
  <header class="masthead" style="background-image: url('img/<?php echo($pictureName)?>')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <?php
            //selecting all attributes from posts table where the postID($id) that is passed from the index page
            //matches the PostID
            //The Post and Date attributes are retrieved and stored in variables
            // Then varibles are echoed on top of the background image of the nav bar

            $headingQuery = "SELECT * FROM posts WHERE posts.PostID=?";
            $stmt4 = $conn->prepare($headingQuery);
            $stmt4->bind_param("i",$id);
            $stmt4->execute();
            $headingResult= $stmt4->get_result();
            $headerRow =$headingResult->fetch_assoc();
            $headerText = $headerRow['Post'];
            $headerDate = $headerRow['Date'];
            $formatHeaderDate = date("F jS, Y -g:ia",strtotime($headerDate)) //formatting date
            ?>
            <h5><?php echo $headerText  ?></h5>
            <span class="subheading">Posted by <?php echo $postAuthor; ?> on <?php echo $formatHeaderDate; ?> </span>
            
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form method="post" action="post.php">
              <input type="text" name="formComment" maxlength="100" size="120">
              <input type="hidden" name="image" value="<?php echo $pictureName?>">
              <input type="hidden" name="id" value="<?php echo $id?>" >
              <input type="hidden" name="postAuthor" value="<?php echo $postAuthor?>" >
              <input type="submit" name="formSubmit" value="Submit">
            </form>
          </div>
        </div>

        <!-- Single Comment -->
        <div class="media mb-4">
          
          <div class="media-body">
            
            <?php 
            //Selecting all comments and dates from the "comments" table where the postID($id) that is passed from the index page
            //matches the commentID and ordering from latest to oldest
            $myquery = "SELECT comments.Comment,comments.Date,comments.UserID FROM comments WHERE comments.PostID=? ORDER by comments.Date DESC";
            $stmt5 = $conn->prepare($myquery);
            $stmt5->bind_param("i",$id);
            $stmt5->execute();
            $result = $stmt5->get_result();


            //checking if the query returns a value 
            //if true the the data is stored in the assosciated array $row 
            //data is retrieved using the column names as key and stored in variables
            //the varibles are echoed
            
            while ($row = $result->fetch_assoc()) {
            ?>
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <?php
              $date = $row['Date'];
              $formatDate = date("F jS, Y -g:ia",strtotime($date)); //formatting date
              $commentAuthorId = $row['UserID'];
              

              //$commentAuthorSql = "SELECT Name FROM users WHERE UserID = '$commentAuthorId'";
              $commentAuthorSql = "SELECT Name FROM users WHERE UserID = ?";
              $stmt6 = $conn->prepare($commentAuthorSql);
              $stmt6->bind_param("i",$commentAuthorId);
              $stmt6->execute();
              $result3 = $stmt6->get_result();
              $commentAuthorRow = $result3->fetch_assoc();
              $commentAuthor = $commentAuthorRow['Name'];
              
              
              echo "$formatDate Author: $commentAuthor";
            ?>
            
            <?
              $actualComment = $row['Comment'];
              echo "<br>$actualComment<br>";
              
            
              }
            
            $conn->close();
            ?>
            
          </div>
        </div>

      </div>

  

  <!-- Footer -->
  <footer class="py-5 bg-light">
    <div class="container">
      <p class="m-0 text-center text-black">Copyright &copy; Your Website 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>

