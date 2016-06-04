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
          <th>订单id</th>
          <th>酒店名称</th>
          <th>预订房型</th>
          <th>预订用户</th>
          <th>酒店图片</th>
          <th>操作</th>
        </tr>
        <?php
          foreach($reservations as $reservation){
        ?>
        <tr>
          <td><?php echo $reservation['rid'];?></td>
          <td><?php echo $reservation['title'];?></td>
          <td><?php echo $reservation['type'];?></td>
          <td><?php echo $reservation['username'];?></td>
          <td><img class="thumbnail" src="<?php echo empty($reservation['image'])?"/public/i/default.jpg":$reservation['image'];?>" width="100px" height="80px"></td>
          <td><a class="btn btn-danger" href="?c=admin&m=del_reservation&rid=<?php echo $reservation['rid'];?>">删除</a></td>
        </tr>
        <?php } ?>
      </table>
    </div>
  </div>
<script type="text/javascript" src="public/js/jquery.min.js"></script>
</body>
</html>