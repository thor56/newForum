<?php
// Start the session
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <title>Hello, world!</title>
  
                                    <!--    CONTENT   -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
  <a class="navbar-brand" href="/newforum/index.php">Forum</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/newforum/index.php">Home <span class="sr-only">(current)</span></a>
     
      </li>  
      <a class="nav-link" href="/newforum/create_topic.php">Post</a>
      <a class="nav-link" href="/newforum/create_cat.php">Create a category</a>


    </ul>

 
  </div>

  
  <div class="collapse navbar-collapse" id="navbarSupportedContent"  >
  <div class="shadow-lg border   rounded">
  <ul class="navbar-nav mr-auto"  >
      <?php
      if(!isset($_SESSION['signed_in']))
      {
          $_SESSION['signed_in'] = false; 
        
      }

          if($_SESSION['signed_in'])
          {
           echo   '<a class="nav-link" href="signout.php" >Sign out</a>';
              
      
          }
          else
          {
              echo '<a class="nav-link" href="signin.php">Sign In</a><a class="nav-link" href="signup.php" >Sign Up</a>';
              
          }

      ?>
      </div>
      </ul>

<!-- search -->
      <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search"
       placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0 "
       type="submit">Search</button>
    </form> -->
      
  </div>
</nav>



</head>
  <body class="Site" >
    <div class="container Site-content"  id="page-container"> 
    <div id="content-wrap ">
      <p></p>
 