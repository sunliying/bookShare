<?php
class myfunction{
/***
***输入： 未经处理字符串
***输出： 经过处理的字符串
***/
      function str_to($str)
      {
        $str=str_replace(" ","&nbsp;",$str);  //把空格替换html的字符串空格
        $str=str_replace("<","&lt;",$str);  //把html的输出标志正常输出
        $str=str_replace(">","&gt;",$str);  //把html的输出标志正常输出
        $str=nl2br($str);               //把回车替换成html中的br
        return $str;
          }
/***
***输入： 用户id
***输出： 用户的所有信息，因为用sid查询只会有一行结果，所以直接输出数组
***/
	function user_info($sid){
         $aa=new mysql;
         $db = $aa->link("");
         $query="select * from user where sid='".$sid."'";
         $rst=$aa->excu($query,$db);
         $row = mysqli_fetch_assoc($rst);
         return $row;
	}
/***
***输入： 用户id
***输出： 该用户所登记的所有资料信息，结果是二维数组，需要遍历输出
***/
    function user_book_info($sid){
         $aa=new mysql;
         $db = $aa->link("");
         $query="select * from book where sid='".$sid."'";
         $rst=$aa->excu($query,$db);
         return $rst;
	}
/***
***输入： 图书名（必须），分类（必须），上传者
***输出： 查询得到的所有结果，结果是二维数组，需要遍历输出
***/
    function search_info($bname,$classfication,$name){
         $aa=new mysql;
         $db = $aa->link("");
         $query="";
         if (!$name) {
             $query="select bname,bid,author,classfication,bdesc,name,qq,phone from book,user where book.sid=user.sid and book.bname like '%".$bname."%' and book.classfication='".$classfication."'";
         }else{
            $query="select bname,bid,author,classfication,bdesc,name,qq,phone from book,user where book.sid=user.sid and book.bname like '%".$bname."%' and book.classfication='".$classfication."' and user.name='".$name."'";
         }
         $rst=$aa->excu($query,$db);
         return $rst;
    }

/***
***分页函数
***输入： 查询语句，当前页号，增加页号，每页条数
***输出： 没有输出
***前提：include "mysql.inc";
***使用方法为:
      $myf=new myfunction;
      $query="";
      $myf->page($query,$page_id,$add,$num_per_page);
      $bb=$aa->excu($query);
***/
      function page($query,$page_id,$add,$num_per_page){
       $bb=new mysql;
       global $query;      //声明全局变量
       $db = $bb->link("");
       $rst=$bb->excu($query,$db);
       $num=mysqli_num_rows($rst);
       echo '<div class="paging">';
       if ($num==0){
           echo "没有查到相关记录或没有相关回复！<br>";
           }
       $page_num=ceil($num/$num_per_page);
       for ($i=1;$i<=$page_num;$i++){
           echo "&nbsp;[<a href=./".$add."?page_id=".$i.">".$i."</a>]";
           }
       $page_up=$page_id-1;
       $page_down=$page_id+1;

       if ($page_id==1){
           echo "<a href=./".$add."?page_id=".$page_down.">下一页</a>&nbsp;&nbsp;第".$page_id."页,共".$page_num."页";
           }
       else if ($page_id>=$page_num-1){
            echo "<a href=./".$add."?page_id=".$page_up.">上一页</a>&nbsp;&nbsp;第".$page_id."页,共".$page_num."页";
            }
       else{
            echo "<a href=./".$add."?page_id=".$page_up.">上一页</a>&nbsp;&nbsp;<a href=?".$add."page_id=".$page_down.">下一页</a>&nbsp;&nbsp;第".$page_id."页,共".$page_num."页";
            }
       echo '</div>';
       $page_jump=$num_per_page*($page_id-1);
       $query=$query." limit $page_jump,$num_per_page";
      }
 }//end myfunction
?>
