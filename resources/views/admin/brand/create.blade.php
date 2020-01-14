<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
  <script src="/static/admin/js/jquery.js"></script>

</head>
<body>
  <h3>品牌添加</h3>
{{--第一种:验证唯一性和必填--}}
  {{--@if ($errors->any())--}}
    {{--<div class="alert alert-danger">--}}
      {{--<ul>--}}
        {{--@foreach ($errors->all() as $error)--}}
          {{--<li>{{ $error }}</li>--}}
        {{--@endforeach--}}
       {{--</ul>--}}
    {{--</div> @endif--}}
    <form class="form-horizontal" role="form" method="post" action="{{url('brand/store')}}" enctype="multipart/form-data">
      @csrf
        <div class="form-group">
          <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="firstname" placeholder="请输入品牌名称" name="brand_name" value="{{session('data')['brand_name']}}">
            <b style="color:red">{{ $errors->first('brand_name')}}</b>
          </div>
        </div>
        <div class="form-group">
          <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="lastname" placeholder="请输品牌网址" name="brand_url" value="{{session('data')['brand_url']}}">
            <b style="color:red">{{ $errors->first('brand_url')}}</b>
          </div>
        </div>
        <div class="form-group">
          <label for="lastname" class="col-sm-2 control-label">品牌logo</label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="lastname" placeholder="请输品牌logo" name="brand_logo">
          </div>
        </div>
        <div class="form-group">
          <label for="lastname" class="col-sm-2 control-label">品牌描述</label>
          <div class="col-sm-10">
            <textarea type="text" class="form-control" id="lastname" placeholder="请输品牌的描述" name="brand_desc">{{session('data')['brand_name']}}</textarea>
            <b style="color:red">{{ $errors->first('brand_desc')}}</b>
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
            <button type="button" class="btn btn-default">提交</button>
          </div>
        </div>
      </form>

</body>
          <script>
         

                  $('input[name="brand_name"]').blur(function(){
                    var brand_name=$('input[name="brand_name"]').next().text('');
                    var brand_name =$('input[name="brand_name"]').val();
                      checkName(brand_name)

                      });
                    $('input[name="brand_url"]').blur(function(){
                      var brand_url=$(this).next().text('');
                      var brand_url=$(this).val();
                        checkUrl(brand_url)
                  });

                  function checkName(brand_name) {
                      var flag = true;
                      var reg = /^[\u4e00-\u9fa5\w.\-]{1,16}$/;
                      //alert(reg.test(brand_name));
                      if (!reg.test(brand_name)) {
                          $('input[name="brand_name"]').next().text('品牌名称需要是中文‘字母下划线“.和-”组成，长度为1-16为数');
                          return false;
                      }

                      //ajax验证唯一性
//                      $.get('/brand/checkOnly',{brand_name:brand_name},function(res){
//                          if(res!=0){
//                              $('input[name="brand_name"]').next().text('品牌名称真的已存在');
//                          }
//                      })


//                          $.ajaxSetup({
//                              headers: {
//                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                              }
//                          });
//

                      $.ajax({
                          method: "get",
                          url: "/brand/checkOnly/",
                          data: {brand_name: brand_name},
                          async: false
                      }).done(function (res) {
                          if (res != 0) {
                              $('input[name="brand_name"]').next().text('品牌名称已经存在');
                              flag = false;
                          }

                      })
                      return flag;
                  }

                  function checkUrl(brand_url){
                      var reg=/^http:\/\/*/;
                      if(!reg.test(brand_url)){
                          $('input[name="brand_url"]').next().text('品牌网址开头需以http');
                          return false;
                      }
                      return true;
                  }

                  //提交验证
              $('[type="button"]').click(function() {
                  //名称验证
                  var brand_name = $('input[name="brand_name"]').next().text('');
                  var brand_name = $('input[name="brand_name"]').val();
                  var nameflag=checkName(brand_name);

                  //网址验证
                  var brand_url = $('input[name="brand_url"]').next().text('');

                  var brand_url = $('input[name="brand_url"]').val();

                  var urlflag=checkUrl(brand_url);
                 // alert(nameflag);
                 // alert(urlflag)
                  if(nameflag==true  && urlflag==true){
                      $('form').submit();
                  }

              })






          </script>
</html>

