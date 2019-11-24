<?php
//create_cat.php
include 'connect.php';
include 'header.php';

//check if user is logged in
if($_SESSION['signed_in'] == false)
{
    //ask the user to sign-in
    echo 'Please Login to create a Category, ' . '<a href="signin.php">Sign in</a>'; 
}

else {



if($_SESSION['user_level'] == 1){

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    
    echo "
<div class='container'> 
    <div class='jumbotron'>
      <div class='jumbotron-content'>
        <h1>Create a new Category</h1>
        <p class='jumbotron-lg-only'>Fill the details</p>
        <form name='cat_info' method='post' action=''>
          <div >
            <label for='cat_name'>Category :</label>
            <input type='text' name='cat_name' class='form-control' placeholder='Name'>
          </div>
          <div >
            <label for='cat_description'>Category description :</label>
            <textarea name='cat_description'class='form-control' placeholder='What does this Category describe about' /></textarea>
          </div>
          <p></p>
          <input type='submit' class='btn btn-primary btn-large' value='Add category' />
          <a href='#' class='pull-right btn btn-default'>Cancel</a>
        </form>
      </div>
      
    </div>
    
  </div>


     ";
}
else
{
    //the form has been posted, so save it
    $sql = "INSERT INTO categories(cat_name, cat_description)
       VALUES('" . mysqli_real_escape_string($conn, $_POST['cat_name']) . "',
             '" . mysqli_real_escape_string($conn, $_POST['cat_description']) . "')";
    $result = mysqli_query($conn, $sql);
    if(!$result)
    {
        //something went wrong, display the error
        echo 'Error' . mysqli_error($conn);
    }
    else
    {
        echo 'New category successfully added.';
    }
}
}
else if($_SESSION['user_level'] == '0')
{
    echo 'You are not authorised to create a Category, please forward the request to the authorised User.'; 
    
}
}


include 'display_cat.php';





include 'footer.php';
?>