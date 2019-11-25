<?php
session_start();
error_reporting(0);
//var_dump($_POST); 
include("config.php");

if(isset($_POST[''])) {
	if(isset($_SESSION['user_info']) && is_array($_SESSION['user_info']))	{
	 	$_SESSION['check']='1';
	}
}
else{
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login Form</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/main.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500' rel='stylesheet' type='text/css'>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="js/jquery-1.8.2.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/main.js"></script>
		<style type="text/css">
		a:link {color: #ffffff}
		a:visited {color: #ffffff}
		a:hover {color: #ffffff}
		a:active {color: #ffffff}
		</style>
		<script type="text/javascript">
			function logout(){
				alert("in logout");
				window.location.replace("http://localhost/Foodies/logout");
			}
		</script>
    </head>
    <body>
	
<?php
	$error = '';
	if(isset($_POST['is_login'])){
		//echo "set is_login";
		$sql = "SELECT * FROM ".$SETTINGS["USERS"]." WHERE email = '".mysqli_real_escape_string($connection,$_POST['email'])."' AND password = '".mysqli_real_escape_string($connection,$_POST['password'])."'";
		//echo "after sql query";
		//echo "connection is :";
		//var_dump($connection);
		$sql_result = mysqli_query ($connection,$sql ) or die ('request "Could not execute SQL query" '.$sql);
		$user = mysqli_fetch_assoc($sql_result);
		//echo "I came here";
		if(!empty($user)){
			//echo "correct";
			$_SESSION['user_info'] = $user['email'];
			$sql1 = "SELECT * FROM user WHERE email = '".mysqli_real_escape_string($connection,$_POST['email'])."'";
			$sql1_result = mysqli_query($connection, $sql1) or die ('request "Could not execute SQL query" '.$sql);
			$user = mysqli_fetch_assoc($sql1_result);
			$_SESSION['user_name'] = $user['fname'];
		}
		else{
			//echo "wrong";
			$error = 'Wrong email or password.';
		}
	}
	else{
		//echo "unset is_login";
	}
	if(isset($_GET['ac']) && $_GET['ac'] == 'logout'){
		//echo "loging out";
		$_SESSION['user_info'] = null;
		unset($_SESSION['user_info']);
		//echo "user_info deleted";
	}
?>
<?php include("header.php"); ?>
<?php if(isset($_SESSION['user_info']))	{
	//echo "under user_info";
$_SESSION['userName'] = 'Root';		$_COOKIE['varname'] = 9;	?>
	    <form id="login-form" class="login-form" name="form1" method="post" action="index.php">

	        <div id="form-content">
	            <div class="welcome">
					<?php $name = $_SESSION['user_name'];
						  echo "Welcome ".$name."&nbsp&nbsp&nbsp";
						  echo "<script> console.log($name); </script>"; 
						  //var_dump($_SESSION);
					?>
                    <br />
					Thank you for choosing us. We bring to you the best of the food at your door step.
					We deliver food from a wide range of desserts, starters, fillers and so on. You name it, we have it
					<br />
					Order now and avail your favourite food at exciting prices.
					<center><a href="findCalories" style="color:#32c038"> Find calories of food</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="order" style="color:#3ec038">Place an order</a></center>
					<center><a href="changepw" style="color:#3ec038">Change password</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="deact" style="color:#3ec038">Deactivate your account</a></center><br /><br/>
					<!--<section align="right"><a href="logout" style="color:#3ec038">Logout</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</section>-->
				</div>	
	        </div>
	    </form>
	<?php } else { ?>
	    <form id="login-form" class="login-form" name="form1" method="post" action="login">
	    	<input type="hidden" name="is_login" value="1">
	        <div class="h1">Login</div>
	        <div id="form-content">
	            <div class="group">
	                <label for="email">Email</label>
	                <div><input id="email" name="email" class="form-control required" type="email" placeholder="Email"></div>
	            </div>
	           <div class="group">
	                <label for="name">Password</label>
	                <div><input id="password" name="password" class="form-control required" type="password" placeholder="Password"></div>
	            </div>
	            <?php if($error) { ?>
	                <em>
						<label class="err" for="password" generated="true" style="display: block;"><?php echo $error ?></label>
					</em>
				<?php } ?>
	            <div class="group submit">
	                <label class="empty"></label>
	                <div><input name="submit" type="submit" value="Submit"/></div>
	            </div>
	        </div>
	        <div id="form-loading" class="hide"><i class="fa fa-circle-o-notch fa-spin"></i></div>
	    </form>
	<?php } ?>   
    </body>
</html>