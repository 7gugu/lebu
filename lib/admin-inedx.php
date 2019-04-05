<?php 
function loaddata(){
	
	global $sql;
	$connect=$sql->connect();
	$res=$sql->query($connect,"select * from sportlog where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(`created_time`)");
	$arr=array();
	foreach($res as $data){
		@$x=(int)strtotime(explode(" ",$data['stop_time'])[0])*1000;
		@$y=(int)explode(":",explode(" ",$data['stop_time'])[1])[0];
		@$z=(int)explode(":",explode(" ",$data['stop_time'])[1])[1];
		array_push($arr,array($x,$y,$z));
	}
	echo json_encode($arr);
}

function loadfirst(){
	global $sql;
	$connect=$sql->connect();
	$res=$sql->query($connect,"select * from sportlog where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date(`created_time`)");
	$min=(int)strtotime(date("Y-m-d H:i:s"))*1000;
	foreach($res as $data){
		@$x=(int)strtotime(explode(" ",$data['stop_time'])[0])*1000;
		if($x<$min){
			@$min=$x;
		}
	}
	echo $min;
}
?>