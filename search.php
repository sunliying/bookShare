<!DOCTYPE html>
<html>
  <head>
    <base href="<%=basePath%>">
    
    <title>搜索页</title>
    
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">    
	<meta http-equiv="keywords" content="patent,technology pager">
	<meta http-equiv="description" content="This is a search webset about the patent information in recent years">

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
  include "connection/mysql.php";
  include "connection/myfunction.php";
  $aa=new mysql;
  $bb=new myfunction;
  $id = $aa->link("");
  $searchResult="";
  ?>
	<div class="header">
    <div class="img-box"><img src="./img/logo.png" alt="placeholder+image"></div>
		<h3>信息管理学院图书登记与借阅</h3>
    <span class="reg_log"><a href="./individual.php">返回个人主页</a></span>
	</div>
	<form class="searchForm" id="searchForm" name = "search" method="post" >	
    <div class="col-lg-9 inputbox">
      <div class="input-group">
        <span >
          书名：
        </span>
        <input type="text"  required="required" name="bname" placeholder="required"  />
        <span class="input-group-addon">分类</span>
        <select name="classfication" id="major_select" class="form-control" style="width: 260px;">
          <option value="信息管理与信息系统专业书">信息管理与信息系统专业书</option>
          <option value="信息资源管理专业书">信息资源管理专业书</option>
          <option value="电子商务专业书">电子商务专业书</option>
          <option value="英语复习">英语复习</option>
          <option value="教师资格证">教师资格证</option>
          <option value="计算机类">计算机类</option>
          <option value="管理类书籍">管理类书籍</option>
          <option value="休闲娱乐">休闲娱乐</option>
          <option value="经典名著">经典名著</option>
          <option value="小说">小说</option>
        
        </select>
        <span >
          上传者：
        </span>
        <input type="text" name="name"  />
        <span >
          <button class="btn btn-default" type="submit" name="submit1" value="search">Search</button>
        </span>
      </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
	</form>
  <?
    $page_id=@$_GET['page_id'];    //接收page_id

    //当点击submit或者当$page_id不为空时，就执行查询操作
    if((isset($_POST["submit1"])&&$_POST["submit1"])||$page_id)
    {
      // 当是使用form表单提交查询时，在session中记下查询的字段
      if (isset($_POST["submit1"])&&$_POST["submit1"]) {
         $bname=$_POST["bname"];
         $classfication=$_POST["classfication"];
         $name=$_POST["name"];
         $_SESSION['searchBname']=$bname;
         $_SESSION['searchclassfication']=$classfication;
         $_SESSION['searchname']=$name;
      }
      // 根据上传者是否为空设置不同的查询语句
      $query="";
      if (!$_SESSION['searchname']) {
          $query="select bname,bid,author,classfication,bdesc,name,qq,phone from book,user where book.sid=user.sid and book.bname like '%".$_SESSION['searchBname']."%' and book.classfication='".$_SESSION['searchclassfication']."'";
      }else{
         $query="select bname,bid,author,classfication,bdesc,name,qq,phone from book,user where book.sid=user.sid and book.bname like '%".$_SESSION['searchBname']."%' and book.classfication='".$_SESSION['searchclassfication']."' and user.name='".$_SESSION['searchname']."'";
      }
//   设置每页的页数和所需页的url
     $num_per_page=3;
     $add="search.php";
     
     if ($page_id==""){
          $page_id=1;
       }
     $bb->page($query,$page_id,$add,$num_per_page);
     $searchResult=$aa->excu($query,$id);
    } 
    
    if (!$searchResult) {
  ?>
  <div class="search_result">
  
  </div>
  <?
    }else{
  ?>
  <h4 style="text-align: center"><?php echo "资料名：".$_SESSION['searchBname']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;分类：".$_SESSION['searchclassfication']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;上传者：".$_SESSION['searchname'] ?></h4>
  <div class="search_result">
    <div class="table-responsive scroll">
        <table class="table table-hover">
          <?
            $rownum = mysqli_num_rows($searchResult);
            if ($rownum==0) {
              echo "<h3>没有查询结果</h3>";
              exit;
            }
          ?>
            <tr>
                <th>书名</th>
                <th>书号</th>
                <th>作者</th>
                <th>分类</th>
                <th>上传者</th>
                <th>QQ号</th>
                <th>手机号</th>
                <th>详细信息</th>
            </tr>
            <?
              for ($i=0; $i <$rownum ; $i++) { 
                $row = mysqli_fetch_assoc($searchResult);
                ?>
                  <tr>
                      <td><?php echo $row['bname'] ?></td>
                      <td><?php echo $row['bid'] ?></td>
                      <td><?php echo $row['author'] ?></td>
                      <td><?php echo $row['classfication'] ?></td>
                      <td><?php echo $row['name'] ?></td>
                      <td><?php echo $row['qq'] ?></td>
                      <td><?php echo $row['phone'] ?></td>
                      <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                          详细信息
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">详细信息</h4>
                              </div>
                              <div class="modal-body">
                                <p><?php echo $row['bdesc'] ?></p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                  </tr>
                <?
              }
              mysqli_free_result($searchResult);
              mysqli_close($id);
            ?>
            
        </table>
    </div>
  </div>
  <?
    }
  ?>
  </body>
</html>
