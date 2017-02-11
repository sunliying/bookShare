<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册管理</title>
	<link rel="stylesheet" type="text/css" href="./style/transform.css">
</head>
<body>
	<?php
	//开启一个会话
	session_start();
	$error_msg = "";
	include "connection/mysql.php";
	$aa=new mysql;
	$id = $aa->link("");

	//接收提交表单内容检验数据库中是否已经存在此用户名，不存在写入数据库
	$sid=$_POST['sid'];
	$query="select * from user where sid='".$sid."'";
	$rst=$aa->excu($query,$id);
	if (mysqli_num_rows($rst)==0){
		$error_msg = "===该用户尚未注册，请先注册！===";
		$_SESSION['error_msg']=$error_msg;
		//location首部使浏览器重定向到另一个页面
		$home_url = './index.php';
		header('Location:'.$home_url);
	}else{
		$row = mysqli_fetch_assoc($rst);
		$password = $_POST['password'];
		if ($row['password']==$password) {
			$_SESSION['sid']=$row['sid'];
   			$_SESSION['name']=$row['name'];
   			$_SESSION['age']=$row['age'];
   			$_SESSION['gender']=$row['gender'];
   			$_SESSION['grade']=$row['grade'];
   			$_SESSION['major']=$row['major'];
   			$_SESSION['qq']=$row['qq'];
   			$_SESSION['phone']=$row['phone'];
   			$_SESSION['password']=$row['password'];
   			$error_msg="";
   			$_SESSION['error_msg']=$error_msg;
			echo "===恭喜您,".$row['name'].",登录成功！";
			$ind_url = './individual.php';
			header('Location:'.$ind_url);
		}else{
			$error_msg = "===密码不正确，请重新登录！===";
			$_SESSION['error_msg']=$error_msg;
			//location首部使浏览器重定向到另一个页面
			$home_url = './index.php';
			header('Location:'.$home_url);
		}
	}
	
	?>
</body>
</html>