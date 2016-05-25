<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="public/lib/html5.js"></script>
<script type="text/javascript" src="public/lib/respond.min.js"></script>
<script type="text/javascript" src="public/lib/PIE_IE678.js"></script>
<![endif]-->
<!--<link href="public/css/H-ui.min.css" rel="stylesheet" type="text/css" />-->
<!--<link href="public/css/H-ui.admin.css" rel="stylesheet" type="text/css" />-->
<link href="public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!--<link href="public/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />-->
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script type="text/javascript" src="public/js/bootstrap.min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]--><title>管理用户</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <table class="table table-hover">
        <tr>
          <th>用户id</th>
          <th>用户名</th>
          <th>邮箱</th>
          <th>头像</th>
          <th>操作</th>
        </tr>
        <?php
          foreach($users as $user){
        ?>
        <tr>
          <td><?php echo $user['_id'];?></td>
          <td><?php echo $user['username'];?></td>
          <td><?php echo $user['email'];?></td>
          <td><img class="thumbnail" src="<?php echo empty($user['avatar'])?"/public/i/default.jpg":$user['avatar'];
            ?>" width="10%" height="10%"></td>
          <td><a class="btn btn-danger">删除</a></td>
        </tr>
        <?php } ?>
      </table>
    </div>
  </div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/H-ui.js"></script>
<script type="text/javascript" src="js/H-ui.admin.js"></script>
</body>
</html>