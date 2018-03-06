<?php
include 'connect.php';
include 'header.php';

//first select the topic based on $_GET['topic_id']
$sql = "SELECT
    topic_id,
    topic_subject
FROM
    topics
WHERE
    topics.topic_id = " . mysql_real_escape_string($_GET['id']);
 
$result = mysql_query($sql);

if(!$result)
{
    echo 'The topic could not be displayed, please try again later.' . mysql_error();
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'This topic does not exist.';
    }
    else
    {
        //display topic data
 //       while($row = mysql_fetch_assoc($result))
 //       {
 //           echo '<h2>Posts in ′' . $row['topic_subject'] . '′ </h2>';
 //       }
     
        //do a query for the topics
        $sql = "SELECT
    			posts.post_topic,
    			posts.post_content,
    			posts.post_date,
    			posts.post_by,
    			users.user_id,
    			users.user_name
			FROM
    			posts
			LEFT JOIN
    			users
			ON
    			posts.post_by = users.user_id
			WHERE
    			posts.post_topic = " . mysql_real_escape_string($_GET['id']);
         
        $result = mysql_query($sql);
         
        if(!$result)
        {
            echo 'The posts could not be displayed, please try again later.';
        }
        else
        {
            if(mysql_num_rows($result) == 0)
            {
                echo 'There are no posts in this topic yet.';
            }
            else
            {
 			
                //prepare the table
                echo '<table border="1">
                      <tr>
                        <th colspan="2">' . 'Post Topic goes here!' . '</th>
                      </tr>'; 
                     
                while($row = mysql_fetch_assoc($result))
                {               
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo  $row['post_date'] . ' by ' . $row ['user_name'] ;
                        echo '</td>';
                        echo '<td class="rightpart">';
                            echo $row['post_content'];
                        echo '</td>';
                    echo '</tr>';
                }
            echo'<tr><td colspan = "2">';
					echo '<h2>Reply:</h2>';
					echo '<form  method="post" >';
					echo '<p> <textarea name="reply-content" rows="10" cols="50">Post your comment here</textarea </p>';
					echo '<p><input type="submit" id="postreply" name="postreply" value="Post Reply"></p>';   
					echo '</form>';
			echo'</td></tr>';

            }
        }
    }
}
 
 
    if(isset($_POST['postreply'])) {
        onFunc();
    }


    function onFunc(){
        //echo "Button on Clicked";
        
		//a real user posted a real reply
        $sql2 = "INSERT INTO 
                    posts(post_content,
                          post_date,
                          post_topic,
                          post_by) 
                VALUES ('" . $_POST['reply-content'] . "',
                        NOW(),
                        " . mysql_real_escape_string($_GET['id']) . ",
                        " . $_SESSION['user_id'] . ")";
                         
        $result = mysql_query($sql2);
                         
        if(!$result)
        {
            echo 'Your reply has not been saved, please try again later.';
        }
        else
        {
            echo 'Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
        }
        
    }
 

include 'footer.php'
?>