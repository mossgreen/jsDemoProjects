<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
  
	<body>
		<div>
			<?php
				$emailTo = "";
				$subject = "I hope this works!";
				$body = "I think you're great";
				$headers = "From: rob@robpercival.co.uk";
				
				if(mail($emailTo, $subject, $body, $headers) == 1){
					echo "Mail sent";
				}else{
					echo "Mail failed";
				}
			
  	
  	
  			?>
		</div>
	</body>
</html>





















<?php

echo" --how to define arrays in php--";

echo"<br /><br />";



$myArray = array("pizza", "chocolate", "coffee");

echo $myArray;
echo"<br /><br />";

print_r($myArray);
echo"<br /><br />";


echo $myArray[2];

echo"<br /><br />";

$anotherArray[0] = "pizza";
$anotherArray[2] = "coffee"; //test

print_r($anotherArray);

echo"<br /><br />";

$thirdArray = array(
	"France" => "French",
	"USA" => "English",
	"Germany" => "German"
);

print_r($thirdArray);
echo"<br /><br />";


$anotherArray[] = "salad";
print_r($anotherArray);
echo"<br /><br />";


unset($thirdArray["Germany"]);
print_r($thirdArray);
echo"<br /><br />";


$name="Rob";
unset($name);
echo $name;

echo"<br /><br />";

echo "-- if statement--";
echo"<br /><br />";


$thisNumber = 1;
$thatNumber = 2;
$thirdNumber = 2;
if ($number != $thatNumber AND $thatNumber == $thirdNumber){
	echo "true";
}else{
	echo "false";
}

//will print "true"
echo"<br /><br />";


for($i = 1; $i <= 10; $i++){
	echo $i."<br />";
}
echo"<br /><br />";

$array = array("cat", "dog", "turtle", "kangoroo");
print_r($array);
echo"<br /><br />";
foreach($array as $key =>$value){
	echo "Key: $key Value: $value <br />";
}
echo"<br /><br />";


$i = 0;
$array = array("apple", "banana", "grape");
while($array[$i]){
	echo $array[$i]." <br />";
	
	echo" Key: $i Value: $array[$i] <br />";	
	$i ++;
}

?>

