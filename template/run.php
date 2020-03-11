<html>
<head>
    <input name="height" id="height" type="hidden" value="<?php echo $_SESSION['height']; ?>" />
    <input name="weight" id="weight" type="hidden" value="<?php echo $_SESSION['weight']; ?>" />
    <style>

        .holder li {
            padding: 30px;
            position: relative;
            box-sizing: border-box;
            display: inline-block;
            width: 33.3333%;
        }
        .holder li:after {
            content: "";
            opacity: 0.1;
            -ms-transform: translate(0, -50%);
            -webkit-transform: translate(0, -50%);
            transform: translate(0, -50%);
            background-color: #1d2528;
            position: absolute;
            height: 40%;
            width: 1px;
            right: 0;
            top: 50%;
        }
        .holder li:last-of-type:after {
            display: none;
        }
        .holder h1,
        h2,
        label {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
        }
        .holder h1,
        h2 {
            color: #fa4248;
        }
        .holder h1 {
            letter-spacing: 0.04em;
            font-weight: 900;
            font-size: 60px;
            text-align:center;
        }
        .holder h2 {
            letter-spacing: 0.07em;
            font-weight: 300;
            font-size: 24px;
            text-align:center;
        }
        .holder label {
            width: 100%;
            text-align: center;
            font-weight: 400;
            letter-spacing: 0.1em;
            display: block;
            padding: 10px;
            font-size: 15px;
        }
    </style>
</head>

<body>
<div class="am-g">
    <div class="am-u-sm-12">
	<?php loadalert(); ?>
        <div class="am-panel am-panel-default">
            <div class="am-panel-bd">

                <div class="holder">
                    <div class="head">
                        <h1 name="totalTime" id="totalTime">00:00:00</h1>
                        <label>运动时长</label>
                    </div>
                    <hr>
                    <h2 name="distance" id="distance">0.00</h2>
                        <label>公里</label>
                        <hr>
                        <h2 name="pace" id="pace">0'0"</h2>
                        <label>配速</label>
                        <hr>
                        <h2 name="kcal" id="kcal">0.00</h2>
                        <label>卡路里</label>
                </div>
                <button class="am-btn am-btn-success am-btn-xl am-btn-block" name="button_start" id="button_start" onclick="start()">开始</button>
                <button class="am-btn am-btn-danger am-btn-xl am-btn-block" name="button_stop" id="button_stop" onclick="reset()" disabled>结束</button>
			</div>
        </div>
    </div>
