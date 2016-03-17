<?php
	
	session_start();
	$error = "";		



	if(array_key_exists("submit", $_POST)){
	
		$link=mysqli_connect("localhost", "cl54-secretdi", "NqUq^/bhe", "cl54-secretdi");
	
		if(mysqli_connect_error()){
			die("database connect error");
		}

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
// 				//failed to refactor 01
// 				$userEmail = mysqli_real_escape_string($link, $_POST['email']);
// 				$userPassword = mysqli_real_escape_string($link, $_POST['password']);
				
				//failed to refactor 02
				// $query = "insert into users(email, password) values(
// 					'.mysqli_real_escape_string($link, $_POST['email']).',
// 					'.mysqli_real_escape_string($link, $_POST['password']).'
// 				)";

				$query = "insert into users(email, password) values(
					'".mysqli_real_escape_string($link, $_POST['email'])."',
					'".mysqli_real_escape_string($link, $_POST['password'])."'
				)";
				
				if(!mysqli_query($link, $query)){
					$error = "<p>Could not sign you up.</p>";
				}else{
				
 					
					$query = "update users set password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' where id=".mysqli_insert_id($link)." limit 1";
					
					mysqli_query($link, $query);
					$_SESSION['id'] = mysqli_insert_id($link);
					
					//stayLoggedIn is the name of checkbox on the page, value 1 is the checkbox's default value
					if($_POST['stayLoggedIn'] == 1){
						setcookie("id", mysqli_insert_id($link), time()+60*60*24*3);
					}
					// echo "sign up successful";
					
					header("location: loggedinpage.php");
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