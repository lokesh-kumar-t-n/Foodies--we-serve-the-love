<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "foodies";
	// Create connection
	/*
	$conn = new mysqli($servername, $username, $password);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	// Create database
	$sql = "CREATE DATABASE foodies";
	if ($conn->query($sql) === TRUE) {
	    echo "Database created successfully";
	} 
	else {
	    echo "Error creating database: " . $conn->error;
	}
	$conn->close();

	$database = "foodies";
	$conn = new mysqli($servername,$username,$password,$database);
	$sql = "Create table user (fname varchar(20),
				lname varchar(20),
				location varchar(30),
				mobile int,
				address varchar(100),
				email varchar(20),
				password varchar(20),
				cpassword varchar(20))";
	if ($conn->query($sql) === TRUE){
		echo "User table created successfully";
	}
	else{
		echo "Error creating User table: ". $conn->error;
	}
	
	$database = "foodies";
	$conn = new mysqli($server,$username,$password,$database);
	$sql = "Create table php_users_login(
				email varchar(20),
				password varchar(20))";
	if ($conn->query($sql) === TRUE){
		echo "php_users_login table created successfully";
	}
	else{
		echo "Error creating php_users_login table ".$conn->error;
	}
	$conn->close();
	
	$conn = new mysqli($servername,$username,$password,$database);
	$sql = "Create table orders(
				email varchar(20),
				qty1 int,
				qty2 int,
				qty3 int,
				qty4 int,
				qty5 int,
				qty6 int,
				qty7 int,
				qty8 int,
				qty9 int)";
	if($conn->query($sql) === TRUE){
		echo "orders talbe created";
	}
	else{
		echo "Error while creating orders table ".$conn->error;
	}
	$conn->close();
	*/
	$conn = new mysqli($servername,$username,$password,$database);
	$sql = "Create table food(
				id varchar(10),
				name varchar(30),
				image blob,
				price int)";
	if($conn->query($sql) === TRUE){
		echo "food table created";
	}
	else{
		echo "Error while creating orders table ".$conn->error;
	}
	$conn->close();
?>