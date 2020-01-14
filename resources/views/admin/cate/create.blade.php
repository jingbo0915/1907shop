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
  <h3>分类添加</h3>
{{--第一种:验证唯一性和必填--}}
  {{--@if ($errors->any())--}}
    {{--<div class="alert alert-danger">--}}
      {{--<ul>--}}
        {{--@foreach ($errors->all() as $error)--}}
          {{--<li>{{ $error }}</li>--}}
        {{--@endforeach--}}
       {{--</ul>--}}
    {{--</div> @endif--}}
    <form class="form-horizontal" role="form" method="post" action="{{url('cate/store')}}" enctype="multipart/form-data">
      @csrf
        <div class="form-group">
          <label for="firstname" class="col-sm-2 control-label">父级分类</label>
          <div class="col-sm-10">
            <select class="form-control" id="firstname" placeholder="请输入品牌名称" name="parent_id">
                    <option value="">——请选择父类——</option>
              @foreach($data as $v)
                    <option value="{{$v->cate_id}}">{{str_repeat('|-',$v->level)}}{{$v->cate_name}}</option>

                @endforeach
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="lastname" class="col-sm-2 control-label" >分类名称</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="cate_name" value="{{session('data')['cate_name']}}">
            <b style="color:red">{{ $errors->first('brand_url')}}</b>
          </div>
        </div>
        <div class="form-group">
          <label for="lastname" class="col-sm-2 control-label">是否显示</label>
          <div class="col-sm-10">
            <input type="radio"  id="lastname"  value="1" name="is_show"  checked>是


            <input type="radio"  id="lastname"  value="2" name="is_show">否
          </div>
        </div>
        <div class="form-group">
          <label for="lastname" class="col-sm-2 control-label">是否导航栏显示</label>
          <div class="col-sm-10">
            <input type="radio"  id="lastname"  value="1" name="is_nav_show" >是
            <input type="radio"  id="lastname"  value="2" name="is_nav_show" checked>否
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