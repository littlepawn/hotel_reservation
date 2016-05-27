<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link href="public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="public/js/bootstrap.min.js"></script>
    <title>添加酒店</title>
</head>
<body>
<div class="container">
    <br>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2 class="col-md-offset-2">添加房间信息</h2><br>

            <form class="form-horizontal" role="form" action="?c=admin&m=publish_apartment" method="post"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-md-2">房间类型</label>
                    <div class="col-md-6">
                        <select class="form-control" name="type">
                            <option value="1">标间</option>
                            <option value="2">大床房</option>
                            <option value="3">商务房</option>
                            <option value="4">家庭房</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">房间标题</label>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="title">
                        <input type="hidden" name="hotel_id" value="<?php echo $hid;?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">房间描述</label>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="desp">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">房间价格</label>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="price">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">房间图片</label>

                    <div class="col-md-6">
                        <input class="form-control" type="file" name="image">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-1"></div>
                    <div class="col-md-5 col-md-offset-1">
                        <input class="btn btn-info btn-lg btn-block" type="submit" value="保存"/>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="public/js/jquery.min.js"></script>
<script>
</script>
</body>
</html>