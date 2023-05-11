<?php
require_once "config.php";
session_start();

$email1 = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email = '$email1' " ;
$result = $conn -> query($sql);

// echo "<script>alert('".$email1."')</script>";
$row = $result -> fetch_assoc(); 

$conn->close();

// if(ISSET($_POST['email'])){
//   $username = $_POST['username'];
//   $password = $_POST['password'];
//   $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'") or die(mysqli_error());
//   $fetch = mysqli_fetch_array($query);
// }


?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css\test.css">
    <title>IMDb</title>
</head>
<body>
  <nav class="navbar">
    <div class="topnav">
      <div>
        <!-- <a id="menubtn" href="#menu"><i class="fa fa-bars" aria-hidden="true"></i> Menu</a> -->
        <a id="menubtn" href="about.php"><i class="fa fa-question-circle" aria-hidden="true"></i> About</a>
      </div>
      <div id="search-bar">
        <form id="search-form">
          <input type="text" id="search-input" placeholder="Search IMDb">
          <button id="search-icon"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
        
      </div>
      <!-- <a href="#contact">Contact</a> -->
      <a id="navbtn" href="logout.php" >
        <i class="fa fa-sign-out" aria-hidden="true"></i> Log Out
      </a>
      <span id="navbtn" class="navbar-text">
        <i class="fa fa-user" aria-hidden="true"></i> <?php echo "Welcome ". $row["username"]?>
      </span>
      
    </div> 
  </nav>
  <br>
  <br>
      
    

  <div class="sidenav">
    <a href="test.php"><img id="logo" src="css\logo.png" alt="logo"></a>
    <div class="filters">
      <!-- <b>Filter<br> </b> -->
      <b>Genre<br></b>
      <form action="" id="filter-form">
        <td><input type="checkbox" id="genre1" name="genre" class="genre" value="Thriller"></td>
        <label for="genre1"> Thriller </label><br>
          
        <td><input type="checkbox" id="genre2" name="genre" class="genre" value="Romance"></td>
        <label for="genre2"> Romance </label><br>
          
        <td><input type="checkbox" id="genre3" name="genre" class="genre" value="Crime"></td>
        <label for="genre3"> Crime </label><br>
          
        <td><input type="checkbox" id="genre4" name="genre" class="genre" value="Comedy"></td>
        <label for="genre4"> Comedy </label><br>
          
        <td><input type="checkbox" id="genre5" name="genre" class="genre" value="Action"></td>
        <label for="genre5"> Action </label><br>
          
        <td><input type="checkbox" id="genre6" name="genre" class="genre" value="Adventure"></td>
        <label for="genre6"> Adventure </label><br>
          
        <td><input type="checkbox" id="genre7" name="genre" class="genre" value="Sci-Fi"></td>
        <label for="genre7"> Sci-Fi </label><br>
          
        <td><input type="checkbox" id="genre8" name="genre" class="genre" value="Horror"></td>
        <label for="genre8"> Horror </label><br>
          
        <td><input type="checkbox" id="genre9" name="genre" class="genre" value="Drama"></td>
        <label for="genre9"> Drama </label><br>
          
        <!-- <br>
        <b>Avg Star Rating<br></b>
        <input type="checkbox" id="rating1 " name="rating1" value="one">
        <label for="rating1"> 0 - 2 </label><br>
          
        <input type="checkbox" id="rating2 " name="rating2" value="two">
        <label for="rating2"> 2 - 4 </label><br>
          
        <input type="checkbox" id="rating3 " name="rating3" value="three">
        <label for="rating3"> 4 - 6 </label><br>
          
        <input type="checkbox" id="rating4 " name="rating4" value="four">
        <label for="rating4"> 6 - 8 </label><br>

        <input type="checkbox" id="rating4 " name="rating4" value="four">
        <label for="rating4"> 8 - 10 </label><br> -->
      <!-- </div> -->
      </form>
      <br>
      
      <!-- <div class="filter-nav"> -->
      <a id="filter-btn">
        <button class="btn1" type="submit" id="button" onclick="getFilter()"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
      </a>
      <!-- <a >
        <button class="btn2" type="reset" id="reset"><i class="fa fa-times" aria-hidden="true"></i> Clear</button>
      </a> -->
    </div>
  </div>
  
  
  <div>
    <!-- <div><h1 id="line">.</h1></div> -->
    <h1 id="category-title">What's New?</h1>
  </div>
  <div id="movies-grid"></div>

  <script>
   // Get all the checkboxes with class "genre"
const checkboxes = document.querySelectorAll('.genre');

// Add a "change" event listener to each checkbox
checkboxes.forEach(checkbox => {
  checkbox.addEventListener('change', () => {
    // Create an empty array to store the checked values
    const checkedValues = [];

    // Loop through all the checkboxes and push the checked values into the array
    checkboxes.forEach(checkbox => {
      if (checkbox.checked) {
        filterMovies(checkbox.value);
        checkedValues.push(checkbox.value);
      }
    });

    // Log the checked values to the console
    console.log(checkedValues);
  });
});


  function getFilter(){
    console.log("hello")
  }
  </script>

  <script src="javascript/test.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>
</html>

<!-- fat-a-fat this extension is pretty good though fwd ig i gotta comment it out yeah plus one neend aa rhi hai-->