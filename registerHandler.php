<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册管理</title>
	<link rel="stylesheet" type="text/css" href="./style/transform.css">
</head>
<body>
	<?php
	include "connection/mysql.php";
	$aa=new mysql;
	$id = $aa->link("");
	?>
	<div>
	<?php
	//接收提交表单内容检验数据库中是否已经存在此用户名，不存在写入数据库
	$sid=@$_POST['sid'];
	$query="select * from user where sid='".$sid."'";
	$rst=$aa->excu($query,$id);
	if (mysqli_num_rows($rst)!=0){
		echo "===您注册的用户名已经存在，请选择其他的用户名重新注册！===";
		echo "<br>";
		echo '<a href="./register.php">返回注册页</a>';
	}else{
		$today=date("Y-m-d H:i:s");
		$name = $_POST["name"];
		$age = $_POST["age"];
		$gender = $_POST["gender"];
		$grade = $_POST["grade"];
		$major = $_POST["major"];
		$qq = $_POST["qq"];
		$phone = $_POST["phone"];
		$password = $_POST["password"];
		$query="insert into user(name,sid,age,gender,grade,major,qq,phone,password,regdate) values('".$name."','".$sid."',".$age.",'".$gender."',".$grade.",'".$major."','".$qq."','".$phone."','".$password."','".$today."')";
		if ($aa->excu($query,$id)){
			echo "===恭喜您，注册成功！";
			echo "<br>";
			echo "请<a href=./index.php>返回登录页</a>登陆===";
		}
	}
	?>	
	</div>
</body>
</html>