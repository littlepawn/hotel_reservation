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
			padding-top: 5%;
		}
    	.house-info{
			margin: 20px auto;
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
					<img class="img-thumbnail" src="/public/i/hotel/3.jpg" alt="..." >
				</div>
				<div class="col-md-8">
					<div class="row">
						<form class="form-horizontal" role="form">
							<div class="form-group">
							   <label class="col-md-3 control-label">酒店名称</label>
							   <label class="col-md-9 control-label" id="rent" style="text-align: left;">如家快捷酒店</label>
							</div>

							<div class="form-group">
							   <label class="col-md-3 control-label">酒店简介</label>
							   <label class="col-md-9 control-label" id="allocation" style="text-align: left;">酒店预定</label>
							</div>

							<div class="form-group">
							   <label class="col-md-3 control-label">酒店地址</label>
							   <label class="col-md-9 control-label" id="" style="text-align: left;">江苏省徐州市铜山区上海路</label>
							</div>

							<div class="form-group">
							   <label class="col-md-3 control-label">住户评价</label>
							   <label class="col-md-3 control-label" id="username" style="text-align: left;color: red">4.5分</label>
							</div>
						</form>
					</div>
				</div>
			</div>
			<hr />
			<div class="row">
				<div class="house-info">
					<ul class="nav nav-tabs" role="tablist" id="mytab">
					  <li role="presentation" class="active"><a href="">酒店预定</a></li>
					</ul>
					
					<div class="row" id="hotel-list">
						<div class="col-md-2">
							<img class="img-thumbnail" src="/public/i/hotel/1.jpg" alt="..." >
							<label class="control-label col-md-offset-3">大床房</label>
						</div>
						<div class="col-md-8">
							<table class="table table-hover">
								<tr><td>面积 10平方</td></tr>
								<tr><td>5层</td></tr>
								<tr><td>独卫</td></tr>
								<tr><td>200元/间</td></tr>
							</table>
						</div>
						<div class="col-md-2">
							<a class="btn btn-primary btn-block" href="?c=index&m=reserve&id=1">预定</a>
						</div>
					</div>

					<div class="row" id="hotel-list">
						<div class="col-md-2">
							<img class="img-thumbnail" src="/public/i/hotel/2.jpg" alt="..." >
							<label class="control-label col-md-offset-3">单人房</label>
						</div>
						<div class="col-md-8">
							<table class="table table-hover">
								<tr><td>面积 8平方</td></tr>
								<tr><td>5层</td></tr>
								<tr><td>独卫</td></tr>
								<tr><td>150元/间</td></tr>
							</table>
						</div>
						<div class="col-md-2">
							<a class="btn btn-primary btn-block">预定</a>
						</div>
					</div>

				</div>
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
                placeSearch.search("江苏师范大学");
            });
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

