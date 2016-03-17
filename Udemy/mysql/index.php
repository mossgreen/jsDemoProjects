<?php



	setcookie("customerId", "1234", time() + 60*60*24*5);
	
	//unset cookie in next page
	setcookie("customerId", "", time()-60*60); 
	
	//updata cookie
	$_COOKIE["customerId"] = "test";
	echo $_COOKIE["customerId"];



	session_start();
// 	echo $_SESSION['username']; //remember, SESSION is upper case here

// to test whether can connect to mysql
	if(mysqli_connect_error()){
		die( "error occurs");
	}

if(array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)){
// 	print_r($_POST);


	$link = mysqli_connect("localhost", "cl54-users-4w9", "JFrM7d-d-", "cl54-users-4w9" );

	if( $_POST['email' == '']){
		echo "<p>Email address is required.</p>";
	}else if($_POST['password'] == ''){
		echo "<p>password is required.</p>";
	}else{
		$query = "select id from users where email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
		$result = mysqli_query($link, $query);
		
		if(mysqli_num_rows($result) > 0){
			echo "<p>this email address has been taken.</p>";
		}else{
		
		//dont know why it's not working????
// 			$userEmail= ".mysqli_real_escape_string($link, $_POST['email']).";
// 			$userPassword = ".mysql_real_escape_string($link, $_POST['password']).";
// 			$query="insert into users (email, password) values ('".$userEmail."', '".$userPassword."')";
			$query = "insert into users (email, password) values('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysql_real_escape_string($link, $_POST['password'])."')";
			
			if(mysqli_query($link, $query)){
// 				echo "<p>you have signed up.</p>";
				
				$_SESSION['email'] = $_POST['email'];
				header("Location: session.php");
			}else{
				echo "<p>got a problem.</p>";
			}
		}
	}
}
//will print error message on the page since the localhoste is a typo
//mysqli_connect("localhoste", "cl54-users-4w9", "JFrM7d-d-");
//echo mysqli_connect_error();



//add new users in database, however now is right, notice the space and '' below
// $query = "insert into users (email, password) values ('adadf', 'youare@good')";


//write limit in the end is best practice, it will limit the row that will be updated
// $query = "update users set email = 'moss@moss.moss' where id = 1 limit 1";
//$query = "update users set password = 'hahamoss' where email = 'moss@moss.moss' limit 1";

// mysqli_query($link, $query);

// $query = "SELECT * FROM users";
// $query = "select * from users where email like '%moss.moss' ";
// 	$query = "select * from users where email like '%mo%'";
// $query = "select * from users where id <=3";
// $query = "select email from users";
// 	$query = "select email from users where id <= 2 and email like '%m%'";
// 	$name = "moss O's";
// 	$query = "select * from users where name = '".mysqli_real_escape_string($link, $name)."' ";
// 	
	
	
// if($result = mysqli_query($link, $query)){
// 	while($row = mysqli_fetch_array($result)){
// 	print_r($row);
// 	}
// 	print_r($row);
// echo "your email is ".$row['email']."<br /> and your password is ".$row['password'];
// echo "your email is ".$row[1]."<br /> and your password is ".$row[2];

// }

?>


<form method = "post">
	<input name="email" type="text"  placeholder="email address" />
	<input name="password" type="password" placeholder="password" />
	<button type="submit value="sign up" >sign up</button>
	



</form>