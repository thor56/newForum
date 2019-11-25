<?php
//create_topic.php
include 'connect.php';
include 'header.php';
 
echo '<p></p>';
//check if user is logged in
if($_SESSION['signed_in'] == false)
{
    //ask the user to sign-in
    echo 'Please Login to use start a Discussion, ' . '<a href="signin.php">Sign in</a>'; 
}
else
{
    //the user is signed in
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {   
        //the form hasn't been posted yet, display it
        //retrieve the categories from the database for use in the dropdown
        $sql = "SELECT
                    cat_id,
                    cat_name,
                    cat_description
                FROM
                    categories";
         
        $result = mysqli_query($conn, $sql);
         
        if(!$result)
        {
            //the query failed, uh-oh :-(
            echo 'Error while selecting from database. Please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                //there are no categories, so a topic can't be posted
                if($_SESSION['user_level'] == 1)
                {
                    echo 'You have not created categories yet.';
                }
                else
                {
                    echo 'Before you can post a topic, you must wait for an admin to create some categories.';
                }
            }
            else
            {
         
                // echo '<form method="post" action="">
                //     Subject: <input type="text" name="topic_subject" />
                //     Category:'; 
                 
                // echo '<select name="topic_cat">';
                //     while($row = mysqli_fetch_assoc($result))
                //     {
                //         echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                //     }
                // echo '</select>'; 
                     
                // echo 'Message: <textarea name="post_content" /></textarea>
                //     <input type="submit" value="Create topic" />
                //  </form>';

                echo "
                
                <div class='container'> 
    <div class='jumbotron'>
      <div class='jumbotron-content '>
        <h1>Create a new Post</h1>
        
        <form name='cat_info' method='post' action=''>
          <div >
            <label for='topic_subject'>Post Title</label>
            <input type='text' name='topic_subject' class='form-control'
             placeholder='Title' required>
            <p></p>
          </div>
            ";
                echo '<select name="topic_cat" class="form-control">';
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo '<option value="' . $row['cat_id'] . '">'
                         . $row['cat_name'] . '</option>';
                    }
                echo '</select>'; 


                echo "
        <div >
            <label for='post_content'>Post description :</label>
            <textarea name='post_content'class='form-control'
             placeholder='Post content' required/></textarea>
             
         
          </div>
          <div>
          
          <input class='form-check-input m-2' type='checkbox' value='' name='anon_check'
          id='defaultCheck1'>
          
         <label class='form-check-label ml-4' for='defaultCheck1'>
         Anonymous
         </label>
          </div>
          
          <p></p>
          <input type='submit' class='btn btn-primary btn-large' value='Post' />
          
          
        
        
          </form>
      </div>
      
    </div>
    
  </div>
                

                
                ";
            }
        }
    }
    else
    {
        //start the transaction
        $query  = "BEGIN WORK;";
        $result = mysqli_query($conn,$query);
         
        if(!$result)
        {
            //Damn! the query failed, quit
            echo 'An error occured while creating your topic. Please try again later.';
        }
        else
        {
            $anon_checked = 0;
            //checking if anonymous checked
            if(isset($_POST['anon_check'])){
                $anon_checked = 1;
            }
           
            //the form has been posted, so save it
            //insert the topic into the topics table first, then we'll 
//            save the post into the posts table
            $sql = "INSERT INTO 
                        posts(post_title,
                        post_content,
                        post_date,
                        post_category,
                        post_by,
                        post_anony)
                   VALUES('" . mysqli_real_escape_string($conn, $_POST['topic_subject']) . "',
                        '" . mysqli_real_escape_string($conn, $_POST['post_content']) . "'   ,
                               NOW(),
                               " . mysqli_real_escape_string($conn, $_POST['topic_cat']) . ",
                               " . $_SESSION['user_id'] . "
                               ,$anon_checked)";
                              
                      
            // $result = mysqli_query($conn, $sql);
            // if(!$result)
            // {
            //     //something went wrong, display the error
            //     echo 'An error occured while inserting your data. Please try again later.' . mysqli_error();
            //     $sql = "ROLLBACK;";
            //     $result = mysqli_query($conn, $sql);
            // }
            // else
            // {
            //     //the first query worked, now start the second, posts query
            //     //retrieve the id of the freshly created topic for usage in the posts query
            //     $topicid = mysqli_insert_id($conn);
                 
            //     $sql = "INSERT INTO
            //                 posts(post_content,
            //                       post_date,
            //                       post_topic,
            //                       post_by)
            //             VALUES
            //                 ('" . mysqli_real_escape_string($conn, $_POST['post_content']) . "',
            //                       NOW(),
            //                       " . $topicid . ",
            //                       " . $_SESSION['user_id'] . "
            //                 )";
                $result = mysqli_query($conn,$sql);
                 
                if(!$result)
                {
                    //something went wrong, display the error
                    echo 'An error occured while inserting your post. Please try again later.' . mysqli_error($conn);
                    $sql = "ROLLBACK;";
                    $result = mysqli_query($conn, $sql);
                }
                else
                {
                    $topicid = mysqli_insert_id($conn);
                    $sql = "COMMIT;";
                    $result = mysqli_query($conn, $sql);                  
                     
                    //after a lot of work, the query succeeded!
                     echo 'You have successfully created your new <a href="topic.php?id='.
                      $topicid . '">Post</a>.';
           //         echo 'You have successfully created your new Post.';

                }
            
        }
    }
}
 
include 'footer.php';
?>