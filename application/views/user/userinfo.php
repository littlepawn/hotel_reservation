<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>连锁酒店预定</title>
    <link href="/public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
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
    	#username{
    		text-align: center;
    	}

    </style>
  </head>
  <body>
  	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	  <div class="container">
	    <div class="row">
	    	<div class="col-md-10">
	      		<a class="navbar-brand" href="?c=index&m=index">
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
					    	<a href="">个人资料</a>
					    </li>
					</ul>
					<div class="col-md-4" id="head-sculpture">
						<img class="img-thumbnail" src="<?php echo empty($_SESSION['user']['avatar'])
								?'/public/i/default.jpg':$_SESSION['user']['avatar'];?>" alt="..." >
						<!--<button class="btn btn-primary btn-lg" type="button" id="change">更改头像</button>-->
					</div>
					<div class="col-md-8">
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label class="control-label col-md-2">用户名</label>
								<label class="control-label col-md-2" id="username">
									<?php echo $_SESSION['user']['name'];?>
								</label>
								<!--<div class="col-md-4"></div>-->
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">登录密码</label>
								<label class="control-label col-md-2" id="password">已设置</label>
								<!--<div class="col-md-2 col-md-offset-1">
									<a class="btn btn btn-default" href="">修改</a>
								</div>-->
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">邮箱</label>
								<label class="control-label col-md-3" id="email">
                                    <?php echo $_SESSION['user']['email'];?>
                                </label>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2">手机</label>
								<label class="control-label col-md-2" id="phone">
									<?php echo $_SESSION['user']['mobile'];?>
								</label>
							</div>

							<div class="form-group">
								 <label class="control-label col-md-2">性别</label>
					   			 <div class="col-md-6">
									 <?php
										if($_SESSION['user']['sex']==1||empty($_SESSION['user']['sex'])) {
									 ?>
											<input class="radio radio-inline" type="radio" value="男" name="sex"
												   checked="checked" disabled="disabled">男
											<input class="radio radio-inline" type="radio" value="女" name="sex" disabled="disabled">女
									 <?php
										}else {
									 ?>
											<input class="radio radio-inline" type="radio" value="男" name="sex" disabled="disabled">男
											<input class="radio radio-inline" type="radio" value="女" name="sex"
												   checked="checked" disabled="disabled">女
									 <?php
										}
									 ?>
					   			 </div>
							</div>


							<div class="form-group">
								<div class="col-md-1"></div>
								<div class="col-md-5 col-md-offset-1">
									<a class="btn btn-info btn-lg btn-block" href="?c=user&m=show_edit_info" id="edit">修改个人资料</a>
								</div>
								<!--<div class="col-md-7"></div>-->
							</div>

						</form>
					</div>
			</div>
			<div class="col-md-1"></div>
		</div>
  	</div>

    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		    $("input").height("25px");
	</script>
	<script type="text/javascript">
		    $(".add-on").height("25px");
	 </script>
  </body>
</html>
