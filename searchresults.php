<?php
//searchresults.php
include 'connect.php';
include 'header.php';

if(!isset($_POST['searchbox'])){
    echo 'Direct access!!';
}


    $sql="SELECT post_id,post_title FROM posts WHERE post_title LIKE '%".$_POST['searchbox']."%'";
    $result = mysqli_query($conn, $sql);
//preparing the table
                    if(!$result)
                    {
                        echo 'The search could not be performed,
                         please try again later.';
                    }
                    else
                    {
                        if(mysqli_num_rows($result) == 0)
                        {
                            echo 'No posts matching your search found.';
                        }
                        else
                        {
                            //prepare the table
                            echo '<table border="1" class="table">
                                  <thead class="thead-dark">
                                    <th>Posts</th>
                                  
                                  </thead>'; 
                                 
                            while($row = mysqli_fetch_assoc($result))
                            {               
                                echo '
                                
                                <tr>';
                                echo '<td class="leftpart">';
                                echo '<h3><a href="topic.php?id='
                                 . $row['post_id'] . '">' . $row['post_title'] 
                                 . '</a><h3>';
                            echo '</td>';
                                    
                                echo '</tr>';
                            }
                    
                            echo '</table>';
                        }
                    }
                    





include 'footer.php';
?>