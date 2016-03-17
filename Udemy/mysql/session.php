<?php

session_start();
// $_SESSION["username"] = "haha";
// echo $_SESSION['username'];

if($_SESSION['email']){
	echo "You are logged in.";
}else{
	header("Location: index.php");
}


?>