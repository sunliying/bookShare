# 资料分享系统 #
## 一、系统分析 ##
### 1.	系统目标 ###
针对信息管理学院设计一个图书资料分享系统，主要用于信息管理学院的学生登记自己拥有并愿意借出的书籍或者转卖的学习资料，并供信息管理学院的学生或者老师查询和借阅。       
系统主要有已下特点：

- 仅限于信息管理学院的学生和教师，采用实名制，查询到之后可以找卖主或借主私下商议。均为实名制，并留下自己的联系方式。
- 每个人都可以进行登记和查询，既是卖主，又是买主
- 用户进入系统需要登记和注册
- 用户可根据不同的属性（例如书名、作者、登记者等）进行检索
- 整个页面以简洁又时尚，突出重点。
- 使用轮转图显示基本信息
- 后台可以对注册用户以及用户上传登记内容进行查询和管理
- 易维护，有清晰的系统结构和代码结构，详细的注释
### 2.	系统功能结构 ###
 
![](http://i.imgur.com/76Pm3qI.png)

### 3.	开发环境 ###
本系统使用html、css、JavaScript做前端设计，使用php语言进行后台设计，并使用mysql作为数据库。        
在开发信管图书资料分享系统时，该项目使用的软件开发环境具体如下：          
**（1）服务器端**   

a)	操作系统： windows8            
b)	服务器： Apache 2.4.10       
c)	Php软件：php 5.2.17       
d)	数据库：MySQL 5.5.40           
e)	Mysql图形化管理软件： phpMyAdmin 3.5.8.2                 
f)	数据库物理层设计：powerDesign软件            
g)	开发工具：sublime           
**（2）客户端**           
a)	Js库：Jquery库      
b)	Css框架： Bookstrap                

### 4.	文件夹组织结构 ###
 ![](http://i.imgur.com/gVKCzUQ.png)
如图所示为文件夹组织结构。

## 二、数据库物理设计  ##

下面使用的powerDesign设计的数据库的物理结构：
 ![](http://i.imgur.com/jYwe09g.png)
 

三、效果截图和说明
	（1）登录效果图

 
背景是含有书目的轮播图，登录时在前台后台都有验证。
（3）	注册效果图
 
（4）	个人主页（查询显示个人登记资料）
1.	可以退出登录
2.	显示个人信息
3.	查看简介
4.	删除记录
 
查看简介：
 
删除记录：
 
（5）	个人主页（登记资料）
 
（6）	个人主页（修改个人信息）
 
（7）	搜索主页（搜索相关记录）
1.	实行分页
2.	多字段查询
3.	查询详细信息
 
四、文件列表，文件间逻辑关系说明
核心代码说明标注于代码中，注释
编号	文件名	文件作用说明
1	Banner.js	用于首页轮播图的显示
2	Mysql.php	使用对象和函数方式连接数据库供其他页面调用
3	Myfunction.php	用于封装数据库查询函数和分页函数
4	logOutHandler.php	用户退出
	Search.php	查询页面
	Individual.php	个人主页面（实现三个分页面）
五、模块、文件关系图
模块结构：
 
对应的文件结构：
 
五、总结

以上是本系统的所有内容。
	本系统前端对所有输入都进行了严格的验证。
	并对错误进行了严格的处理。
	设置分页。
	设置轮播图效果。
	有登录有退出，退出会销毁session中保存的信息。
	使用bookStrap框架对整个网站进行页面的美化
