<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>deleteHandler</title>
	<link rel="stylesheet" type="text/css" href="./style/transform.css">
</head>
<body>
	<?
	session_start();
	include "connection/mysql.php";
	include "connection/myfunction.php";
	$aa=new mysql;
	$bb=new myfunction;
	$db = $aa->link("");
	$sid = $_SESSION['sid'];
	$bid = $_POST['bid'];
	$query="delete from book where bid=".$bid;
 	if ($aa->excu($query,$db)){
		echo "===恭喜您，删除成功！";
		echo "<br>";
		echo "请<a href=./individual.php>返回个人页面</a>===";
	}
 	mysqli_close($db);
 	
	?>
</body>
</html>