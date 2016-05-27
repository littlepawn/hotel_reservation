<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link href="public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="public/js/bootstrap.min.js" ></script>
<title>管理套间</title>
</head>
<body>
  <div class="container">

    <div class="row">
      <table class="table table-hover">
        <tr>
          <th>套间id</th>
          <th>套间类型</th>
          <th>套间描述</th>
          <th>套间价格</th>
          <th>套间图片</th>
          <th>套间所属酒店</th>
          <th>操作</th>
        </tr>
        <?php
          foreach($apartments as $apartment){
        ?>
        <tr>
          <td><?php echo $apartment['_id'];?></td>
          <td><?php echo $apartment['type'];?></td>
          <td><?php echo $apartment['desp'];?></td>
          <td>￥ <?php echo $apartment['price'];?></td>
          <td><img class="thumbnail" src="<?php echo empty($apartment['image'])?"/public/i/default.jpg":$apartment['image'];?>" width="100px" height="80px"></td>
          <td><?php echo $apartment['hotel'];?></td>
          <td><a class="btn btn-danger" href="?c=admin&m=del_apartment&aid=<?php echo $apartment['_id'];?>">删除</a></td>
        </tr>
        <?php } ?>
      </table>
    </div>
  </div>
<script type="text/javascript" src="public/js/jquery.min.js"></script>
</body>
</html>