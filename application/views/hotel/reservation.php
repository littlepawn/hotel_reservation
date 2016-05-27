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
    	#change{
    		margin-left: 100px;
    		margin-top: 20px;
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
                     <li><a tabindex="-1" href="?c=index&m=userinfo">查看个人信息</a></li>
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
                        <a href="">订单信息</a>
                    </li>
                 </ul>

                <?php
                    if(!empty($hotel)){
                        foreach ($hotel as $value) {
                ?>
                    <div class="row hotel-list">
                        <div class="col-md-2 picture">
                            <img class="img-thumbnail" src="<?php echo $value['image'];?>" alt="..." >
                        </div>
                        <div class="col-md-4">
                            <table class="table table-hover">
                                <tr><th><?php echo $value['title'];?></th></tr>
                                <tr><td><?php echo $value['content'];?></td></tr>
                            </table>
                        </div>
                        <div class="col-md-2">
                            <table class="table table-hover">
                                <tr><th>房型</th></tr>
                                <tr><td><?php echo $value['type'];?></td></tr>
                            </table>
                        </div>
                        <div class="col-md-2">
                            <table class="table table-hover">
                                <tr><th>价格</th></tr>
                                <tr><td>￥ <?php echo $value['price'];?></td></tr>
                            </table>
                        </div>
                        <div class="col-md-2">
                            <table class="table table-hover">
                                <tr><th><a class="btn btn-danger" href="?c=index&m=del_reservation&hid=<?php echo $value['_id'];?>&uid=<?php echo $_SESSION['user']['id']; ?>">取消订单</a></th></tr>
                            </table>
                        </div>
                     </div>
                <?php
                    }}
                ?>


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
