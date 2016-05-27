<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>连锁酒店预定</title>
    <link href="/public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
    <script src='/public/js/bootstrap.min.js'></script>
    <style type="text/css">
    	body {
    		padding-top: 50px;
    	}
    	#name{
    		margin-left: 120px;
    	}
    	.nav{
    		margin: 50px auto;
    	}
    	#password{
    		text-align: center;
    		font-family: "微软雅黑";
    		color: red;
    	}
    	#email{
    		text-align: center;
    	}
    	#phone{
    		text-align: center;
    	}
    </style>
  </head>
  <body>
  	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	  <div class="container">
	    <div class="row">
	    	<div class="col-md-10">
	      		<a class="navbar-brand" href="#">
	        		<p>连锁酒店预定</p>
	      		</a>
	      	</div>
	      	<div class="col-md-2">
                <?php
                    if(!isset($_SESSION['user'])){
                        header("Location:?c=auth&m=login");
                    }else{
                ?>
                <button type="button" class="btn btn-info navbar-btn navbar-right dropdown-toggle"  data-toggle="dropdown">
                    <?php echo $_SESSION['user']['name']; ?><span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" id="name">
                     <li><a tabindex="-1" href="?c=index&m=index">返回主页</a></li>
                     <li><a tabindex="-1" href="javascript:history.go(-1);">返回上一页</a></li>
					 <li><a tabindex="-1" href="?c=index&m=reservation">查看预订信息</a></li>
                     <li><a tabindex="-1" href="?c=auth&m=login_out">退出</a></li>
                </ul>
                <?php
                    }
                ?>
	      	</div>
	    </div>
	  </div>
	</nav>

  	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				    <ul class="nav nav-tabs">
					    <li class="active">
					    	<a href="javascript:;">修改个人资料</a>
					    </li>
					</ul>
<!--					<div class="col-md-4" id="head-sculpture">-->
<!--                        <form>-->
<!--                            <img class="img-thumbnail" src="public/i/default.jpg" alt="..." width="200px" height="200px">-->
<!--                            <input type="file" class="form-control col-md-1">-->
<!--                            <button class="btn btn-primary btn-lg" type="submit">更改头像</button>-->
<!--                        </form>-->
<!--					</div>-->
					<div class="col-md-8 col-md-offset-2">
						<form class="form-horizontal" role="form" action="?c=user&m=edit_user" method="post"
							  enctype="multipart/form-data">
							<div class="form-group">
								<label class="control-label col-md-2">用户名</label>
								<div class="col-md-6">
									<input class="form-control" type="text" name="username" value="<?php echo
									$_SESSION['user']['name'] ?>">
								</div>
								<!--<div class="col-md-4"></div>-->
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">登录密码</label>
								<label class="control-label col-md-2" id="password">已设置</label>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">邮箱</label>
								<div class="col-md-6">
									<input class="form-control" type="text" name="email" value="<?php echo
									$_SESSION['user']['email'];?>">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">手机</label>
								<div class="col-md-6">
									<input class="form-control" type="text" name="mobile" value="<?php echo
									$_SESSION['user']['mobile'];?>">
								</div>
							</div>

							<div class="form-group">
								 <label class="control-label col-md-2">性别</label>
					   			 <div class="col-md-6">
									 <?php
										if($_SESSION['user']['sex']==1||empty($_SESSION['user']['sex'])) {
									 ?>
											<input class="radio radio-inline" type="radio" value="1" name="sex"
												   checked="checked">男
											<input class="radio radio-inline" type="radio" value="2" name="sex">女
									 <?php
										}else {
									 ?>
											<input class="radio radio-inline" type="radio" value="1" name="sex">男
											<input class="radio radio-inline" type="radio" value="2" name="sex"
												   checked="checked">女
									 <?php
										}
									 ?>
					   			 </div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">头像</label>
								<div class="col-md-6">
									<input class="form-control" type="file" name="avatar">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-1"></div>
								<div class="col-md-5 col-md-offset-1">
									<input class="btn btn-info btn-lg btn-block" type="submit" value="保存"/>
								</div>
								<!--<div class="col-md-7"></div>-->
							</div>

						</form>
					</div>
			</div>
			<div class="col-md-1"></div>
		</div>
  	</div>

  </body>
  <script type="text/javascript">
	    $(".add-on").height("25px");
  </script>
</html>
