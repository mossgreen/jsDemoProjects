<?php
	if(array_key_exists("submit", $_POST)){
	
		$link=mysqli_connect("localhost", "cl54-secretdi", "NqUq^/bhe", "cl54-secretdi");
	
		if(mysqli_connect_error()){
			die("database connect error");
		}
		$error = "";
		if(!$_POST['email']){
			$error .= "An email address is required.<br />";
		}
		if(!$_POST['password']){
			$error .= "A password is required. <br />";
		}
		
		if($error != ""){
			$error = "<p>There were errors in your form:</p>";
		}else{
		
			$query = "select id from users where email = '".mysqli_real_escape_string($link, $_POST['email'])."' limit 1";
			$result = mysqli_query($link, $query);
			
			if(mysqli_num_rows($result) > 0){
				$error = "That email address is taken.";
			}else{
				// 
// 				//failed to refactor
				$userEmail = mysqli_real_escape_string($link, $_POST['email']);
				$userPassword = mysqli_real_escape_string($link, $_POST['password']);
				
				$query = "insert into users(email, password) values(
					'.mysqli_real_escape_string($link, $_POST['email']).',
					'.mysqli_real_escape_string($link, $_POST['password']).'
				)";

// 				$query = "insert into users(email, password) values(
// 					'".mysqli_real_escape_string($link, $_POST['email'])."',
// 					'".mysqli_real_escape_string($link, $_POST['password'])."'
// 				)";
				
				if(!mysqli_query($link, $query)){
					$error = "<p>Could not sign you up.</p>";
				}else{
				
					echo "sign up successful";
				}
				
			}
		}
	}


?>









<div id="error"><?php echo $error; ?></div>
<form method="post">
	<input type="email" name="email" placeholder="Your Email" />
	<input type="password" name="password" placeholder="Password" />
	<input type="checkbox" name="styleLoggedIn" value=1 />
	<input type="submit" name="submit" value="sign up" />
</form>