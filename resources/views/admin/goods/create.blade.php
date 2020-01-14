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
    <script src="/static/admin/js/bootstrap.js"></script>

</head>
<body>
  <h3>商品添加</h3>
{{--第一种:验证唯一性和必填--}}
  {{--@if ($errors->any())--}}
    {{--<div class="alert alert-danger">--}}
      {{--<ul>--}}
        {{--@foreach ($errors->all() as $error)--}}
          {{--<li>{{ $error }}</li>--}}
        {{--@endforeach--}}
       {{--</ul>--}}
    {{--</div> @endif--}}
    <form class="form-horizontal" role="form" method="post" action="{{url('goods/store')}}" enctype="multipart/form-data">
      @csrf

        <ul id="myTab" class="nav nav-tabs">
            <li class="active">
                <a href="#home" data-toggle="tab">
                   基础信息
                </a>
            </li>
            <li><a href="#ios" data-toggle="tab">商品相册</a></li>
            <li><a href="#desc" data-toggle="tab">商品详情</a></li>

        </ul>

        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="home">
                <p> <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label">商品名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="firstname" placeholder="请输入品牌名称" name="goods_name" value="{{session('data')['brand_name']}}">
                        <b style="color:red"></b>
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">商品货号</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lastname" placeholder="请输品牌网址" name="goods_sn" value="{{session('data')['brand_url']}}">
                        <b style="color:red">{{ $errors->first('brand_url')}}</b>
                    </div>
                </div>


                <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label">商品品牌</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="firstname" placeholder="请输入品牌名称" name="brand_id">
                            <option value="">——请选择商品品牌——</option>
                            @foreach($brand as $v)
                                <option value="{{$v->brand_id}}">{{str_repeat('|-',$v->level)}}{{$v->brand_name}}</option>

                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="firstname" class="col-sm-2 control-label">商品分类</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="firstname" placeholder="请输入品牌名称" name="cate_id">
                            <option value="">——请选择商品分类——</option>
                            @foreach($category as $v)
                                <option value="{{$v->cate_id}}">{{str_repeat('|-',$v->level)}}{{$v->cate_name}}</option>

                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">商品价格</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lastname" placeholder="请输品牌logo" name="goods_price">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">商品库存</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="lastname" placeholder="请输品牌logo" name="goods_number">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">商品缩率图</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="lastname" placeholder="请输品牌logo" name="goods_img">
                    </div>
                </div>

                </p>
                </div>
            <div class="tab-pane fade" id="ios">
                <p>11111111111111111

                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">商品相册</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" multiple="multiple" id="lastname" placeholder="请输品牌logo" name="goods_imgs[]">
                    </div>
                </div>
                </p>
            </div>
            <div class="tab-pane fade" id="desc">
                <p>

                <div class="form-group">
                    <label for="lastname" class="col-sm-2 control-label">商品描述</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="lastname" placeholder="请输品牌的描述" name="content">{{session('data')['brand_name']}}</textarea>
                        <b style="color:red">{{ $errors->first('brand_desc')}}</b>
                    </div>
                </div>
                </p>
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

