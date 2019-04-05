<?php
/**
 * Lebu 网页计步器
 *
 * 加载核心
 */
set_time_limit(0);
header("content-type:text/html; charset=utf-8");
require './config/config.php';
require './lib/mysql_class.php';//数据库连接类
require './lib/general.php';//页面组件模块
require './lib/auth.php';//验证模块
require './lib/run.php';//运动记录模块
require './lib/setting.php';//信息修改模块
require './lib/admin-inedx.php';//数据概览模块
require './lib/admin-account.php';//数据概览模块
if(SYSTEM_NO_ERROR){error_reporting(0);}
?>