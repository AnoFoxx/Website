<?php 

	$connect=mysqli_connect("localhost","HAttila","5e{G6;^3@Wu(","ChillOut");
	mysqli_set_charset($connect,"utf8");

	if ($connect -> connect_errno) {
  		echo "Failed to connect to MySQL: " . $connect -> connect_error;
  		exit();
	}
	$sql="Insert into person"
?>