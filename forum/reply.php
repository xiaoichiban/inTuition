
<link rel="stylesheet" type="text/css" href="main.css"/>
<!DOCTYPE html>
<html>
    <head>
        <title>Reply</title>
        <link rel="shortcut icon" type="image/x-icon" href="../lightbulb.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            * {
                box-sizing: border-box;
            }
            @media screen and (max-width:600px) {
                .column {
                    width: 100%;
                }
            }
            body {
                font-family: Old Standard;
                color: black;
                margin: 0;
            }

            /* Style the header */
            .header {
                background-color: #f1f1f1;
                padding: 5px;
                text-align: center;
            }

            .column {
                float: left;
                width: 33.33%;
                padding: 15px;
            }
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            .column {
                float: left;
                width: 25%;
                padding: 15px;
            }

            .columnright {
                float: left;
                width: 75%;
                padding: 15px;
            }
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            /* Style the top navigation bar */
            .topnav {
                overflow: hidden;
                background-color: #333;
                text-align: center;
                display: flex;
                justify-content: space-around;
                padding-left: 150px;
                padding-right: 150px;
            }

            /* Style the topnav links */
            .topnav a {
                float: left;
                display: block;
                color: #f2f2f2;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                width:150px;
            }

            /* Change color on hover */
            .topnav a:hover {
                background-color: #ddd;
                color: black;
            }

            .dropdown {
                float: left;
                overflow: hidden;
            }

            .dropdown .dropbtn {
                font-size: 16px;
                border: none;
                outline: none;
                color: white;
                padding: 14px 16px;
                background-color: inherit;
                font-family: inherit;
                margin: 0;
                width:150px;
            }

            .navbar a:hover, .dropdown:hover .dropbtn {
                background-color: bisque;
                color: black;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            .dropdown-content a {
                float: none;
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                text-align: left;
            }

            .dropdown-content a:hover {
                background-color: #ddd;
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }

            .imagecontainer {
                position:absolute;
                bottom:0;
            }
        </style>
    </head>



    <body>

        <div class="topnav">
            <b><a href = "welcome.php">Home</a></b>
            <b><a href = "myprofile.php">My Profile</a></b>
            <div class="dropdown">
                <button class="dropbtn"><b>Social</b>
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <b><a href = "forum.php">Forum</a></b>
                    <b><a href = "inbox.php">Chat</a></b>
                    <b><a href = "new_conversation.php">New Chat</a></b>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn"><b>Search</b>
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <b><a href = "searchUser.php">User</a></b>
                    <b><a href = "searchtasks.php">All Tasks </a></b>
                    <b><a href = "searchGeneralTask.php">Search By Name/Description</a></b>
                    <b><a href = "searchTags.php">Search By Tags</a></b>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn"><b>My Tasks</b>
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <b><a href = "taskcreateform.php">Create Tasks</a></b>
                    <b><a href = "mytasks.php">My Tasks</a></b>
                    <b><a href = "viewbidtask.php">My Bid Tasks</a></b>
                </div>
            </div>
            <b><a href = "report.php">Report Problem</a></b>
            <b><a href = "logout.php">Sign Out</a></b>
        </div>
        <br/>
        <div class="row"> </div>


<?php
include("config.php");
include("session.php");
include("user.inc.php");
include('private_message_inc.php');

if(isset($_GET['receiver'])){
	//echo "TO: ",$_GET['receiver'];
	$to=$_GET['receiver'];
}

if(isset($_GET['receiver'])){
	//echo "sub: ",$_GET['subject'];
	$subj=$_GET['subject'];
}

if(isset($_POST['to'],$_POST['subject'],$_POST['body'])){
	$errors = array();

	if(empty($_POST['to'])){
		$errors[] = '<div class="error">You must enter at least one name.</div><br>';
	}
	//else if(preg_match('#^[a-z, ]+$#i', $_POST['to']) === 0){
	//	$errors[] = '<div class="error">The list of names you gave does not look valid.</div><br>';
	//}// ^ start of string $ end of string
	else{
		$user_name = explode(',', $_POST['to']);

		foreach ($user_name as &$name) {
			$name = trim($name);
			if($name == $login_session){
				$errors[]= '<div class="error">You cannot send message to yourself.</div>';
			}
		}

		$users = fetch_user_names($user_name);
		if (count($users) !== count($user_name)){
			$errors[]='<div class="error">The following users could not be found: '.implode(', ',array_diff($user_name,$users)).'</div><br>';

		}
	}
	if(empty($_POST['subject'])){
		$errors[] = '<div class="error">The subject cannot be empty.</div><br>';
	}
	if(empty($_POST['body'])){
		$errors[] = '<div class="error">The body cannot be empty.</div><br>';
	}

	if(empty($errors)){

	//echo 'subjuct',$_POST['subject'];
	//echo 'body',$_POST['body'];

		create_conversation(array_unique($users),$_POST['subject'],$_POST['body'],$login_session);

	}
}
if(isset($errors)){
	if(empty($errors)){
		echo "Message Sent. <a href=\"Welcome.php\">Return to Main Page</a>";

	}else{
		foreach($errors as $error){
			echo $error;
		}
	}

}
?>
<div class="header">
<th>Reply</th></div>
<form action="" method="post">
	<div class="to msg">
		<label for="to"><br>To<br></label>
		<input type="text" name="to" id="to" value="<?php echo $to; ?><?php if(isset($_POST['to'])) echo htmlentities($_POST['to']); ?>"/>
	</div>
	<div class="subject msg">
		<label for="subject">Subject<br></label>
		<input type="text" name="subject" id="subject" value=" <?php echo $subj ?><?php if(isset($_POST['subject'])) echo htmlentities($_POST['subject']); ?>"/>
	</div>
	<div class="body">
		<textarea name="body" rows="20" cols="110"><?php if(isset($_POST['body'])) echo htmlentities($_POST['body']); ?></textarea>
	</div>
		<br><input type="submit" value="send" id="submit" />
<div class="column">
                <div class ="imagecontainer">
                <img src="taskmaster.png" style="height: 700px; position: absolute;left: 700; top: 50%;margin-top: -480px;">
                </div>
