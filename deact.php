<html>
<head>
<title>Deactivate account</title>
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
	function check(){
		if(confirm("Once an account is deactivated, it cannot be retrived again. Do you want to deactivate your account?")){
			return true;
		}
		return false;
	}
</script>
</head>
<body>
<?php include("header.php"); ?>
<form id="login-form" class="login-form" name="form1" method="post" action = "deact" onsubmit="return check()">
	        <div id="form-content">
	            <div class="welcome">
					Do you sure you wish to deactivate your account?
					<br />
					Email ID: <input type="text" name="email"><br/>
					Password: <input type="password" name="password"><br/><br/><br/>
					<center><input type="submit" name="submit" value="Deactivate account"></center>
				</div>	
	        </div>
</form>
</body>
</html>
<?php
if (isset($_POST['submit']))
{
$email=$_POST['email'];
$password=$_POST['password'];
$connect = mysqli_connect("localhost","root","","foodies");
$query = mysqli_query($connect,"select * from php_users_login where email='$email'");
$numrows = mysqli_num_rows($query);
if($numrows!=0)
{
while($row = mysqli_fetch_assoc($query))
{
$dbemail = $row['email'];
$dbpassword = $row['password'];
}
if($email==$dbemail&&$password==$dbpassword)
{
		$sql1 ="DELETE FROM `php_users_login` WHERE email='$dbemail';";
		query1 = mysqli_connect($connect,$sql1);
		$sql2 = "DELETE FROM 'user' WHERE email='$dbemail';";
		query2 = mysqli_connect($connect,$sql2);
		if(query1 && query2)
		{  
			$_SESSION['user_info'] = null;
			unset($_SESSION['user_info']);
			echo "<script type='text/javascript'>alert('User deleted successfully');
					window.location.replace('http://localhost/Foodies/');
				  </script>";
		}
		else
		{  
			echo "<script type='text/javascript'>alert('Could not delete user');</script>";
		}  
}
else
echo "<script type='text/javascript'>alert('Incorrect password');</script>";
}
else
echo "<script type='text/javascript'>alert('User does not exist');</script>";
}
?>