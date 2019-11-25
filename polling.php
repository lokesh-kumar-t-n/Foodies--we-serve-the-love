<?php
	session_start();
	$connection = mysqli_connect("localhost","root","","foodies");
	if(!$connection){
		echo "something went wrong";
	}
	
	while (True) {
		# code...
	
		$sql = "select distinct email from orders";
		$res = mysqli_query($connection,$sql);
		$users = mysqli_fetch_all($res);
		

		$sql = "select name from food";
		$res = mysqli_query($connection,$sql);
		$name = mysqli_fetch_all($res);
		$return_data = [];
		for($k=0;$k<count($users);$k++){
			$user = $users[$k][0];
			$sql = "select * from orders where email='".$user."' order by email";
			$res = mysqli_query($connection,$sql);
			$res_query = mysqli_fetch_all($res);
			
			$sql = "select * from user where email='".$user."'";
			$res = mysqli_query($connection,$sql);
			$req = mysqli_fetch_assoc($res);
			$return["location"] = $req["location"]; 

			
			$return["food"] = [];
			for ($i=0; $i < count($res_query); $i++) { 
				# code...
				$tmp = [];
				for ($j=1; $j < count($res_query[$i]); $j++) { 
					# code...
					if($res_query[$i][$j]>0){
						$private = [];
						$private["name"] = $name[$j-1][0];
						$private["qty"] = $res_query[$i][$j];
						array_push($tmp, $private);
					}
				}
				if($tmp!=[]){
					array_push($return["food"],$tmp);
				}
			}
			array_push($return_data,$return);
		}
		//echo json_encode($name);
		//echo "----------------------------------------------------------------------------------------------";
		$cur_json = json_encode($return_data);
		if(isset($_SESSION['returned'])){
			if($cur_json != $_SESSION['returned']){
				
				break;
			}
		}
		else{
			break;
		}
		//sleep(2);
	}
	$_SESSION['returned'] = json_encode($return_data);
	echo $_SESSION['returned'];
?>