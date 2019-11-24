<?php
//signup.php
include 'connect.php';
include 'header.php';

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "theforum";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

 

 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    /*the form hasn't been posted yet, display it
      note that the action="" will cause the form to post to the same page it is on */
    echo '
    <div class="jumbotron">
    <h1 class="display-4">Sign Up</h1>
    <hr class="my-4 ">
    <form method="post" action="" class="form-inline">
        <div class="form-group mb-2 ">
        <div class="form-group mb-2 col">
        <label for="user_name" class="sr-only">UserName</label>
        <input type="text"  class="form-control shadow rounded" name="user_name" placeholder=" Username">
      </div>
      
      <div class="form-group mx-sm-3 mb-2 ">
        <label for="user_pass" class="sr-only">Password</label>
       
        <input type="password" class="form-control shadow rounded" name="user_pass" placeholder="Password">
      </div>
      <div class="form-group mx-sm-3 mb-2 ">
      <label for="user_pass_check" class="sr-only">Password</label>
      <input type="password" class="form-control shadow rounded" name="user_pass_check" placeholder="Confirm Password">
    </div>
        <div class="form-group col">
        <input type="email" class="form-control shadow rounded" id="user_email" name="user_email" aria-describedby="emailHelp" placeholder="Enter email">
         </div>
         <div class="form-group col">
  <button type="submit" class="btn btn-primary m-3 shadow-lg rounded ">Register</button> </div>
     </form>
     </div>
     ';
}
else
{
    /* so, the form has been posted, we'll process the data in three steps:
        1.  Check the data
        2.  Let the user refill the wrong fields (if necessary)
        3.  Save the data 
    */
    $errors = array(); /* declare the array for later use */
     
    if(isset($_POST['user_name']))
    {
        //the user name exists
        if(!ctype_alnum($_POST['user_name']))
        {
            $errors[] = 'The username can only contain letters and digits.';
        }
        if(strlen($_POST['user_name']) > 30)
        {
            $errors[] = 'The username cannot be longer than 30 characters.';
        }
    }
    else
    {
        $errors[] = 'The username field must not be empty.';
    }
     
     
    if(isset($_POST['user_pass']))
    {
        if($_POST['user_pass'] != $_POST['user_pass_check'])
        {
            $errors[] = 'The two passwords did not match.';
        }
    }
    else
    {
        $errors[] = 'The password field cannot be empty.';
    }
     
    if(!empty($errors)) /*check for an empty array, if there are errors, they're in this array (note the ! operator)*/
    {
        echo 'Uh-oh.. a couple of fields are not filled in correctly..';
        echo '<ul>';
        foreach($errors as $key => $value) /* walk through the array so all the errors get displayed */
        {
            echo '<li>' . $value . '</li>'; /* this generates a nice error list */
        }
        echo '</ul>';
    }
    else
    {
        //the form has been posted without, so save it
        //notice the use of mysql_real_escape_string, keep everything safe!
        //also notice the sha1 function which hashes the password
        $sql = "INSERT INTO
                    users(user_name, user_pass, user_email ,user_date, user_level)
                VALUES('" . mysqli_real_escape_string($conn,$_POST['user_name']) . "',
                       '" . sha1($_POST['user_pass']) . "',
                       '" . mysqli_real_escape_string($conn,$_POST['user_email']) . "',
                        NOW(),
                        0)";
                         
        $result = mysqli_query($conn,$sql);
        if(!$result)
        {
            //something went wrong, display the error
           // echo 'Something went wrong while registering. Please try again later.';
      echo '      <script type="text/javascript">
            alert("Something went wrong while registering. Please try again later.");
            </script>';
            //echo mysql_error(); //debugging purposes, uncomment when needed
        }
        else
        {
            echo 'Successfully registered. You can now <a href="signin.php">sign in</a> and start posting! :-)';
        }
    }
}
 
include 'footer.php';
?>