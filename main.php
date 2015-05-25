<?php 


session_start();
require_once("new_connection.php");
	
function user_queryb($user)
{
	$query = "SELECT first_name FROM users WHERE id='$user'";
	$result = fetch_record($query);
	echo "<strong>" . $result["first_name"] . "</strong>";
}

function user_query($user)
{
	$query = "SELECT first_name FROM users WHERE id='$user'";
	$result = fetch_record($query);
	echo "<span class=left>" . $result["first_name"] . "</span>";
}




function comment_form($input)
{
	echo '<br>
			<div class="row">
				  <div class="one column"></div>
	    			<div class="eleven columns" class="u-pull-right">
					<form  method="post" action="process.php">  
						<label>Post new Comment</label>
						<textarea class="u-full-width" name="add_comment" type="text"></textarea>
						<input name="new_comment" type="hidden" value="yes"> 
						<input name="this_message_id" type="hidden" value="' . $input . '"> 
						<input  class="u-pull-right" type="submit" value="Post a Comment">
					</form>
				</div>
			</div>';
}

 ?>



<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title></title>
  <meta name="description" content="">
  <meta name="author" content="Arash Namvar">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="">

</head>
<body>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<div class="container">
	    <div class="row">
	    	<div class="seven columns"><h4>The Wall</h4></div>	
	    	<div class="three columns"><p>Welcome <?= user_query($_SESSION["user_id"])?></p></div>
	    	<div class="two columns"><a href="process.php">logoff</a></div>
		</div>

		<div class="row">
			<div class="twelve columns">
				<form method="post" action="process.php">  
					<h6>Post new Message</h6>
					<textarea class="twelve columns" name="add_message" type="text"></textarea>
					<input name="new_message" type="hidden" value="yes"> 
				       	<input class="u-pull-right" type="submit" value="Post a Message">
				</form>
			</div>
		</div>

 <?php 
$messages_query = "SELECT * FROM messages";
$messages = fetch_all($messages_query);
$comments_query = "SELECT * FROM comments";
$comments = fetch_all($comments_query);
$messages_reverse = array_reverse($messages);

foreach ($messages_reverse  as $key => $message) {
	echo user_queryb($message["users_id"]) . " " . $message["created_at"] . "<br>" . $message["message"] . " " . "<br><br>";
	foreach ($comments as $comment) {
		if($messages_reverse [$key]["id"] == $comment["messages_id"])
		{
		echo user_query($comment["users_id"]) . " " . $comment["created_at"] . "<br>" . "<span class=left>" . $comment["comment"] . "<span>" . " "   . "<br>";
		}
	}
	comment_form($messages_reverse[$key]["id"]);
}
	?>

	</div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>