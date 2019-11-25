
<?php
	extract($_GET);

	$connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,"foodies") or die("couldn't find database");
	$id = intval($_GET['id']);
	$sql = "SELECT * FROM food WHERE id = $id";
	$res = mysqli_query($connection,$sql);
	$res_array = mysqli_fetch_assoc($res);
	echo json_encode($res_array);
?>