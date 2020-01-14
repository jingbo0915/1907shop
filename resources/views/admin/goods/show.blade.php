<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{$goods->goods_name}}</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h1>商品的详情页</h1>
    <h3>详情页访问量：{{$current}}</h3>
<h3 class="goods_id">商品id：{{$goods->goods_id}}</h3>
<h3 >商品名称：{{$goods->goods_name}}</h3>
<h3>商品介绍：{{$goods->content}}</h3>
<h3>商品价格：{{$goods->goods_price}}</h3>
<h3>商品货号：{{$goods->goods_sn}}</h3>
<h3>添加时间：{{date('Y-m-d H:i:s',$goods->add_time)}}</h3>
<button >购买</button>
</body>
<script>

    $(document).on('click','button',function(){

        var goods_id={{$goods->goods_id}};

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }});
        $.post(
                "{{url('goods/addcart')}}",
                {goods_id:goods_id},
                function(res){
                    if(res.code='00001'){
                        alert(res.msg);
                        location.href = '/login';
                    }

                    if(res.code='00002'){
                        alert(res.msg);
                    }
                    if(res.code='00000'){
                        alert(res.msg);
                        location.href = '/cart';
                    }
                },'json' );



    });

</script>
</html>