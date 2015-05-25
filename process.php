<?php
session_start();
require_once("new_connection.php");

if(isset($_POST["register"]) && $_POST["register"] == "yes")
{
	user_registration($_POST);
}
elseif(isset($_POST["login"]) && $_POST["login"] == "yes")
{
	login_user($_POST);
}
elseif(isset($_POST["new_message"]) && $_POST["new_message"] == "yes" )
{
	post_message($_POST);
}
elseif(isset($_POST["new_comment"]) && $_POST["new_comment"] == "yes" )
{
	post_comment($_POST);
}
else 
{
	session_destroy();
	header("location:index.php");
	die();
}


function user_registration($post)
{	
	$_SESSION["errors"]=array();
	if(empty($post["first_name"]))
	{
		$_SESSION["errors"][] = "Please submit first name";
	}
	if(empty($post["last_name"]))
	{
		$_SESSION["errors"][] = "Please submit last name";
	}
	if(!filter_var($post["email"], FILTER_VALIDATE_EMAIL))
	{
		$_SESSION["errors"][] = "Please submit valid email";
	}
	if($post["password"] !== $post["confirm_password"])
	{
		$_SESSION["errors"][] = "Passwords don't match!";
	}
	if(count($_SESSION["errors"]) > 0)
	{
		header("location:index.php");
		die();
	}
	else
	{
		$first_name = escape_this_string($_POST["first_name"]);
		$last_name = escape_this_string($_POST["last_name"]);
		$password = escape_this_string(md5($_POST["password"]));
		$email = escape_this_string($_POST["email"]);
		$query = "INSERT INTO USERS (first_name, last_name, email, password, created_at, updated_at) VALUES ('{$first_name}', '{$last_name}', '{$email}', '{$password}', now(), now())";
		run_mysql_query($query);
		$query1 = "SELECT * FROM USERS WHERE users.password = '{$password}' AND users.email = '{$email}'";
		$user = fetch_all($query1);
		$_SESSION["user_id"] = $user[0]["id"];
		$_SESSION["first_name"] = $user[0]["first_name"];
		$_SESSION["logged_in"] = TRUE;
		header("location:main.php");
		die();
	}
}


function login_user($post)
{	
	$email = escape_this_string($post["email"]);
	$password = escape_this_string(md5($post["password"]));
	$query = "SELECT * FROM USERS WHERE users.password = '{$password}' AND users.email = '{$email}'";
	$user = fetch_all($query);
	
	if(count($user) > 0)
	{
		$_SESSION["user_id"] = $user[0]["id"];
		$_SESSION["first_name"] = $user[0]["first_name"];
		$_SESSION["logged_in"] = TRUE;
		header("location:main.php");
		die();
	}
	else
	{
		$_SESSION["errors"][]= "Username or Password incorrect";
		header("location:index.php");
		die();
	}
}

function post_message($post)
{
	$message = escape_this_string($post["add_message"]);
	$query = "INSERT INTO messages (users_id, message, created_at, updated_at) VALUES ('{$_SESSION['user_id']}', '{$message}', now(), now())";
	run_mysql_query($query);
	header("location:main.php");
}


function post_comment($post)
{
	$comment = escape_this_string($post["add_comment"]);
	$query = "INSERT INTO comments (comment, created_at, updated_at, messages_id, users_id) VALUES ('{$post['add_comment']}', now(), now(), '{$post['this_message_id']}', '{$_SESSION['user_id']}')";
	run_mysql_query($query);
	// echo $query;
	header("location:main.php");
}
?>