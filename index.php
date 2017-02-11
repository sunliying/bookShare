<!DOCTYPE html>
<html>
  <head>
    <base href="<%=basePath%>">
    
    <title>信管图书资料分享系统登录</title>
    
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">    
	<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
	<meta http-equiv="description" content="This is my page">
	<link rel="stylesheet" type="text/css" href="./style/login.css">
	<link rel="stylesheet" type="text/css" href="./style/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./style/banner.css">
	<link rel="stylesheet" type="text/css" href="./style/index.css">
	<script type = "text/javascript" src="./js/banner.js"> </script>
	<script type = "text/javascript" src="./js/jquery1.11.1.min.js"> </script>
	<script type = "text/javascript" src="./style/dist/js/bootstrap.min.js"> </script>
	<script type="text/javascript" src="./js/bower_components/requirejs/require.js"></script>

  </head>
<body>
	<?php
	//开启一个会话
	session_start();
	if (!$_SESSION['error_msg']) {
		$_SESSION['error_msg'] = "";
	}
	
	?>
<nav class="nav"></nav>
	<div class="contentbox">
		<div class="header">
			<div class="img-box"><img src="./img/logo.png" alt="placeholder+image"></div>
			<h3>信管图书资料分享系统登录</h3>
		</div>
		<form class="loginbox" action="./indexHandler.php" method="post">
			<h4>用户登录</h4>
			<p class="number" ><button></button><input required="required" type="text" pattern="[0-9]{10}"  name="sid" placeholder="输入学号，10位数字" value="2014214591"></p>
			<p class="passwd" ><button></button><input required="required" pattern="[a-zA-Z0-9_]{3,20}" type="password" name="password" placeholder="字母、下划线、数字，最少3字符，最多20字符" value="sunliying"></p>
			<input type="submit" value="submit" name="submit">
			<p>
				<a href="./register.php" class="signin">免费注册</a>
			</p>

			<p class="info">
			<?
			if ($_SESSION['error_msg']) {
			 	echo $_SESSION['error_msg'];
			 } 
			?></p>

		</form>
			<div class="banner">
		        <div id="images" class="images">
		            <img class="image" src="img/{{img}}"  alt="yupain">
		        </div>
		        <script type="text/javascript">
		        $(function(){
		        	var images = document.getElementById("images");
		        	var imagesContent = images.innerHTML;
		        	var imgurl = ["pic12.jpg","pic13.jpg","pic11.jpg","pic14.jpg","pic15.jpg","pic16.jpg"];
		        	var html = [];
		        	for(var i = 0;i<6;i++){
		        		var _content = imagesContent.replace("{{img}}",imgurl[i]);
		        		html.push(_content);
		        	}
		        	images.innerHTML = html.join('');
		        	
		        });
		        </script>
		         <div class="swhich prev">&lt;</div>  
		         <div class="swhich next" >&gt;</div>  
		        <ul class="dots">
		        <li></li>
		        <li></li>
		        <li></li>
		        <li></li>
		        <li></li>
		        <li></li>
		        </ul>    
		    </div>
		    
		    <script type="text/javascript">
		    $(function(){
		    	require(["js/banner"], function (b) {
		             b.init();
		     	});
		    }); 
		    </script>
		<div class="footer">
			<p>
			<span>关于专利搜索 | </span>
			<span>联系我们 | </span>
			<span>华中师范大学 | </span>
			<span>信息管理学院</span>
			</p>
		</div>
	</div>
</body>
</html>
