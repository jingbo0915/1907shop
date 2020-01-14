<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">

</head>
<body>
<h3>品牌修改</h3>
<form class="form-horizontal" role="form" method="post" action="{{url('/brand/update/'.$data->brand_id)}}">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
        <div class="col-sm-10">
            <input type="text"  value="{{$data->brand_name}}" class="form-control" id="firstname" placeholder="请输入品牌名称" name="brand_name">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
        <div class="col-sm-10">
            <input type="text"   value="{{$data->brand_url}}" class="form-control" id="lastname" placeholder="请输品牌网址" name="brand_url">
        </div>
    </div>
    {{--<div class="form-group">--}}
        {{--<label for="lastname" class="col-sm-2 control-label">品牌logo</label>--}}
        {{--<div class="col-sm-10">--}}
            {{--<input type="file"  class="form-control" id="lastname" placeholder="请输品牌logo" name="brand_logo">--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌描述</label>
        <div class="col-sm-10">
            <textarea type="text" class="form-control"   id="lastname" placeholder="请输品牌的描述" name="brand_desc"> {{$data->brand_desc}}</textarea>

        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox">请记住我
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">提交</button>
        </div>
    </div>
</form>
</body>
</html>