<?php
	set_time_limit(0);
	include("header.php");
	if(isset($_POST['submit'])) {
		$target_dir = "Ml_part2/";
		$target_file = $target_dir . "tmp.jpg";
		move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
		$ret1 = 0;
		$ret2=0;
		while(($ret1===0) && ($ret2===0)){
			exec("cd Ml_part2",$out1,$ret1);
			exec("python predict.py 2>&1",$out2,$ret2);
		}
		$f1=fopen("./Ml_part2/calories.txt","r");
 		while(!feof($f1)){
    		$str=fgets($f1,100);
    	}
    	echo $str;
    	if($str=="None"){
    		$_POST['calories'] = "Unable to predict";
    	}
    	else{
  			$_POST['calories'] = floatval($str);
  		}

  	}

?>

<html>
<head>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Foodie -- we serve the food</title>
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
    table{
      border: 1px solid black;
      border-collapse: collapse;
    }
    .Remove-border {
      border-top: none !important;
      border-left: none !important;
      border-bottom: none !important;
      border-right: none !important; 
      
    }
    table{
      
      width: 100% ;
    }

    td {
      width: 25% ;
    }
    table.tab{
      border-collapse: collapse;
      border-style: hidden;
    }
    </style>
</head>
<body>
	<form id="login-form" class="login-form" enctype="multipart/form-data" name="form1" method="post" action="findCalories">
    	<input type="hidden" name="is_login" value="1">
        <div class="h1">Find Calories by uploading a image here</div>
        <div id="form-content">
            <div class="group">
                <label for="email">Submit Image</label>
                <div><input type="file" name="fileToUpload" id="fileToUpload"></div>
            </div>
            <?php if(isset($_POST['calories'])) { ?>
            <div class="group">
                
                	<label for="email">Approximate Calories</label>
                	<div>
						<input style="display: inline" readonly="readonly" value="<?php echo $_POST['calories'] ?>"></input>
					</div>
				
			</div>
			<?php } ?>
            <div class="group submit">
                <label class="empty"></label>
                <div><input name="submit" type="submit" value="Submit"/></div>
            </div>
        </div>
        <div id="form-loading" class="hide"><i class="fa fa-circle-o-notch fa-spin"></i></div>
	</form>
</body>
</html>
