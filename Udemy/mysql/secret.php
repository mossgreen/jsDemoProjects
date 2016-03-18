<?php
	
	session_start();
	$error = "";		
	
	if(array_key_exists("logout", $_GET)){
		unset($_SESSION);
		setcookie("id", "", time()-60*60);
		$_COOKIE["id"] = "";
		
	}else if((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])){
		header("Location: loggedinpage.php");
	}


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
		
			if($_POST['signUp']){
				
			
		
			$query = "select id from users where email = '".mysqli_real_escape_string($link, $_POST['email'])."' limit 1";
			$result = mysqli_query($link, $query);
			
			if(mysqli_num_rows($result) > 0){
				$error = "That email address is taken.";
			}else{

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
			}// end of signUp 
			else{
// 				echo "logging in...";
// 				print_r($_POST);
				$query = "select * from users where email ='".mysqli_real_escape_string($link, $_POST['email'])."'";
				$result = mysqli_query($link, $query);
				$row = mysqli_fetch_array($result);
				if(isset($row)){
					$hashedPassword = md5(md5($row['id']).$_POST['password']);
					if($hashedPassword == $row['password']){
						$_SESSION['id'] = $row['id'];
						
						if($_POST['stayLoggedIn'] == '1'){
							setcookie("id", $row['id'], time()+60*60*24*3);
							
						}
						header("Location: loggedinpage.php");
					}else{
						$error = "that email/passowrd combination could not be found.";

					}
				}else{
					$error = "that email/passowrd combination could not be found.";
				}
			}
		}
	}


?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
  
  		<style type="text/css">
  		
  		.container{
  			text-align:center;
  			width: 480px;
  		}
  		
  		
  		</style>
  
  
  
  
  
  
  
  
  </head>
  <body>
  
  	<div class="container">
  	
  		<h1>Secret Diary</h1>
  	
  	
		<div id="error"><?php echo $error; ?></div>
		<form method="post">
			<fieldset class="form-group">
				<input class="form-control" type="email" name="email" placeholder="Your Email" />
			</fieldset>
			<fieldset class="form-group">	
				<input class="form-control" type="password" name="password" placeholder="Password" />
			</fieldset>
			
			
			<div class="checkbox">
				<label>
					<input type="checkbox"  name="stayLoggedIn" value=1>  stay logged in
				</label>
			</div>
			
			
			<fieldset class="form-group">
				<input type="hidden" name="signUp" value="1" />
				<input class="btn btn-success" type="submit" name="submit" value="sign up" />
			</fieldset>
		</form>
		<form method="post">
			<fieldset class="form-group">
				<input class="form-control" type="email" name="email" placeholder="Your Email" />
			</fieldset>
			<fieldset class="form-group">
				<input class="form-control" type="password" name="password" placeholder="Password" />
			</fieldset>

			<div class="checkbox">
				<label>
					<input type="checkbox"  name="stayLoggedIn" value=1>  stay logged in
				</label>
			</div>
			
			<fieldset class="form-group">
				<input type="hidden" name="signUp" value="0" />
			</fieldset>
			<fieldset class="form-group">
				<input class="btn btn-success" type="submit" name="submit" value="log in" />
			</fieldset>
		</form>
	</div>
	
	
	
    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
  </body>
</html>





