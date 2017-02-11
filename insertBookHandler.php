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
	$insert_message = "";
	include "connection/mysql.php";
	$aa=new mysql;
	$id = $aa->link("");
	$bname = $_POST['bname'];
	$author = $_POST['author'];
	$classfication = $_POST['classfication'];
	$detail = $_POST['detail'];

	$sid=$_SESSION['sid'];
	$query="insert into book(bname,author,classfication,bdesc,sid) values('".$bname."','".$author."','".$classfication."','".$detail."','".$sid."')";
	if ($aa->excu($query,$id)){
		echo "===恭喜您，登记成功！";
		echo "<br>";
		echo "请<a href=./individual.php>返回个人页面</a>===";
	}
	?>
</body>
</html>