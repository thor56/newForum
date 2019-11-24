<?php
//topic_view.php
include 'connect.php';
include 'header.php';
 
//first select the category based on $_GET['cat_id'] -copied from category.php,,,
// WHERE
           // cat_id = " . mysqli_real_escape_string($conn, $_GET['id'])
$sql = "SELECT
topic_id,
topic_subject
FROM
topics
WHERE
topics.topic_id = ". mysqli_real_escape_string($conn,$_GET['id']);
// . mysqli_real_escape_string($conn,$_GET['id']);   
 
$result = mysqli_query($conn, $sql);
 
if(!$result)
{
    echo 'The Topics could not be displayed, please try again later.' . mysqli_error($conn);
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'This Topics does not exist.';
    }
    else
    {
        //display topics data
        while($row = mysqli_fetch_assoc($result))
        {
            echo '<h2>Topics in ′' . $row['topic_subject'] . '′ </h2>';
        }
     

        $sql = "SELECT
        posts.post_topic,
        posts.post_content,
        posts.post_date,
        posts.post_by,
        posts.post_id,
        users.user_id,
        users.user_name
    FROM
        posts
    LEFT JOIN
        users
    ON
        posts.post_by = users.user_id
    WHERE
        posts.post_topic = " 
        . mysqli_real_escape_string($conn,$_GET['id']);
         
        $result = mysqli_query($conn, $sql);
         
        if(!$result)
        {
            echo 'The posts could not be displayed, please try again later.';
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
                echo '<table border="1">
                      <tr>
                        <th>Topic</th>
                        <th>Created at</th>
                      </tr>'; 
                     
                while($row = mysqli_fetch_assoc($result))
                {               
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h3><a href="topic.php?id=' . $row['post_id'] . '">' . $row['post_content'] . '</a><h3>';
                        echo '</td>';
                        echo '<td class="rightpart">';
                            echo date('d-m-Y', strtotime($row['post_date']));
                        echo '</td>';
                    echo '</tr>';
                }
            }
        }
    }
}
 
include 'footer.php';
?>