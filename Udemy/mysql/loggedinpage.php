<?php
	session_start();
	if(array_key_exists("id", $_COOKIE)){
		$_SESSION['id'] = $_COOKIE['id'];
	}
	
	if(array_key_exists("id", $_SESSION)){
		echo "<p>logged in! <a href='secret.php?logout=1'>Log out</a></p>";
	}else{
		header("Location: secret.php");
	}

	include("header.php");
	
?>
	
	<div class="container-fluid">
		<textarea id="diary" class="form-control" ></textarea>
	
	
	
	
	
	</div>
	
<?php
	
	include("footer.php");


?>