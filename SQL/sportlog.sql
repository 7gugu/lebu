# Host: localhost  (Version: 5.5.53)
# Date: 2019-04-05 20:52:11
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "sportlog"
#

DROP TABLE IF EXISTS `sportlog`;
CREATE TABLE `sportlog` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` text COMMENT '运动开始时间',
  `stop_time` text COMMENT '运动停止时间',
  `totalTime` varchar(255) DEFAULT '00:00:00' COMMENT '总运动时间',
  `distance` varchar(255) DEFAULT '0' COMMENT '运动公里数',
  `pace` varchar(255) DEFAULT NULL COMMENT '配速[JSON][粒度30s/次]',
  `kcal` varchar(255) DEFAULT '0' COMMENT '卡路里',
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `weight` varchar(255) DEFAULT '52' COMMENT '用户体重',
  `height` varchar(255) DEFAULT '160' COMMENT '用户身高',
  `updated_time` varchar(255) DEFAULT NULL COMMENT '更新时间',
  `created_time` varchar(255) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='运动数据池';