</div>
</div>
    <script type="text/javascript">
	$.fn.stringify = function() {
  return JSON.stringify(this);
}
        var h=m=s=ms= 0;  //定义时，分，秒，毫秒并初始化为0；
        var time=0;
        var step=0,count=0;
		var pace_id;//配速计数器id
		var pace_array= new Array();
		var per_pace;
		var start_time,stop_time,totalTime;
        function timer(){   //定义计时函数
            ms=ms+50;         //毫秒
            if(ms>=1000){
                ms=0;
                s=s+1;         //秒
            }
            if(s>=60){
                s=0;
                m=m+1;        //分钟
            }
            if(m>=60){
                m=0;
                h=h+1;        //小时
            }
            $("#totalTime").text(toDub(h)+":"+toDub(m)+":"+toDub(s));
        }

        function reset(){  //重置-停止按钮
	if(!confirm("你确定现在结束吗?\n运动少于1分钟,将无法成为有效数据!"))return;
            clearInterval(time);
			clearInterval(pace_id);
			clearInterval(pace_push_id);
			stop_time = (new Date()).getTime()/1000;
			totalTime=$("#totalTime").text();
			kcal=$("#kcal").text();
			distance=$("#distance").text();
		
			if(totalTime.split(":")[1]<1){
				alert_warning("成绩无效..");
				$("#button_stop").attr("disabled",true);
				$("#button_start").attr("disabled",false);
				return;
				}
				
            h=m=s=ms=0;
            $("#totalTime").text("00:00:00");
            $("#distance").text("0.00");
            $("#pace").text("0\'0\"");
            $("#kcal").text("0.00");
			pace_array=JSON.stringify(pace_array);
			pace_array=pace_array.replace(/'/g,"\'")
			//ajax提交数据 
			 $.ajax({
				type: 'POST',
				async: false,
				url: 'index.php',
				data: { run: true, start_time: start_time , stop_time: stop_time,totalTime: totalTime,username: '<?php echo $_SESSION['username'];?>',height: '<?php echo $_SESSION['height']; ?>',weight:'<?php echo $_SESSION['weight']; ?>',distance: distance,kcal: kcal,pace_array: pace_array},
				beforeSend:function(){
					alert_info("成绩提交中..");
				},
				success:function(data){
					$("#button_stop").attr("disabled",true);
					$("#button_start").attr("disabled",false);
					remove_alert();
					var response=$.parseJSON(data);
					if(response.status=="success"){
						alert_success(response.describe);
					}else if(response.status=="danger"){
						alert_danger(response.describe);
					}else if(response.status=="warning"){
						alert_warning(response.describe);
					}
				},
			});
        }

        function start(){  //开始
            caldis();
			start_time = (new Date()).getTime()/1000;
            time=setInterval(timer,50);
			pace_id=setInterval(function(){calpace();},5000);
			pace_push_id=setInterval(function(){push_pace();},30000);//每隔30s存储一次配速数据
			$("#button_start").attr("disabled",true);
			$("#button_stop").attr("disabled",false);
        }

        function stop(){  //暂停
            clearInterval(time);
        }

        function toDub(n){  //补0操作
            if(n<10){
                return "0"+n;
            }
            else {
                return ""+n;
            }
        }
		//将配速数据存入数组
		function push_pace(){
		if($("#pace").text()>0){
			per_pace=$("#pace").text();
		}else{	
			per_pace="0'0\"";
		}
		per_pace=per_pace.replace(/'/,"\'");
		pace_array.push(per_pace);
		}
        //测试数据
        function test_data(){
            alert("体重:"+$("#weight").val()+" 身高:"+$("#height").val());
        }
        //计算步长(按照黄金比例1.618计算)
        function calstep(){
            if($("#height").val()>0){
                step=Math.round(Math.sqrt(Math.pow(($("#height").val()/1.618),2)*2-2*Math.pow(($("#height").val()/1.618),2)*Math.cos((2*3.14/360*30))));
            }else{
                return ;
            }
        }
        //计算配速
        function calpace(){
            var distance = ($("#distance").text());
            var totalTime=$("#totalTime").text();
            var time_split=totalTime.split(":");
            var hours = time_split[0];
            var minutes = time_split[1];
            var seconds = time_split[2];
            $("#pace").html("");
            if(distance > 0 && hours.length > 0 && minutes.length > 0 && seconds.length > 0)
            {
                var speed = parseFloat(hours) * 60.0 + parseFloat(minutes) + parseFloat(seconds) / 60.0;
                speed = speed / parseFloat(distance);
                speed_minutes = Math.floor(speed);
                speed_seconds = Math.floor((speed - speed_minutes) * 60.0);
                $("#pace").html(speed_minutes+"'"+speed_seconds+"\"");
                return;
            }else{
                $("#pace").html("输入数据不够");
            }
        }
        //计算卡路里
        function calkcal(){
            var weight=0,distance=0,kal=0;
            weight = $("#weight").val();
            distance=$("#distance").text();
            kcal=weight*distance*1.036;
            kcal=kcal.toFixed(2);
            $("#kcal").text(kcal);
        }
        //计算里程
        var totalDistance=0;
        function caldis(){
            if($("#weight").val()>0&&$("#height").val()>0){
                calstep();
                calkcal();
                totalDistance=totalDistance+ parseInt(step);
                console.log("里程:"+totalDistance)
                $("#distance").text((totalDistance/100/1000).toFixed(2))
                //return totalDistance
            }
        }
        //监测运动
        //运动事件监听
        if (window.DeviceMotionEvent) {
            window.addEventListener('devicemotion',deviceMotionHandler,false);
        }
        var SHAKE_THRESHOLD = 4190;
        var last_update = 0;
        var x, y, z, last_x = 0, last_y = 0, last_z = 0;
        var time=0;
        function deviceMotionHandler(eventData) {
            var acceleration =eventData.accelerationIncludingGravity;
            var curTime = new Date().getTime();
            if ((curTime-last_update)> 125) {
                var diffTime = curTime -last_update;
                last_update = curTime;
                x = acceleration.x;
                y = acceleration.y*0.4;
                z = acceleration.z*0.3;
                var speed = Math.abs(x +y + z - last_x - last_y - last_z) / diffTime * 10000;
                if(speed > 100&&speed<4000){$("#currentSpeed").text(speed);}//观测加速度
                if (speed > 145&&speed<165||speed>180&&speed < 300||$speed > 1300 && speed < 1500||speed>1600&&speed<2100) {
                    caldis();
                    if($("#height").val()!="")caldis();
                }
                last_x = x;
                last_y = y;
                last_z = z;
            }
        }
    </script>
</body>
</html> 
