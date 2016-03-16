<?php

//will print error message on the page since the localhoste is a typo
//mysqli_connect("localhoste", "cl54-users-4w9", "JFrM7d-d-");
//echo mysqli_connect_error();

$link = mysqli_connect("localhost", "cl54-users-4w9", "JFrM7d-d-", "cl54-users-4w9" );

if(mysqli_connect_error()){
	die( "error occurs");
}

//add new users in database, however now is right, notice the space and '' below
// $query = "insert into users (email, password) values ('adadf', 'youare@good')";


//write limit in the end is best practice, it will limit the row that will be updated
// $query = "update users set email = 'moss@moss.moss' where id = 1 limit 1";
//$query = "update users set password = 'hahamoss' where email = 'moss@moss.moss' limit 1";

mysqli_query($link, $query);

// $query = "SELECT * FROM users";
// $query = "select * from users where email like '%moss.moss' ";
// 	$query = "select * from users where email like '%mo%'";
// $query = "select * from users where id <=3";
// $query = "select email from users";
// 	$query = "select email from users where id <= 2 and email like '%m%'";
	$name = "moss O's";
	$query = "select * from users where name = '".mysqli_real_escape_string($link, $name)."' ";
	
	
	
if($result = mysqli_query($link, $query)){
	while($row = mysqli_fetch_array($result)){
	print_r($row);
	}
// 	print_r($row);
// echo "your email is ".$row['email']."<br /> and your password is ".$row['password'];
// echo "your email is ".$row[1]."<br /> and your password is ".$row[2];

}

?>