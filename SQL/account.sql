# Host: localhost  (Version: 5.5.53)
# Date: 2019-04-05 20:52:29
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "account"
#

DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(255) NOT NULL DEFAULT '' COMMENT '用户密码',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '用户邮箱',
  `height` varchar(255) NOT NULL DEFAULT '160' COMMENT '用户身高',
  `weight` varchar(255) DEFAULT '52' COMMENT '用户体重',
  `access` int(11) unsigned DEFAULT '0' COMMENT '用户权限',
  `nickname` varchar(255) DEFAULT NULL COMMENT '用户昵称',
  `token` varchar(255) DEFAULT NULL COMMENT '验证秘钥',
  `updated_time` varchar(255) DEFAULT NULL COMMENT '更新时间',
  `created_time` varchar(255) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='账户池';

#
# Data for table "account"
#

/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (1,'7gugu','asd8gugu','gz7gugu@qq.com','190','65',2,'7gugu','e912f7a0115aff6ddaec0316050234db','2019-03-31 22:44:11','2019-03-31 22:44:11');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
