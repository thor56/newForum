
<?php
//topic.php
include 'connect.php';
include 'header.php';
//display selected topic content post



$sql = "SELECT * FROM posts WHERE post_id = ". mysqli_real_escape_string($conn, $_GET['id']);
$result = mysqli_query($conn, $sql);
 
if(!$result)
{
    echo 'The Topic could not be displayed, please try again later.' . mysqli_error($conn);
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'There is no post in the Topic.';
    }
    else
    {
        //display post data
        while($row = mysqli_fetch_assoc($result))
                {    
                    // $sql2="SELECT topic_subject FROM topics WHERE topic_id = $row[post_topic]";
                    // $result2 = mysqli_query($conn, $sql2);
                    // $sql3="SELECT user_name FROM users WHERE user_id = $row[post_by]";
                    // $result3 = mysqli_query($conn, $sql3);
                    // $sql4="SELECT reply,reply_by FROM reply WHERE reply_to = $row[post_topic]";
                    // $result4 = mysqli_query($conn, $sql4);

                   

                    $sql2="SELECT post_title FROM posts WHERE post_id = "
                    . mysqli_real_escape_string($conn, $_GET['id']);
                    $result2 = mysqli_query($conn, $sql2);
                    $sql3="SELECT user_name FROM users WHERE user_id = $row[post_by]";
                    $result3 = mysqli_query($conn, $sql3);
                    $sql4="SELECT reply,reply_by,reply_date,reply_anony FROM reply WHERE reply_to = $row[post_id]";
                    $result4 = mysqli_query($conn, $sql4);
           
                    while($row2 = mysqli_fetch_assoc($result2)){
                    $post_title = $row2['post_title'];
                    }
                    while($row3 = mysqli_fetch_assoc($result3)){
                         //checking if anonymous or not
                    $anony = $row['post_anony'];
                    if($anony==1){
                        $posted_by = "Anonymous User";
                    }
                    else{
                        $posted_by = $row3['user_name'];
                    }
                        
                        }
                        
                        
//post body
                    echo '<div class="container bg-custom-new rounded shadow"> ';
                        echo '<tr><td class="Title">';
                            echo '<h1 class="display-3">'.$post_title.'</h1> 
                            <p class="font-weight-lighter">by '
                             .$posted_by. ' On '.$row['post_date'].'</p>
                               <hr class="my-4 ">
                               ';
                        echo '</td>';
                    echo '</tr>';
                    echo '<tr>';
                        echo '<td class="post_body">';
                            echo '<h3 class="font-weight-light ">'
                            .$row['post_content'].'<h3> <br>';
                        echo '</td>';
                    echo '</tr>';

                    echo '</div>';
 //reply body
                        
                    echo '<div class="container rounded ">
                    <tr>';
                    echo '<tr><td class="Title">';
                    echo '<h1 class="display-3"> Replies </h1>
                       <hr class="my-4 ">
                       ';
                echo '</td>';
            echo '</tr>';
                    echo '<td class="replies_body">';
                    while($row4 = mysqli_fetch_assoc($result4)){
                        $sql5="SELECT user_name FROM users WHERE user_id =".
                         $row4['reply_by'];
                    $result5 = mysqli_query($conn, $sql5);
                    while($row5 = mysqli_fetch_assoc($result5)){


                               //checking if anonymous or not
                    $anony = $row4['reply_anony'];
                    if($anony==1){
                        $repliedby = "Anonymous User";
                    }
                    else{
                        $repliedby = $row5['user_name'];
                    }
                       
                        echo '<div class="container bg-custom-new rounded shadow m-3 p-3">
                        <p class="font-weight-lighter">('.$row4['reply_date'].')</p>
                        <p><h6>'.$repliedby.' says:</h6></p>
                        <h3 class="font-weight-light">'.$row4['reply'].'<h3></div>';
                    }    
                    }
                    echo '</td>';
                    echo '</tr></div>';

                    echo '</div>';


                }
     

    }
}


include 'reply.php';
include 'footer.php';
?>