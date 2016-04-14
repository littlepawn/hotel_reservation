<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>连锁酒店预定系统</title>
    <link href='/public/css/bootstrap.min.css' rel="stylesheet" />

	<style type="text/css">
		.col-md-4{
			margin-top: 25px;
		}
		#header{
			margin: 20px 0;
		}
		.alocation{
			margin-left: 220px;
		}
	</style>
  </head>
  <body>
  	<div class="container">
  		<div class="row" id="header">
  			<div class="col-md-12 text-center">
  				<a style="text-decoration:none" href=""><h1>连锁酒店预定系统</h1></a>
  			</div>
  		</div>
  		<hr />
  		<div class="row">
  			<div class="col-md-5 col-md-offset-1">
  				<div class="thumbnail">
     				 <img src="/public/i/1.jpg" alt="..." >
    			</div>
  			</div>
  			<div class="col-md-4 col-md-offset-1">
  				<form role="form" method="post" onsubmit="return checkinfo()">
  					<h2>登录</h2>
            <?php echo $_SESSION['error'];?>
  					<div class="form-group has-feedback" id="demail">
 					   <label for="InputEmail">账号</label>
   					   <input type="text" class="form-control"  id="username" placeholder="Enter email / username" name="username">
   					   <span class="help-block" style="display: none;" id="pwarning">邮箱格式错误</span>
  					</div>
  					<div class="form-group">
   					   <label for="Password">密码</label>
			  		   <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
			  		   <span class="help-block" style="display: none;" id="password1">密码不能为空</span>
			  		</div>
					<div class="checkbox">
 						<label>
   							<input type="checkbox"> 记住密码
   						</label>
   						<a href="#" class="alocation">忘记密码</a>
  					</div>

  					<hr />
			  		<div class="form-group">
			  			<input class="btn btn-primary btn-lg btn-block" type="submit" id="loginbtn" value="登录" />
			  			<input class="btn btn-info btn-lg btn-block" id="reg" type="button" value="注册"/>
			  		</div>
  				</form>
  			</div>
  			<div class="row">
				<div class="col-md-12 text-center" id="footer">
					<p>copyright © 明杰小哥</p>
				</div>
  			</div>
  		</div>
  	</div>
  </body>
  <script src="http://lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>
  <script src='/public/js/bootstrap.min.js' ></script>
  <script type="text/javascript">
      function checkinfo(){
          var username=$("#username").val();
          var password=$("#password").val();
          if(username.length==0||password.length==0)
              return false;
          return true;
      }

      $(function () {
         checkinfo();
         $("#reg").click(function(){
             window.location.href="?c=auth&m=register";
         }) ;
      });
  </script>
</html>
