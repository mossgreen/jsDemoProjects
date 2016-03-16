<?php

//will print error message on the page since the localhoste is a typo
//mysqli_connect("localhoste", "cl54-users-4w9", "JFrM7d-d-");
//echo mysqli_connect_error();

$link = mysqli_connect("localhost", "cl54-users-4w9", "JFrM7d-d-", "cl54-users-4w9" );

if(mysqli_connect_error()){
	die( "error occurs");
}

//add new users in database, however now is right, notice the space and '' below
//$query = "insert into users (email, password) values ('ad fadsf', 'youaregood')";


//write limit in the end is best practice, it will limit the row that will be updated
// $query = "update users set email = 'moss@moss.moss' where id = 1 limit 1";
$query = "update users set password = 'hahamoss' where email = 'moss@moss.moss' limit 1";

mysqli_query($link, $query);

$query = "SELECT * FROM users";

if($result = mysqli_query($link, $query)){
	$row = mysqli_fetch_array($result);
// 	print_r($row);
echo "your email is ".$row['email']."<br /> and your password is ".$row['password'];
// echo "your email is ".$row[1]."<br /> and your password is ".$row[2];

}

?>