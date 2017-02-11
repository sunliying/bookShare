<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>更改用户信息</title>
	<link rel="stylesheet" type="text/css" href="./style/transform.css">
</head>
<body>
	<?php
	//开启一个会话
	session_start();
	$insert_message = "";
	include "connection/mysql.php";
	$aa=new mysql;
	$id = $aa->link("");
	$qq = $_POST['qq'];
	$phone = $_POST['phone'];
	$password = $_POST['password'];
	$sid=$_SESSION['sid'];

	$query="update user set qq='".$qq."', phone='".$phone."', password='".$password."' where sid='".$sid."'";
	if ($aa->excu($query,$id)){
		$_SESSION['qq']=$qq;
		$_SESSION['phone']=$phone;
		$_SESSION['password']=$password;
		echo "===恭喜您，修改成功！===";
		echo "<br>";
		echo "请<a href=./individual.php>返回个人页面</a>";
	}
	?>
</body>
</html>