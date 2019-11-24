<?php
//display_cat.php
include 'connect.php';



//displaying all the categories
$sql1 = "select cat_id, cat_name, cat_description from categories";
 
$result = mysqli_query($conn, $sql1);
 
if(!$result)
{
    echo 'The categories could not be displayed, please try again later.';
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'No categories defined yet.';
    }
    else
    {
        //prepare the table
        echo '<table border="1" class="table">
              <thead class="thead-dark">
                <th>Category</th>
              
              </thead>'; 
             
        while($row = mysqli_fetch_assoc($result))
        {               
            echo '<tr>';
                echo '<td class="leftpart">';
 //                   echo '<h3><a href="category.php?">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
                      echo '<h3><a href="category.php?id='.$row['cat_id'].'">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];

                    echo '</td>';
                // echo '<td class="rightpart">';
                //             echo '<a href="topic.php?id=">Topic subject</a> at 10-10';
                // echo '</td>';
            echo '</tr>';
        }
    }
}


?>