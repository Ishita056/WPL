<?php
session_start();

// check if the user is already logged in
if(isset($_SESSION['email']))
{
    header("location: test.php");
    exit;
}
require_once "config.php";

$email = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['email'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter email + password";
    }
    else{
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, email, password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_email);
    $param_email = $email;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
          {
            mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
            if(mysqli_stmt_fetch($stmt))
            {
                if(password_verify($password, $hashed_password))
                {
                    // this means the password is correct. Allow user to login
                    session_start();
                    $_SESSION["email"] = $email;
                    $_SESSION["id"] = $id;
                    $_SESSION["loggedin"] = true;
                    $_SESSION["username"] = $username;
                    

                    //Redirect user to welcome page
                    header("location: test.php");
                    
                }
            }

          }

    }
}    

mysqli_close($conn);
}


?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Welcome to IMDb</title>    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>
  <!-- bootstrap link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
  <link rel="stylesheet" href="css\login.css">

</head>
<body>
    <!-- <div>
        <a href="test.html" class="previous round">
            <i id="back" class="fa fa-chevron-left" aria-hidden="true" href="test.html"></i>
        </a>
    </div> -->

    <!-- <div class="login-form">
      <div class="heading"><h2 class="heading"> Please Login to Proceed!</h2></div><br> -->
    
      <!-- partial:index.partial.html -->
      <div class="login-form"> 
        <form method="post">
          <h1>Welcome to IMDb! Please Login:</h1>
          <div class="content">
            <div class="input-field">
              <input type="email" name="email" placeholder="Email" autocomplete="nope" required="true">
            </div>
            <div class="input-field">
              <input type="password" name="password" placeholder="Password" autocomplete="new-password" required="true">
            </div>
            <!-- <a href="#" class="link">Forgot Your Password?</a> -->
          </div>
          <div class="action">
            <button>
              <a class="butt" href="register.php">Register</a>
            </button>
            <button type="submit">
              <a class="butt" href="test.php">Log in</a>
            </button>
          </div>
        </form>
      </div>
    <!-- </div> -->

    <!-- partial -->
  <script  src="./script.js"></script>

</body>
</html>
