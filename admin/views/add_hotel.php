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
            <h2 class="col-md-offset-2">添加酒店信息</h2><br>

            <form class="form-horizontal" role="form" action="?c=admin&m=publish_hotel" method="post"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <label class="control-label col-md-2">酒店标题</label>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="title">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">酒店描述</label>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="content">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">酒店地址</label>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="address">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">房间最低价格</label>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="low_price">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">城市</label>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="city" id="city">
                        <input type="hidden" name="cityID" id="cityID">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">地区</label>
                    <div class="col-md-6">
                        <select name="areaID" class="form-control" id="area">

                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-md-2">酒店图片</label>

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
    $(document).ready(function () {
        $("#city").blur(function () {
            var city=$("#city").val();
            if(city.length!=0){
//                 alert(city);
                $.ajax({
                    type:"get",
                    dataType: 'json',
                    data:{city:city},
                    url:"?c=admin&m=get_area",
                    success: function (data) {
                        if(data.result==0){
                            alert("城市不存在");
                        }else{
                            var areas=data.areas;
                            var len=areas.length;
                            $("#area").html("");
                            var html="";
                            for(var i=0;i<len;i++){
                                html=html+"<option value='"+areas[i].areaID+"'>"+areas[i].area+"</option>";
                            }
                            $("#area").html(html);
                            $("#cityID").val(areas[0].fatherID);
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }
        })
    })
</script>
</body>
</html>