<?php 
$database = mysqli_connect('127.0.0.1','root','');

if (!$database) {
	echo "Not Connected To Server";
}
if (!mysqli_select_db($database,'pizzaro')) {
	echo "Database not selected";
}
?>