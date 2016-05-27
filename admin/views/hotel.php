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
<title>管理酒店</title>
</head>
<body>
  <div class="container">
    <br>
    <div class="row">
      <div class="col-md-2 col-md-offset-10">
        <a class="btn btn-primary btn-block" href="?c=admin&m=add_hotel">添加酒店</a>
      </div>
    </div>
    <br>

    <div class="row">
      <table class="table table-hover">
        <tr>
          <th>酒店id</th>
          <th>酒店标题</th>
          <th>酒店内容</th>
          <th>酒店地址</th>
          <th>酒店图片</th>
          <th>酒店最低价格</th>
          <th>操作</th>
        </tr>
        <?php
          foreach($hotels as $hotel){
        ?>
        <tr>
          <td><?php echo $hotel['_id'];?></td>
          <td><?php echo $hotel['title'];?></td>
          <td><?php echo $hotel['content'];?></td>
          <td><?php echo $hotel['address'];?></td>
          <td><img class="thumbnail" src="<?php echo empty($hotel['image'])?"/public/i/default.jpg":$hotel['image'];
            ?>" ></td>
            <td>￥ <?php echo $hotel['low_price'];?></td>
          <td>
            <a class="btn btn-success" href="?c=admin&m=add_apartment&hid=<?php echo $hotel['_id'];?>">添加房型</a><br>
            <a class="btn btn-danger" href="?c=admin&m=del_hotel&hid=<?php echo $hotel['_id'];?>">删除</a>
          </td>
        </tr>
        <?php } ?>
      </table>
    </div>
  </div>
<script type="text/javascript" src="public/js/jquery.min.js"></script>
</body>
</html>