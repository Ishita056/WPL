<?php
  require_once "config.php";

  if ($_SERVER['REQUEST_METHOD'] == "POST"){

    $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set the value of param email
            $param_email = trim($_POST['email']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    alert("This email already exists"); 
                }
                else{
                    $email = trim($_POST['email']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    
    $username = trim($_POST['username']);
    // $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "INSERT INTO users (username,email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $param_password);
        // set parameter
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);

    mysqli_close($conn);
  
  
  
  }



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>  
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css\register.css">
    <title>Register</title>
  </head>
  <body>

    <div>
      <a href="login.php" class="previous round">
          <i id="back" class="fa fa-chevron-left" aria-hidden="true" href="login.php"></i>
      </a>
    </div>

    <div class="login-form">
      <form method="post" >
        <h1>Register</h1>
        <div class="content">
          <div class="input-field">
            <input type="text" name="username" placeholder="Username" autocomplete="nope" required="true">
          </div>
          <div class="input-field">
            <input type="email" name="email" placeholder="Email" autocomplete="nope" required="true">
          </div>
          <div class="input-field form-group">
            <input type="password" minlength="6" name="password" placeholder="Password" autocomplete="new-password" required="true">
          </div>
        </div>
        <div class="action">
          <button type="submit">
            <a href="login.php" class="butt">Register</a>
          </button>
        </div>
      </form>

    </div>

  </body>
</html>
