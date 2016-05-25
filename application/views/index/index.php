<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>连锁酒店预定系统</title>
    <link href="/public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="/public/style/list.css"/>
	<link rel="stylesheet" type="text/css" href="/public/style/manhuaDate.1.0.css"/><script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
	<script src="/public/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/public/js/jquery-1.5.1.js"></script><!--日期控件，JS库版本不能过高否则tab会失效-->

	<script type="text/javascript" src="/public/js/ui.tab.js"></script>
	<script type="text/javascript">
	<!--选项卡切换-->
	$(document).ready(function(){
		var tab = new $.fn.tab({
			tabList:"#demo1 .ui-tab-container .ui-tab-list li",
			contentList:"#demo1 .ui-tab-container .ui-tab-content"
		});
		var tab = new $.fn.tab({
			tabList:"#demo1 .ui-tab-container .ui-tab-list2 li",
			contentList:"#demo1 .ui-tab-container .ui-tab-content2"
		});
	});
	</script>

	<script type="text/javascript" src="/public/js/datejs.js"></script>
	<script type="text/javascript">
	<!--日历选择器-->
	$(function (){
		$("input.mh_date").datejs({
			Event : "click",//可选
			Left : 0,//弹出时间停靠的左边位置
			Top : -16,//弹出时间停靠的顶部边位置
			fuhao : "-",//日期连接符默认为-
			isTime : false,//是否开启时间值默认为false
			beginY : 2010,//年份的开始默认为1949
			endY :2015//年份的结束默认为2049
		});
	});
	</script>

	<script type="text/javascript">
	<!--点击更多-->
	$(document).ready(function(e){
		$("#selectList").find(".more").toggle(function(){
			$(this).addClass("more_bg");
			$(".more-none").show()
		},function(){
			$(this).removeClass("more_bg");
			$(".more-none").hide();
		});
	});
	</script>


    <style type="text/css">
    	body {
    		padding-top: 50px;
    	}
		.house-info{
			margin: 5px auto;
		}
		#name{
    		margin-left: 120px;
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

		<!-- 筛选 -->
		<div class="row">
			<div style="width:1150px;margin:20px auto 0 auto;">
				<div class="list-screen">
					<div class="screen-top" style="position:relative;">
						<span>目的地<input id="txtadress" type="text"/></span>
						<span>入住<input type="text" class="mh_date" readonly="true" /></span>
						<span>退房<input type="text" class="mh_date" readonly="true" /></span>
						<span>酒店名称<input type="text" class="ju-name" /></span>
						<a href="#" id="submit-btn"/>搜索</a>
					</div>

					<div style="padding:10px 30px 10px 10px;">
						<div class="screen-address">
							<div class="list-tab">
								<div id="demo1" class="clearfix">
									<div class="jiud-name">酒店位置</div>
									<div class="ui-tab-container">
										<ul class="clearfix ui-tab-list">
											<li class="ui-tab-active">行政区</li>
<!--											<li>交通枢纽</li>-->
<!--											<li>地铁周边</li>-->
<!--											<li>行政区</li>-->
										</ul>
										<div class="ui-tab-bd">

											<div id=“area” class="ui-tab-content clearfix">
												<?php
													foreach ($areas as $area) {
												?>
														<p><label><input name="tabrad1" type="radio"
																		 value=""/><?php echo
																$area['area'];?></label></p>
												<?php
													}
												?>
											</div>


										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="screen-term">
							<div class="selectNumberScreen">
								<div id="selectList" class="screenBox screenBackground">
									<dl class="listIndex">
										<dt>酒店价格</dt>
										<dd>
											<label><a href="javascript:;" attrval="不限">不限</a></label>
											<label><input name="radio2" type="radio" value="" /><a href="javascript:;" values2="99" values1="1" attrval="1-99">100元以下</a></label>
											<label><input name="radio2" type="radio" value="" /><a href="javascript:;" values2="300" values1="100" attrval="100-300">100-300元 </a></label>
											<label><input name="radio2" type="radio" value="" /><a href="javascript:;" values2="600" values1="300" attrval="300-600">300-600元</a></label>
											<label><input name="radio2" type="radio" value="" /><a href="javascript:;" values2="1500" values1="600" attrval="5000以上">600-1500元</a></label>
										</dd>
									</dl>
									<dl class="listIndex">
										<dt>酒店星级</dt>
										<dd>
											<label><a href="javascript:;" attrval="不限">不限</a> </label>
											<label><input name="checkbox2" type="checkbox" value="" /><a href="javascript:;"> 五星/豪华</a></label>
											<label><input name="checkbox2" type="checkbox" value="" /><a href="javascript:;">四星/高档</a></label>
											<label><input name="checkbox2" type="checkbox" value="" /><a href="javascript:;">三星/舒适</a></label>
										</dd>
									</dl>
								</div>
							</div>
						</div>
					</div>

					<div class="hasBeenSelected clearfix">
						<span id="time-num"><font><?php echo count($hotels);?></font>家酒店</span>
						<div style="float:right;" class="eliminateCriteria">【清空全部】</div>
						<dl>
							<dt>已选条件：</dt>
							<dd style="display:none" class="clearDd">
								<div class="clearList"></div>
							</dd>
						</dl>
					</div>

					<script type="text/javascript" src="/public/js/shaixuan.js"></script>

				</div>

			</div>
		</div>

		<hr />
		<div class="panel panel-default">
		  <div class="panel-heading">
			<h3 class="panel-title"><?php echo count($hotels);?>个酒店满足排序</h3>
		  </div>
		  <div class="panel-body">
			默认排序
		  </div>
		</div>
<!--		<div class="col-md-1"></div>-->
		<div class="col-md-11 house-info">
			<div class="row house-list">
				<div class="col-md-2 picture">
					<img class="img-thumbnail" width="100%" height="100%" src="/public/i/1.jpg" alt="..." >
				</div>
				<div class="col-md-6">
					<table class="table table-hover">
						<tr><th><a style="text-decoration: none" href="#" id="torentinfo">xxxx</a></th></tr>
						<tr><td>位置</td></tr>
						<tr><td>Data</td></tr>
					</table>
				</div>
				<div class="col-md-2">
					<table class="table table-hover">
						<tr><th>xxxx</th></tr>
						<tr>xxx</td></tr>
					</table>
				</div>
				<div class="col-md-2">
					<table class="table table-hover">
						<tr><th>xxxx</th></tr>
						<tr>xxx</td></tr>
					</table>
				</div>
			</div>


<!--		<div class="col-md-1"></div>-->
		<div class="row">
<!--			<div class="col-md-1"></div>-->
			<div class="col-md-8">
				<nav>
				  <ul class="pagination">
					<li><a href="#">&laquo;</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">&raquo;</a></li>
				  </ul>
				</nav>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>

<!-- 	<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>-->

    <script type="text/javascript">
	  $(function () {
		  $("#login").click(function () {
			  window.location.href="?c=auth&m=login";
		  })
	  })

  </script>
  </body>
</html>
