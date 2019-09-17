<!DOCTYPE html>
<html>
    <head>
        <title>Task Feedback</title>
    </head>
    <body>
        <?php
        include('session.php');
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $task_id=$_GET['task_id'];
        $thisuser = $_SESSION['login_user'];
        $sqlquery = mysqli_query("SELECT * FROM task WHERE task_id = $task_id;");
        $row = mysqli_fetch_row($sqlquery);
        $creator = $row[1];
        
        //if user is creator
        if ($creator == $thisuser)
        {
            echo "Kindly leave some feedback for your tasker(s)!";
            echo "<br>";
            $result = mysqli_query("SELECT * FROM bid WHERE task_id =$task_id AND is_winning_bid = 'true';");
            if(mysqli_num_rows($result)>0)
            {
                echo "<table style='width:100%' border='1'>";
                $num = mysqli_num_rows($result);
                $count = 1;
                while($row = mysqli_fetch_row($result)) {
                    
                    $rating_id = "rating" . "$row[1]";
                    $feedback_id = "feedback" . "$row[1]";
                    
                    if ($num == 1) //only one tasker
                    {
                        echo "<tr><th>Tasker " . $count . ": " . $row[1] . "</th></tr>";
                        echo "<tr><th><form action='feedback_processing.php?task_id=$task_id' method='post' enctype='multipart/form-data'>"
                        . "Rating (Integer From 1 [poor] to 5 [great]):"
                        . "<input type='number' name='$rating_id' min='1' max='5' id='$rating_id' required>"
                        . "Feedback:"
                        . "<input type='text' name='$feedback_id' id='$feedback_id'></th></tr>"
                        . "<tr><th><input type='submit' value='Submit' name='submit' required></form></th></tr></table>";
                    }
                    
                    else if($count == 1) //first tasker
                    {
                        echo "<tr><th>Tasker " . $count . ": " . $row[1] . "</th></tr>";
                        echo "<tr><th><form action='feedback_processing.php?task_id=$task_id' method='post' enctype='multipart/form-data'>"
                        . "Rating (Integer From 1 [poor] to 5 [great]):"
                        . "<input type='number' name='$rating_id' min='1' max='5' id='$rating_id' required>"
                        . "Feedback:"
                        . "<input type='text' name='$feedback_id' id='$feedback_id' required></th></tr>";
                        $count++;
                    }
                    
                    else if($count <$num) //not first or last tasker
                    { 
                        echo "<tr><th>Tasker " . $count . ": " . $row[1] . "</th></tr>";
                        echo "<tr><th>Rating (Integer From 1 [poor] to 5 [great]):"
                        . "<input type='number' name='$rating_id' min='1' max='5' id='$rating_id' required>"
                        . "Feedback:"
                        . "<input type='text' name='$feedback_id' id='$feedback_id' required></th></tr>";
                        $count++;
                    }
                    else //last tasker
                    {
                        echo "<tr><th>Tasker " . $count . ": " . $row[1] . "</th></tr>";
                        echo "<tr><th><form action='feedback_processing.php?task_id=$task_id' method='post' enctype='multipart/form-data'>"
                        . "Rating (Integer From 1 [poor] to 5 [great]):"
                        . "<input type='number' name='$rating_id' min='1' max='5' id='$rating_id' required>"
                        . "Feedback:"
                        . "<input type='text' name='$feedback_id' id='$feedback_id' required></th></tr>"
                        . "<tr><th><input type='submit' value='Submit' name='submit'></form></th></tr>";
                        echo "</table>";
                    }               
                }
            }
            
            
        }
        
        //if user is tasker
        else
        {
            $rating_id = "rating" . $thisuser;
            $feedback_id = "feedback" . $thisuser;
            echo "Kindly leave some feedback for your requester!";
            echo "<br>";
            echo "Requester: " . $creator;
            echo "<table style='width:100%' border='1'>";
            echo "<tr><th><form action='feedback_processing.php?task_id=$task_id' method='post' enctype='multipart/form-data'>"
                . "Rating (Integer From 1 [poor] to 5 [great]):"
                . "<input type='number' name='$rating_id' min='1' max='5' id='$rating_id' required></th></tr>"
                . "<tr><th>Feedback:"
                . "<input type='text' name='$feedback_id' id='$feedback_id' required></th></tr>"
                . "<tr><th><input type='submit' value='Submit' name='submit'></form></th></tr>";
            echo "</table>";
            
        }
        
        ?>
    </body>
</html>

