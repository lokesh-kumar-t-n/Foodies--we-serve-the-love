<?php
	$output1 = exec("python ml-model.py",$output,$return);
	echo "output =";
	var_dump($output);
	echo "\n output1 =";
	var_dump($output1);
	echo "\n output2 =";
	var_dump($return);
	echo "hello";
?>