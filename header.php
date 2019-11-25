
<html>
<head>
<title><?php echo "$title" ?></title>
<script type="text/javascript">
	
		
		function index(){
			/*
			9886902824
			xhr = new XMLHttpRequest();
			xhr.onreadystatechange = showResult;
			xhr.open("GET","http://localhost/Foodies/home",true);
			//xhr.responseType = "document";
			xhr.send();
			*/
			window.location.replace("http://localhost/Foodies/home");
		};
		function help(){
			/*
			xhr = new XMLHttpRequest();
			xhr.onreadystatechange = showResult;
			//xhr.responseType = "text/html";
			xhr.open("GET","http://localhost/Foodies/helper",true);
			//xhr.responseType = "document";
			xhr.send();
			*/
			window.location.replace("http://localhost/Foodies/helper");
			console.log("done");
		};
		function register(){
			/*
			xhr = new XMLHttpRequest();
			xhr.onreadystatechange = showResult;
			//xhr.responseType = "text/html";
			xhr.open("GET","http://localhost/Foodies/register",true);
			//xhr.responseType = "document";
			xhr.send();
			*/
			window.location.replace("http://localhost/Foodies/register");
		};
		function showResult(){
			if(this.status == 200 && this.readyState == 4){
				//console.log(this.responseXML);
				document.body.innerHTML = this.responseText;
			}
		};

	
</script>
</head>
<body>
<FONT size="4" color="white">
<NAV align="right">
<A href="home">Home</A>&nbsp&nbsp&nbsp
<A href="helper">Help</A>&nbsp&nbsp&nbsp
<?php  
session_start();
if(isset($_SESSION['user_info'])){
	echo 'Welcome <A href="login"> '.$_SESSION['user_info'].'</a>&nbsp&nbsp&nbsp';
	echo '<A href="logout"> logout </A>';
}
else
	echo '<A href="register">Login/Register</A>';
?>
</FONT></NAV>
</body>
</html>