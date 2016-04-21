<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>连锁酒店预定系统</title>
    <link href="/public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
    	body {
    		padding-top: 50px;
    	}
		#carousel-info{
			margin: 10px auto;
    		padding: 20px;
		}
    	#location-info{
    		margin: 10px auto;
    		padding: 20px;
    		border: 1px solid #28A4FF;
    	}
		.house-info{
			margin: 20px auto;
		}
		#name{
    		margin-left: 120px;
    	}
    	.house-list{
    		margin-top: 20px;
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
                ?>
                <button type="button" id="login" class="btn btn-info navbar-btn navbar-right">
					登陆
				</button>
                <?php
                    }else{
                ?>
	      		<button type="button" class="btn btn-info navbar-btn navbar-right dropdown-toggle"  data-toggle="dropdown">
					<?php echo $_SESSION['user']['name']; ?><span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" id="name">
   					 <li><a tabindex="-1" href="?c=index&m=userinfo">查看个人信息</a></li>
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
			<div class="col-md-10"  id="carousel-info">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                  </ol>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                    <div class="item active">
                      <img src="/public/i/3.jpg" alt="...">
                      <div class="carousel-caption">
                        酒店推荐
                      </div>
                    </div>
                  </div>

                  <!-- Controls -->
                  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
			</div>
			<div class="col-md-1"></div>
		</div>
		<hr>

		<!-- 筛选 -->
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10"  id="location-info">
				<ul class="nav nav-tabs" role="tablist" id="mytab">
				  <li role="presentation" class="active"><a href="#xuzhou" role="tab" data-toggle="tab">徐州</a></li>
				  <li role="presentation" class="dropdown">
				    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
				    	其他地区 <span class="caret"></span>
				    </a>
				    <ul class="dropdown-menu" role="menu">
				      <li><a href="#beijing" role="tab" data-toggle="tab">北京</a></li>
				      <li><a href="#nanjing" role="tab" data-toggle="tab">南京</a></li>
				      <li><a href="#shanghai" role="tab" data-toggle="tab">上海</a></li>
				    </ul>
				  </li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane fade in active" id="xuzhou" >
						<label id="label" >酒店位置
							<a class="btn active" href="">全徐州</a>
							<a class="btn" href="">铜山</a>
							<a class="btn" href="">泉山</a>
							<a class="btn" href="">贾汪</a>
						</label>
						<br />
						<label>价格区间
							<a class="btn active" href="">不限</a>
							<a class="btn" href="">200以下</a>
							<a class="btn" href="">200-500</a>
							<a class="btn" href="">500-1000</a>
							<a class="btn" href="">1000以上</a>
						</label>
						<br />
						<label>酒店级别
							<a class="btn active" href="">不限</a>
							<a class="btn" href="">经济型</a>
							<a class="btn" href="">二星级</a>
							<a class="btn" href="">三星级</a>
							<a class="btn" href="">四星级及以上</a>
						</label>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="beijing">
						<label id="label">酒店位置
							<a class="btn active" href="">全北京</a>
							<a class="btn" href="">朝阳</a>
							<a class="btn" href="">东城</a>
							<a class="btn" href="">海淀</a>
						</label>
						<br />
						<label>价格区间
							<a class="btn active" href="">不限</a>
							<a class="btn" href="">200以下</a>
							<a class="btn" href="">200-500</a>
							<a class="btn" href="">500-1000</a>
							<a class="btn" href="">1000以上</a>
						</label>
						<br />
						<label>酒店级别
							<a class="btn active" href="">不限</a>
							<a class="btn" href="">经济型</a>
							<a class="btn" href="">二星级</a>
							<a class="btn" href="">三星级</a>
							<a class="btn" href="">四星级及以上</a>
						</label>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="nanjing">
						<label id="label">酒店位置
							<a class="btn active" href="">全南京</a>
							<a class="btn" href="">玄武</a>
							<a class="btn" href="">鼓楼</a>
							<a class="btn" href="">秦淮</a>
						</label>
						<br />
						<label>价格区间
							<a class="btn active" href="">不限</a>
							<a class="btn" href="">200以下</a>
							<a class="btn" href="">200-500</a>
							<a class="btn" href="">500-1000</a>
							<a class="btn" href="">1000以上</a>
						</label>
						<br />
						<label>酒店级别
							<a class="btn active" href="">不限</a>
							<a class="btn" href="">经济型</a>
							<a class="btn" href="">二星级</a>
							<a class="btn" href="">三星级</a>
							<a class="btn" href="">四星级及以上</a>
						</label>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="shanghai">
						<label id="label">酒店位置
							<a class="btn active" href="">全上海</a>
							<a class="btn" href="">浦东</a>
							<a class="btn" href="">黄浦</a>
							<a class="btn" href="">徐汇</a>
						</label>
						<br />
						<label>价格区间
							<a class="btn active" href="">不限</a>
							<a class="btn" href="">200以下</a>
							<a class="btn" href="">200-500</a>
							<a class="btn" href="">500-1000</a>
							<a class="btn" href="">1000以上</a>
						</label>
						<br />
						<label>酒店级别
							<a class="btn active" href="">不限</a>
							<a class="btn" href="">经济型</a>
							<a class="btn" href="">二星级</a>
							<a class="btn" href="">三星级</a>
							<a class="btn" href="">四星级及以上</a>
						</label>
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>

		<hr />
		<div class="col-md-1"></div>
		<div class="col-md-10 house-info">
			<div class="row">
			<?php
				foreach ($hotel as $key=>$value){
			?>
				<div class="col-md-3">
					<div class="thumbnail">
						<img src="/public/i/hotel/<?php echo ++$key?>.jpg" alt="...">
						<div class="caption">
							<h4><?php echo $value['title'] ?></h4>
							<p><?php echo $value['content'] ?></p>
							<p><a href="?c=hotel&m=hotel_info&hotel_id=<?php echo $value['_id'] ?>" class="btn btn-primary" role="button">查看</a> <a href="?c=index&m=reserve&id=<?php echo $value['_id']; ?>" class="btn btn-default" role="button">预订</a>
							</p>
						</div>
					</div>
				</div>
			<?php
				}
			?>
			</div>

		</div>
		<div class="col-md-1"></div>

		<div class="col-md-1"></div>
		<div class="col-md-8 col-md-offset-1">
			<nav>
			  <ul class="pagination">
			    <li><a href="#">&laquo;</a></li>
			    <li><a href="#">1</a></li>
			    <li><a href="#">&raquo;</a></li>
			  </ul>
			</nav>
		</div>
		<div class="col-md-2"></div>
	</div>

 	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
  <script type="text/javascript">
	  $(function () {
		  $('.carousel').carousel();
		  $("#login").click(function () {
			  window.location.href="?c=auth&m=login";
		  })
	  })

  </script>
  </body>
</html>
