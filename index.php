<?php
//index.php
include 'connect.php';
include 'header.php';
 
$sql = "SELECT * FROM categories";
 
$result = mysql_query($sql);


if(!$result)
{
    echo 'The categories could not be displayed, please try again later.';
}

else
{
    if(mysql_num_rows($result) == 0)
    {
        echo 'No categories defined yet.';
    }
    else
    {
        //prepare the table

        echo '<table border="1">
              <tr>
                <th>Category</th>
                <th>Last topic</th>
              </tr>'; 
             
        while($row = mysql_fetch_assoc($result))
        {
        	$sql2 = "SELECT
			topics.topic_cat, 
			topics.topic_id,
			topics.topic_date,
			topics.topic_subject,
			categories.cat_id,
			categories.cat_name
		FROM 
			topics
		LEFT JOIN
			categories
		ON
			topics.topic_cat = categories.cat_id";
		//WHERE
			//topics.topic_cat = " . mysql_real_escape_string($_GET['id']);
        	$result2 = mysql_query($sql2);
			if (!$result2)
			{
				echo "Something went wrong, please try again";
			}
		else
			{
			if (mysql_num_rows($result2) == 0)
			{
				echo 'no topics in this cateory';
			}
			else {
				$row2 = mysql_fetch_assoc($result2);
			    echo '<tr>';
                echo '<td class="leftpart">';
                    echo '<h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
                echo '</td>';
                echo '<td class="rightpart">';
                            echo '<a href="topic.php?id=' . $row2['topic_id'] . '">'. $row2['topic_subject'] . '</a> at ' . $row2['topic_date'];
                echo '</td>';
            	echo '</tr>';
            	}
            }
        }
    }
}

include 'footer.php';
?>