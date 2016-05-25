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

    #name{
    	margin-left: 120px;
    }

    #info{
    	margin: 7% auto;
			margin-bottom: 0%;
    }

		#head-info{
			padding: 20px;
			border: 1px solid #66ccff;
		}

		#map{
			margin-top: 7%;
		}

		#hotel-list{
			padding-top: 10px;
      padding-bottom: 10px;
      border: 1px solid rgba(0, 0, 0, 0.1);
		}

    .house-info{
			margin: 20px auto;
		}

    .room-img{
      max-width: 120%;
    }

    #panel{
      /*position: absolute;*/
      background-color: white;
      max-height: 90%;
      overflow-y: auto;
      top: 10px;
      right: 10px;
      width: 280px;
    }
    </style>
  </head>
  <body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		  <div class="container">
		    <div class="row">
		    	<div class="col-md-10">
		      		<a class="navbar-brand" href="?c=index&m=index">
		        		<p>连锁酒店预定系统</p>
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
                         <li><a tabindex="-1" href="?c=index&m=index">返回主页</a></li>
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

		<div class="col-md-1"></div>
		<div class="col-md-8" id="info">
			<div class="row" id="head-info">
				<h1>酒店预定</h1>
				<hr />
				<div class="col-md-4">
					<img class="img-thumbnail" src="<?php echo $hotel['image']?>" alt="..." >
				</div>
				<div class="col-md-8">
					<div class="row">
						<form class="form-horizontal" role="form">
							<div class="form-group">
							   <label class="col-md-3 control-label">酒店名称</label>
							   <label class="col-md-9 control-label" id="rent" style="text-align: left;"><?php echo $hotel['title']?></label>
							</div>

							<div class="form-group">
							   <label class="col-md-3 control-label">酒店简介</label>
							   <label class="col-md-9 control-label" id="allocation" style="text-align: left;"><?php
								   echo $hotel['content']?></label>
							</div>

							<div class="form-group">
							   <label class="col-md-3 control-label">酒店地址</label>
							   <label class="col-md-9 control-label" id="" style="text-align: left;"><?php echo
								   $hotel['address']?></label>
							</div>

							<div class="form-group">
							   <label class="col-md-3 control-label">用户评论</label>
							   <label class="col-md-3 control-label" id="username" style="text-align: left;"><?php echo count($comments);?> 条</label>
							</div>
						</form>
					</div>
				</div>
			</div>
			<hr />
			<div class="row">
				<div class="house-info">
					<ul class="nav nav-tabs" role="tablist" id="mytab">
					  <li role="presentation" class="active"><a href="">房间信息</a></li>
					</ul>
					<?php
						foreach($apartments as $apartment){
					?>
          <div class="row" id="hotel-list">
            <div class="col-md-2">
              <img class="img-thumbnail room-img" src="/public/i/hotel/1.jpg" alt="..." >
            </div>
            <div class="col-md-8">
              <div>
                <div>
                  <h2><?php $apartment['title']; ?></h2>
                </div>
                <div>
                  <?php echo $apartment['type'];?> | <?php echo $apartment['desp'];?>
                </div>
              </div>
            </div>
            <div class="col-md-2">
              <div>
                <h3>¥ <?php echo $apartment['price'];?>起</h3>
              </div>
              <div>
                <a class="btn btn-danger btn-block" href="javascript:;" onclick="reserve(<?php echo $hotel['_id']?>,<?php echo $apartment['_id'];?>)">预定</a>
              </div>
            </div>
          </div>
					<?php } ?>
				</div>
			</div>

			<div class="row">
				<div class="house-info">
					<ul class="nav nav-tabs" role="tablist" id="mytab">
					  <li role="presentation" class="active"><a href="">评论列表</a></li>
					</ul>
					<?php
						foreach($comments as $comment){
					?>
					<div class="row" id="hotel-list">
						<div class="col-md-2">
							<img class="img-thumbnail" src="<?php echo $comment['avatar']?>" alt="..." >
						</div>
						<div class="col-md-8">
							<table class="table table-hover">
								<tr><td><?php echo $comment['username']."---------".$comment['create_time'];
										?></td></tr>
								<tr><td><?php echo $comment['text'];?></td></tr>
							</table>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>

			<div class="row">
				<form action="?c=hotel&m=comment" method="post" role="form" onsubmit="return checkstatus();">
				    <div class="form-group">
					    <label for="name">发表评论</label>
						<input type="hidden" value="<?php echo $hotel['_id'];?>" name="hid">
					    <textarea class="form-control" rows="3" name="comment" id="comment"></textarea>
						<br>
					    <input class="btn btn-primary" type="submit" value="确认提交">
				  </div>
				</form>
			</div>

		</div>
		<div class="col-md-3" id="map">
			<div id="container"></div>
			<div id="panel"></div>
		</div>
	</div>

 	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=19401d59432c303c1d55f7a724355255"></script>
    <script type="text/javascript" src="http://cache.amap.com/lbs/static/addToolbar.js"></script>
    <script type="text/javascript">
		function initialize() {
			var map = new AMap.Map("container", {
            	resizeEnable: true
        	});
			AMap.service(["AMap.PlaceSearch"], function() {
                var placeSearch = new AMap.PlaceSearch({ //构造地点查询类
                    pageSize: 5,
                    pageIndex: 1,
                    city: "0515", //城市
                    map: map,
                    panel: "panel"
                });
                //关键字查询
                placeSearch.search("<?php echo $hotel['title'];?>");
            });
		}
		function reserve(){
			var flag="<?php echo isset($_SESSION['user'])?true:false;?>";
			if(flag){
				alert("预定成功");
			}else{
				alert("登陆后才能预定");
			}
		}

		function checkstatus(){
			var flag="<?php echo isset($_SESSION['user'])?true:false;?>";
			if(!flag){
				alert("登陆后才能评论");
				return false;
			}else{
				var comment=$("#comment").val();
				if(comment.length==0){
					alert("评论不能为空");
				return false;
				}
			}
			return true;
		}

        $(function () {
			initialize();
			$("#login").click(function () {
				  window.location.href="?c=auth&m=login";
			  })

        })

    </script>
  </body>
</html>
