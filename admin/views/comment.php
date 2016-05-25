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
<title>管理商家</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <table class="table table-hover">
        <tr>
          <th>评论id</th>
          <th>评论用户</th>
          <th>评论酒店</th>
          <th>评论内容</th>
          <th>评论时间</th>
          <th>操作</th>
        </tr>
        <?php
          foreach($comments as $comment){
        ?>
        <tr>
          <td><?php echo $comment['_id'];?></td>
          <td><?php echo $comment['username'];?></td>
          <td><?php echo $comment['title'];?></td>
          <td><?php echo $comment['text'];?></td>
          <td><?php echo $comment['create_time'];?></td>
          <td><a class="btn btn-danger" href="?c=admin&m=del_comment&cid=<?php echo $comment['_id'];?>">删除</a></td>
        </tr>
        <?php } ?>
      </table>
    </div>
  </div>
<script type="text/javascript" src="public/js/jquery.min.js"></script>
</body>
</html>