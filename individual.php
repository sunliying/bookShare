<!DOCTYPE html>
<html>

<head>
    <base href="<%=basePath%>">
    <title>个人主页</title>
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="keywords" content="个人主页">
    <meta http-equiv="description" content="个人主页">
    <link rel="stylesheet" type="text/css" href="style/individual.css">
    <link rel="stylesheet" type="text/css" href="style/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="./js/jquery1.11.1.min.js"></script>
    <script type="text/javascript" src="./style/dist/js/bootstrap.min.js"></script>
</head>

<body>
  <?php
  //使用会话内存储的变量值之前必须先开启会话
  session_start();
  //使用一个会话变量检查登录状态
  if(isset($_SESSION['sid'])){
    //点击“Log Out”,则转到logOut页面进行注销
    echo '<a style="  position: absolute;
                      z-index: 20;
                      right: 60px;
                      top: 16px;
                      font-size: 19px;" 
    href="./logOutHandler.php">退出登录</a>';
    include "connection/mysql.php";
    include "connection/myfunction.php";
    $aa=new mysql;
    $bb=new myfunction;
    $id = $aa->link("");
    $sid = $_SESSION['sid'];
    $searchResult = $bb->user_book_info($sid);
  ?>

	<div class="header">
		<div class="img-box"><img src="./img/logo.png" alt="placeholder+image"></div>
        <h3>信管图书系统</h3>
    </div>
    <span class="_name">
  	 	<a href="./search.php">搜索资料</a>
  	</span>
    <img class="background_img" src="img/shuimo.jpg" alt="background">
    
    <div class="body">
        <div class="indiv-info">
            <h2>个人信息</h2>
            <hr>
            <p>姓名：<? echo $_SESSION['name']?></p>
            <p>学号：<?echo $_SESSION['sid']?></p>
            <p>年龄：<?echo $_SESSION['age']?></p>
            <p>性别：<?echo $_SESSION['gender']?></p>
            <p>年级：<?echo $_SESSION['grade']?></p>
            <p>专业：<?echo $_SESSION['major']?></p>
            <p>QQ号：<?echo $_SESSION['qq']?></p>
            <p>手机：<?echo $_SESSION['phone']?></p>
        </div>
        <div class="indiv-class-info">
            <div class="tabbable">
                <!-- Only required for left/right tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">登记信息</a></li>
                    <li><a href="#tab2" data-toggle="tab">资料登记</a></li>
                    <li><a href="#tab3" data-toggle="tab">个人信息修改</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <div class="table-responsive scroll">
                        <?
                        $rownum = mysqli_num_rows($searchResult);
                        if (!$rownum) {
                          echo "<h3>你还尚未上传任何资料信息</h3>";
                        }else{
                          ?>
                          <table class="table table-hover">
                                <tr>
                                    <th>书名</th>
                                    <th>书号</th>
                                    <th>作者</th>
                                    <th>分类</th>
                                    <th>详情介绍</th>
                                    <th>删除</th>
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
                                    <td>
                                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail<?php echo $row['bid'] ?>" >
                                        简介
                                      </button>

                                      <!-- Modal -->
                                      <div class="modal fade" id="detail<?php echo $row['bid'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              <h4 class="modal-title" id="myModalLabel">详情介绍</h4>
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
                                    <td>
                                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete<?php echo $row['bid'] ?>" >
                                        删除
                                      </button>
                                      <form style="width: 120px;margin: 0px;" class="modify_score" action="./deleteHandler.php" method="post">
                                          
                                          <!-- Modal -->
                                          <div class="modal fade" id="delete<?php echo $row['bid'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                  <h4 class="modal-title" id="myModalLabel">确定删除？</h4>
                                                </div>
                                                <div class="modal-body">
                                                  <div style="display:none">
                                                    <input name="bid" value=<? echo $row['bid'] ?> type="text">
                                                  </div>
                                                  <p><?php echo $row['bname'] ?></p>
                                                  <p><?php echo $row['bid'] ?></p>
                                                  <p><?php echo $row['bdesc'] ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                  <button type="submit" class="btn btn-primary" >确定</button>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                      </form>
                                    </td>
                                </tr>
                                <?
                            }
                            ?>
                          </table>
                            <?
                        }
                        ?>
                            
                        </div>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <form class="form-horizontal course_entry" action="insertBookHandler.php" method="post">
                          <div class="input-group">
                            <span class="input-group-addon">书名</span>
                            <input required="required" type="text" name="bname" class="form-control" placeholder="书名">
                          </div>
                          <div class="input-group">
                            <span class="input-group-addon">作者</span>
                            <input required="required" type="text" name="author" class="form-control" placeholder="作者">
                          </div>
                          <div class="input-group">
                          	<span class="input-group-addon">分类</span>
                          	<select name="classfication" id="major_select" class="form-control">
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
                          </div>
                          <div class="input-group">
                            <span class="input-group-addon">详情介绍</span>
                            <textarea required="required" name="detail"  rows="14" cols="35" >
                            </textarea>
                          </div>
                          <p class="submit">
                          	<button type="submit" class="btn btn-primary">提交</button>
                          </p>
                        </form>
                    </div>
                    <div class="tab-pane" id="tab3">
                        <form class="form-horizontal course_entry" action="./modifyUserHandler.php" method="post">
                          <div class="input-group">
                            <span class="input-group-addon">QQ号</span>
                            <input required="required" type="text" pattern="[0-9]{9,11}"  name="qq" class="form-control" placeholder="9到11位数字">
                          </div>
                          <div class="input-group">
                            <span class="input-group-addon">手机号</span>
                            <input required="required" type="text" pattern="[0-9]{11}"  name="phone" class="form-control" placeholder="输入11位手机号">
                          </div>
                          <div class="input-group">
                            <span class="input-group-addon">密码</span>
                            <input required="required" pattern="[a-zA-Z0-9_]{3,20}" type="password" name="password" class="form-control password" placeholder="字母、下划线、数字，最少3字符，最多20字符" >
                          </div>
                          <p class="submit">
                          	<button type="submit" class="btn btn-primary">确认修改</button>
                          </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?
  }else{
    //location首部使浏览器重定向到另一个页面
    $home_url = './index.php';
    header('Location:'.$home_url);
  }
  ?>
</body>
</html>