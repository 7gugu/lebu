<?php 
/**
 * 更新用户的跑步信息
 */
if(isset($_POST['run'])){
	global $sql;
	$p=$_POST;
	$start_time=date("Y-m-d H:i:s",(int)$p["start_time"]);
	$stop_time=date("Y-m-d H:i:s",(int)$p["stop_time"]);
	$totalTime=$p["totalTime"];
	$username=$p["username"];
	$kcal=$p["kcal"];
	$pace_array=str_replace("'",".",$p["pace_array"]);
	$pace_array=str_replace("\""," ",$pace_array);
	$distance=$p["distance"];
	$height=$p['height'];
	$weight=$p['weight'];
	$updated_time=$created_time=date("Y-m-d H:i:s");
	$connect=$sql->connect();
	$context="insert into sportlog(username,height,weight,start_time,stop_time,totalTime,kcal,distance,pace,updated_time,created_time)values('{$username}','{$height}','{$weight}','{$start_time}','{$stop_time}','{$totalTime}','{$kcal}','{$distance}','{$pace_array}','{$updated_time}','{$created_time}')";
	$res=$sql->query($connect,$context);
	if($res){
		echo json_encode(array(
		"status"=>"success",
		"describe"=>"上传成功,您可前往历史记录查看",
		));
		die();
	}else{
		echo json_encode(array(
		"status"=>"warning",
		"describe"=>"上传失败,请稍后重试..",
		));
		die();
	}
}
?>