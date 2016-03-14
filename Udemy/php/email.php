<?php

/*
what i learnt in this project:
1. serverside validation, php has its own email validation:
	filter_var($_POST['email'], FILTER_VALIDATE_EMAIL

2. send a email on a page:
	
	$sent = mail("unfeifei@gmail.com", "Comment from website!", "Name: ".$_POST["name"]
			."Email: ".$_POST["email"]."
			Comment: ".$_POST["comment"]
		);
3. store value, or say data, in the page after submiting to server is to add a value to the input
	and add a slice of php code like:
	
	<input type="text" name="email" class="from-control" placeholder="your name" value="<?php echo $_POST['email']; ?>" />
	
		


*/

	if($_POST["submit"]){
		//$result="Form submitted";
		$result = '<div class="alert alert-success">Form submitted</div>';
	}
	
	if(!$_POST["name"]){
	
		$error.= "<br />name";
	}

	//if(!$_POST["email"]){
	
	//	$error.= "<br />email";
	//}

	if(!$_POST["comment"]){
	
		$error.= "<br />comment";
	}
	
	//validate the email address: if it's entered AND validated
	if($_POST['email'] == "" OR !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$error.="<br />please enter a valid email address.";
	}
	
	$sent = mail("unfeifei@gmail.com", "Comment from website!", "Name: ".$_POST["name"]
			."Email: ".$_POST["email"]."
			Comment: ".$_POST["comment"]
		);
	
	
	if($error){

		$result = '<div class="alert alert-danger"><strong>Error, please check: '.$error.'</strong></div>';
	}else{
	
		if($sent){ 
			$result = '<div class="alert alert-success"><strong>Thanks</strong></div>';
		}else{
			$result =  '<div class="alert alert-success"><strong>Sorry, try again later.</strong></div>';
		}

	}
?>







<!DOCTYPE html>
<html>
<head>
	<title>Learn to php</title>
	
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<style>
	.emailForm{
		border:1px solid grey;
		border-radius: 10px;
		margin-top:20px;
	}
	
	textarea{
		height:120px;
	}
	
	form{
		padding-bottom: 20px;
	}

</style>

</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 emailForm">
				<h1>My eMail Form</h1>
				
				<?php echo $result ?>				
				<p class="lead">Please get in touch- i'll get back to you as soon as possible."</p>
				
				<form method="post">
					<div class="form-group">
						<label for="name">Your Name:</label>
						<input type="text" name="name" class="from-control" placeholder="your name" value="<?php echo $_POST['name']; ?>" />
					</div>
				
					<div class="form-group">
						<label for="name">Your email:</label>
						<input type="text" name="email" class="from-control" placeholder="your name" value="<?php echo $_POST['email']; ?>" />
					</div>
					
					<div class="form-group">
						<label for="name">Your Comment:</label>
						<textarea class="form-control" name="comment" value="<?php echo $_POST['comment']; ?>"></textarea>
					</div>		
					
					<input type="submit" name="submit" class="btn btn-success btn-lg" value="submit" />			
									
				</form>
			</div>
		</div>
	
	</div>











<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>