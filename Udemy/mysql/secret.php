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

		 include("");

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

  
  
<?php include("header.php"); ?>
  
  	<div class="container" id="homePageContainer" >
  	
  		<h1>Secret mysql Database</h1>
  		<p><strong>This is a portal page for my website. You can register and log in the database.</strong></p>
  		
  	
  	
		<div id="error"><?php echo $error; ?></div>
		
		
		<form method="post" id="signUpForm">
		
			<p>Sign up, if you have interest.</p>
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
			
			<input type="hidden" name="signUp" value="1" />
			<fieldset class="form-group">
				<input class="btn btn-success" type="submit" name="submit" value="sign up" />
			</fieldset>
			
			<p><a class="toggleForms">Log in</a></p>
		</form>
		
		
		<form method="post" id="logInForm" >
		
			<p>log in, with your username and password.</p>
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
			
			<input type="hidden" name="signUp" value="0" />
			
			<fieldset class="form-group">
				<input class="btn btn-success" type="submit" name="submit" value="log in" />
			</fieldset>
			
			<p><a class="toggleForms">Sign up</a></p>
		</form>
	</div>
	
<?php include("footer.php); ?>


