<?php

//will print error message on the page since the localhoste is a typo
//mysqli_connect("localhoste", "cl54-users-4w9", "JFrM7d-d-");
//echo mysqli_connect_error();

$link = mysqli_connect("localhost", "cl54-users-4w9", "JFrM7d-d-", "cl54-users-4w9" );

if(mysqli_connect_error()){
	die( "error occurs");
}

$query = "SELECT * FROM users";

if($result = mysqli_query($link, $query)){
	$row = mysqli_fetch_array($result);
// 	print_r($row);
echo "your email is ".$row['email']."<br /> and your password is ".$row['password'];
// echo "your email is ".$row[1]."<br /> and your password is ".$row[2];

}

?>