<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>连锁酒店预定系统</title>
    <link href='/public/css/bootstrap.min.css' rel="stylesheet" />
    <script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
    <script src='/public/js/bootstrap.min.js' ></script>
 	<style type="text/css">
		#mainbody{
			margin: 30px auto;
		}
		.form-group{
			margin: 30px auto;
		}
		#login{
			margin-top: 3px;
			margin-left: 20px;
		}
 	</style>
  </head>

 <body>
	<nav class="navbar navbar-default" role="navigation">
	  <div class="container">
	    <div class="row">
	    	<div class="col-md-8 col-md-offset-1">
	      		<a class="navbar-brand" href="?c=index&m=index">
	        		<p>连锁酒店预定系统</p>
	      		</a>
	      	</div>
	      	<div class="col-md-2" id="login">
	      		<button class="btn btn-info navbar-btn navbar-right">登录</button>
	      	</div>
	    </div>
	  </div>
	</nav>

	<div class="container" id="mainbody">
		<div class="row">
			<div class="col-md-6">
			<?php echo empty($_SESSION['error'])?"":$_SESSION['error'];?>
				<form class="form-horizontal" role="form" method="post">
					<div class="form-group" id="demail">
					   <label for="inputEmail" class="col-md-2 control-label">邮箱</label>
					   <div class="col-md-6">
   					   	   <input type="text" class="form-control" name="email" id="InputEmail" placeholder="Email">
   					   	   <span class="help-block" style="color: red"></span>
   					   </div>
					</div>
					<div class="form-group" id="dname">
					    <label for="inputName" class="col-md-2 control-label">用户名</label>
					    <div class="col-md-6">
					      <input type="text" class="form-control" name="username" id="inputName" placeholder="Username">
					      <span class="help-block" style="color: red"></span>
					    </div>
					</div>
					<div class="form-group">
					    <label for="inputPassword1" class="col-md-2 control-label">密码</label>
					    <div class="col-md-6">
					      <input type="password" class="form-control" name="password" id="inputPassword1" placeholder="Password">
					      <span class="help-block" style="color: red"></span>
					    </div>
					</div>
					<div class="form-group">
					    <label for="inputPassword2" class="col-md-2 control-label">确认密码</label>
					    <div class="col-md-6">
					      <input type="password" class="form-control" name="repassword" id="inputPassword2" placeholder="Password">
					      <span class="help-block" style="color: red"></span>
					    </div>
					</div>

					<div class="form-group">
						<div class="col-md-1"></div>
						<div class="col-md-6 col-md-offset-1" id="reg">
					    	<input type="submit" class="btn btn-primary btn-lg btn-block" value="注册"/>
					   </div>
					</div>
				</form>
			</div>
			<div class="col-md-6">

			</div>
		</div>
  	</div>

  </body>
  <script type="text/javascript">
	 $(function(){
		$("button").click(function(){
			window.location.href="?c=auth&m=login";
		});
	});
  </script>
</html>
