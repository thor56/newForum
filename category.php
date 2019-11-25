<?php
//category.php
include 'connect.php';
include 'header.php';
 
//displaying particular category based on selection


//first select the category based on $_GET['cat_id'] 
// WHERE
           // cat_id = " . mysqli_real_escape_string($conn, $_GET['id'])
$sql = "SELECT
            cat_id,
            cat_name,
            cat_description
        FROM
            categories
        where
        cat_id = " . mysqli_real_escape_string($conn, $_GET['id']);   
 
$result = mysqli_query($conn, $sql);
 
if(!$result)
{
    echo 'The category could not be displayed, please try again later.' . mysqli_error($conn);
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'This category does not exist.';
    }
    else
    {
        //display category data
        while($row = mysqli_fetch_assoc($result))
        {
            echo '<h2>Posts in ' . $row['cat_name'] . ' category</h2>';
        }
     
                // $sql = "select 
                //     topic_id,topic_subject,topic_date,topic_cat 
                // from 
                //     topics 
                // where 
                //     topic_cat =" . mysqli_real_escape_string($conn, $_GET['id']);

                $sql = "select 
                post_id,post_title,post_date,post_category
            from 
                posts 
            where 
                post_category =" . mysqli_real_escape_string($conn, $_GET['id']);
         
        $result = mysqli_query($conn, $sql);
         
        if(!$result)
        {
            echo 'The topics could not be displayed, please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                echo 'There are no posts in this category yet.';
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
                    echo '<tr>';
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
    }
}
 
include 'footer.php';
?>