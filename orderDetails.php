<?php 
echo "in orderDetails";
$title = 'Order';
include("header.php");
$status = "";
if (isset($_POST['submit'])){
	if(!empty($_SESSION['user_info'])) {

		/*
		$qty1=intval($_POST['qty1']);
		$qty2=intval($_POST['qty2']);
		$qty3=intval($_POST['qty3']);
		$qty4=intval($_POST['qty4']);
		$qty5=intval($_POST['qty5']);
		$qty6=intval($_POST['qty6']);
		$qty7=intval($_POST['qty7']);
		$qty8=intval($_POST['qty8']);
		$qty9=intval($_POST['qty9']);
		*/
		$user_info = $_SESSION['user_info'];
		$connection = mysqli_connect("localhost","root","");
		$db = mysqli_select_db($connection,"foodies") or die("couldn't find database");
		$index = 1;
		$sum = 0;
		$sql1 = "INSERT INTO orders(email,qty1,qty2,qty3,qty4,qty5,qty6,qty7,qty8,qty9,qty10,qty11,qty12,qty13,qty14,qty15,qty16,qty17,qty18,qty19)VALUES('$user_info'";
		while($index < 20){
			if(!isset($_POST['qty'.strval($index)])){
				$sql1 .= ',0';
				$index += 1;
				continue;
			}
			$qty = intval($_POST['qty'.strval($index)]);
			if($qty>0){
				$sql = "SELECT * FROM food where id=$index";
				$res = mysqli_query($connection,$sql);
				$res_query = mysqli_fetch_assoc($res);
				if($res_query){
					$tmp = explode('/', $res_query['price']);
					echo "tmp is ".$tmp[0];
					$p = (int)$tmp[0];
					$sum += $p*$qty;
				}
				else{
					echo "<script> alert('unable to query database'); </script>";
					$status = FALSE;
				}

			}
			$sql1 .=','.strval($qty);
			$index += 1;
		}
		$sql1 .= ");";
		$user_info=$_SESSION['user_info'];
		$msg="Order placed successfully. Please make a payment of Rs ".$sum." by cash on successful delivery";
		
		//$sql1="INSERT INTO orders(email,qty1,qty2,qty3,qty4,qty5,qty6,qty7,qty8,qty9)VALUES('$user_info',$qty1,$qty2,$qty3,$qty4,$qty5,$qty6,$qty7,$qty8,$qty9);";
		//echo $sql1;
		$res = mysqli_query($connection,$sql1);
		//var_dump($res);
		if($res)
		{  
			echo '<script type="text/javascript"> alert("'.$msg.'")</script>';
			$status = TRUE;
		}
		else
		{  
			echo "<script type='text/javascript'>alert('Could not place order');</script>";
			$status = FALSE;
		} 
	}
	else {
		echo "<script type='text/javascript'>alert('Please login');</script>";
		$status = TRUE;
	}
}
if($status == TRUE){
	$query = "select * from orders where email = '".mysqli_real_escape_string($_SESSION['user_info'])."'";
	$res = mysqli_query($connection,$query);
	$res_query = mysqli_fetch_assoc($res);
	var_dump($res_query);
}
?>
<html>
<head>
<style type="text/css">
@import url(style.css);
   a:link {color: #ffffff}
   a:visited {color: #ffffff}
   a:hover {color: #ffffff}
   a:active {color: #ffffff}
  font{color:white}
img{width:300; height:200;}
table{border-color:white;height:90%;}
img{border-color:white}
body{no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;}
</style>
</html>
