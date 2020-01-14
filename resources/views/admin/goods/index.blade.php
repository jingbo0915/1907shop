<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">21
    <script src="/static/admin/js/jquery.js"></script>
</head>
<body>
        <h3>商品列表</h3>
        <h3>欢迎【{{session('admin')->u_name??''}}】登录，<a href="{{url('/logout')}}">退出</a></h3>

        <form action="">
            <input type="text" name="word" placeholder="请输入商品名称关键字" value="{{$query['word']??''}}">
            <input type="text" name="desc" placeholder="请输入品牌名称关键字" value="{{$query['desc']??''}}">

            <button>搜索</button>
        </form>
        <br><br>
        <table class="table table-striped">
            <a href="{{url('goods/create')}}">添加</a>
            <caption>条纹表格布局</caption>
            <thead>
            @csrf
            <tr>
                <th>ID</th>
                <th>货号</th>
                <th>商品名称</th>
                <th>品牌名称</th>
                <th>分类名称</th>
                <th>添加时间</th>
                <th>商品价格</th>
                <th>相册列表</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $v)
            <tr>
                <td>{{$v->goods_id}}</td>
                <td>{{$v->goods_sn}}</td>
                <td>{{$v->goods_name}}</td>
                <td>{{$v->brand_name}}</td>
                <td>{{$v->cate_name}}</td>
                <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
                <td>{{$v->goods_price}}</td>
                @if($v->goods_imgs)
                @foreach ($v->goods_imgs as $vv)
                    <td><img src="{{env('UPLOAD_URL')}}{{$vv}}" width="50" alt=""></td>
                @endforeach
                @endif
                <td><a href="{{url('/goods/show/'.$v->goods_id)}}" class="btn btn-success">预览</a>|<a href="{{url('/goods/edit/'.$v->goods_id)}}" class="btn btn-success">编辑</a>|<a href="{{url('/goods/del/'.$v->goods_id)}}" class="btn btn-danger">删除</a></td>
            </tr>
            </tr>
            @endforeach
            <tr>
                <td colspan="4"> {{$data->links()}}</td>
            </tr>>

            </tbody>
        </table>s

        </body>
        </html>
</body>
</html>
<script>
    //ajax 分页
    $(function(){
        $(document).on("click",'.pagination a',function(){
            var url =$(this).attr('href');
            $.get(url,function(res){
                $('tbody').html(res);
            });
            return false;


        });
    })

</script>