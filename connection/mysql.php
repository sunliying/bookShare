<?php
class mysql{
    //连接服务器、数据库以及执行SQL语句的类库
    public $database;
    public $server_username;
    public $server_userpassword;
    function mysql()
  	{  //构造函数初始化所要连接的数据库
       $this->server_username="root";
       $this->server_userpassword="sunliying0213";
       }//end mysql()
	  function link($database)
  	{  //连接服务器和数据库
       //设置所有连接的数据库
        if ($database==""){
            $this->database="bookStore";
            }else{
            $this->database=$database;
            }
        //连接服务器和数据库
        $id=mysqli_connect('localhost',$this->server_username,$this->server_userpassword);
       	if($id){
          if(!mysqli_select_db($id,$this->database)){
		       echo "数据库连接错误！";
           echo "<br>";
           echo '<a href="./register.php">返回注册页</a>';
               exit;
               }else{
                mysqli_set_charset($id,"utf8");
                return $id;
               }
 	       }else{
               echo "服务器正在维护中，请稍后重试！！！";
               echo "<br>";
               echo '<a href="./register.php">返回注册页</a>';
               exit;
      	   }
	}//end link($database)
	function excu($query,$id)
    {     //执行SQL语句
      $result="";
		  if($result=mysqli_query($id,$query)){		    
    	}else{
       	echo "sql语句执行错误！请重试!!!";
        echo "<br>";
        echo '<a href="./register.php">返回注册页</a>';
        echo '<a href="./index.php">返回登录页</a>';
    	}
      return $result;
    } //end  exec($query)
} //end class mysql
?>
