
<div class="container bg-dark rounded shadow p-2"> 
<form method="post" action="">
    
    <div class="form-group">
    <textarea name="replycontent" class="form-control input-lg" rows="7" required></textarea>
    
  
  </div>
  <div>
          
          <input class='form-check-input m-1' type='checkbox' value='' name='anon_check_reply'
          id='defaultCheck1'>
          
         <label class='form-check-label ml-4 text-light' for='defaultCheck1'>
         Anonymous
         </label>
          </div>
          <p></p>
  <button type="submit" class="btn btn-success " style="width:100px;">Reply</button>

  
  </form>
</div>
<!-- <form method="post" action="">
   
    <textarea name="reply_content" required></textarea>
    <input type="submit" value="Submit reply" />
</form> -->
<?php


 // Start the session
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    include 'connect.php';
    $posid = $_GET['id'] ;
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //someone is calling the file directly, which we don't want
    // echo 'This file cannot be called directly.';
}
else
{
   
    
    //check for sign in status
    if(!$_SESSION['signed_in'])
    {   
        
        echo '<script type="text/javascript">
        function newLocation() {
            window.location="topic.php?id='.$posid.'";
        }
        newLocation();
        alert("Sign in to reply");
        

</script>';
    }
    else
    {
    //    $repmsg = $_POST['replycontent'];
    //    echo $repmsg;
            //checking for anonymous
            $anon_reply = 0;
            //checking if anonymous checked
            if(isset($_POST['anon_check_reply'])){
                $anon_reply = 1;
            }   


        $sql = "
        INSERT INTO  reply (reply,reply_to,reply_by,reply_date,reply_anony) VALUES
         ('".$_POST['replycontent']."',$_GET[id],'".$_SESSION['user_id']."',NOW(),$anon_reply)
        ";
        // $sql = "
        // INSERT INTO reply (reply,reply_to,reply_by) VALUES ("
        // .$_POST['reply-content'].",".$_GET['id']."," .$_SESSION['user_id'] .")";
     
                //         $sql = "INSERT INTO 
                //     reply(reply,reply_to,reply_by) 
                // VALUES ('" . $_POST['reply-content'] . "',
                //         " . mysqli_real_escape_string($conn,$_GET['id']) . ",
                //         " . $_SESSION['user_id'] . ")";
                         
                          
        $result = mysqli_query($conn,$sql);
                         
        if(!$result)
        {
            
            echo '<script type="text/javascript">

            alert("Your reply has not been saved, please try again later."); 
     
     </script>';
        }
        else
        {
           
            // Header("Location: topic.php?id=".$_GET['id']);
//echo 'Reply added successfully. Go to the <a href="topic.php?id='.$posid. '">Post</a>.';
echo '  
<script>
function newLocation() {
    window.location="topic.php?id='.$posid.'";
}
newLocation();

</script>  


';        }
    }
}
 

?>