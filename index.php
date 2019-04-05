<?php
/**
 * 页面路由系统
 * @param string mod 请求页面名
 */
session_start();
require dirname(__FILE__).'/init.php';
if(isset($_GET['mod'])){
    $mode=htmlspecialchars($_GET['mod']);
    template('control');
}else{
    redirect('index.php?mod');
}
loadfoot();
die;
?>