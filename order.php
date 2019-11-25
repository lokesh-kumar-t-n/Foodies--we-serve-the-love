<?php 
$title = 'Order';
include("header.php");
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
					//echo "tmp is ".$tmp[0];
					$p = (int)$tmp[0];
					$sum += $p*$qty;
				}
				else{
					echo "<script> alert('unable to query database'); </script>";
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
		}
		else
		{  
			echo "<script type='text/javascript'>alert('Could not place order');</script>";
		} 
	}
	else {
		echo "<script type='text/javascript'>alert('Please login');</script>";
	}
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
<script type="text/javascript">
	currentId = 1;
	foodpics = ['burger.jpg','eggpuff.jpg','gulab_jamun.jpg','samosa.jpg','jalebi.jpg','chole.jpg','fried_pomfert.jpg','gobi_manchurian.jpg','paneer_bhurji.jpg','paneer_tikka_masala.jpg','pizza.jpg','plain_naan.jpg','poori.jpg','pua_bhaji.jpg','pulav.jpg','rasgulla.jpg','roti.jpg','prawn_biryani.jpg','mutton_dum_biryani.jpg'];
	function getFoodDetails(){
		xhr = new XMLHttpRequest();
		//alert("currentId is "+currentId.toString());
		xhr.open("GET","fooddetails.php?id="+currentId.toString(),false);
		notDone = true;
		xhr.send();
		
		if(xhr.status == 200 && xhr.readyState == 4){
			foodDetails = JSON.parse(xhr.responseText);
			//alert(foodDetails['name']);
			td = document.createElement('td');
			img = document.createElement('img');
			img.setAttribute('src','menu/'+foodpics[currentId-1]);
			img.setAttribute('width','300');
			img.setAttribute('height','200');
			img.setAttribute('border','2');
			td.appendChild(img);
		
			br = document.createElement("br");
			td.appendChild(br);
		
			p = document.createElement('font');
			p.innerHTML = foodDetails['name'];
			//name.setAttribute('size','4');
			//alert(typeof(p));
			td.appendChild(p);

			input = document.createElement('input');
			input.setAttribute('type','text');
			input.setAttribute('name','qty'+currentId.toString());
			input.setAttribute('id','qty'+currentId.toString());
			input.setAttribute('size','1');
			input.setAttribute('maxlength','2');
			input.setAttribute('class','qty');
			input.setAttribute('style','width:25px;');
			id = input.getAttribute('id');
			td.appendChild(input);

			input = document.createElement('input');
			input.setAttribute('type','button');
			input.setAttribute('name','add');
			input.setAttribute('onclick','javascript: document.getElementById( "'+id+'").value++;');
			input.setAttribute('value','+');
			td.appendChild(input);

			input = document.createElement('input');
			input.setAttribute('type','button');
			input.setAttribute('name','subtract');
			input.setAttribute('onclick','javascript: subtractQty(document.getElementById( "'+id+'"))');
			input.setAttribute('value','-');
			td.appendChild(input);

			p = document.createElement("font");
			p.innerHTML = "Rs. "+foodDetails['price'];
			td.appendChild(p);
			//alert(td);
		}
		return td;
	}

	function init(){
		hs = window.scrollHeight > window.clientHeight;
		while(currentId<=12){
			//alert("init "+currentId.toString());
			tr = document.createElement("tr");
			var i = 0;
			while(i<3){
				td = getFoodDetails();
				tr.appendChild(td);
				i+=1;
				currentId+=1;
			}
			var table = document.getElementById("table");
			//alert("table is"+table.toString());
			table.appendChild(tr);
			hs = window.scrollHeight > window.clientHeight;
		}
		window.onscroll = getMoreFood;
		scrollAmt = 366;
	}
	function getMoreFood(){
		if(currentId>18){
			return;
		}
		//alert(document.body.scrollTop.toString() + ' > ' + (scrollAmt).toString());
		if(document.body.scrollTop >= scrollAmt ){
			var i=0;
			tr = document.createElement("tr");
			while(i<3){
				//alert("getMoreFood "+currentId.toString());
				if(currentId>19){
					break;
				}
				td = getFoodDetails();
				tr.appendChild(td);
				i+=1;
				currentId+=1;
			}
			scrollAmt += (111*15/currentId);
			document.getElementById("table").appendChild(tr);
		}
	}
</script>
<script>
	
	function subtractQty(qty){
		//alert(typeof(qty));
		if(qty.value - 1 < 0)
			return;
	else
	qty.value--;
	}
	function chk()
	{
		for (var i = 1; i<currentId; i++) {
			var id = 'qty'+i.toString();
			if(document.getElementById(id).value>0){
				return true;
			}
		};
		alert("Please select atleast 1 item");
		return false;
	}
</script>
</head>
<body background="bg1.jpg" onload="init()">


<form action="order" name="orderform" method="post">
	<table cellspacing="5" cellpadding="2" align="center" id="table">
	<tr><td colspan="3" style="position:fixed;left:15.5%;width:69%" align="center" bgcolor="yellow"><input type="submit" name="submit" value="Order now!!!"  class="button" onclick="return chk()"></input></td></tr>
	
	</table>
</form>
</body>
</html>