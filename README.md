软件设计说明书
Lebu云计步系统
乐步是一款基于Html5 API所制作的一款计步软件
功能简介
轻量化,易维护
本软件使用了MVC的开发模式,降低了后期的维护成本。同时引入了部分框架的特性,具备有路由系统,SESSION验证系统,提高了代码的复用性。
移动优先
系统使用了成熟的前端框架(AmazeUI)使得全屏幕自适应,提高了用户的体验
数据可视化
程序后台可根据用户数据动态生成分析图,用于观察用户的运动趋向。
开发环境
PHP 7.1.13-NTS
Apache
开发工具
Notepad++
目录结构
Lebu
|-- LICENSE
|-- README.md
|-- assets      # 资源目录
|-- SQL         # 数据库表文件
|-- lib         # 函数库,模型以及控制器
|-- template    # 路由与视图文件
|-- index.php   # 程序入口文件
|-- init.php    # 初始化文件
安装
1.	将文件解压至网站根目录
2.	使用数据库管理软件,将SQL文件夹内的文件导入至数据库
3.	编辑config/config.php 内的参数设定
4.	访问网站的index.php即可

注意
管理员全权限需要手动修改数据库数据,是的用户的access字段值为2
修改方法
1.	选中account表
2.	选中希望赋予管理员权限的用户
3.	修改该用户的access字段值为2
4.	保存即可
引用项目
	AmazeUI
	Highcharts(个人版)

联系作者
•	Blog: https://www.7gugu.com
•	Email: gz7gugu@qq.com[有任何问题可以发邮件给我,附上错误的截图即可]
•	Github地址: https://github.com/7gugu/lebu
•	在线演示: http://www.gu-studio.cn/lebu/index.php

