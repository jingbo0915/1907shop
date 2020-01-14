<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery.js"></script>
</head>
<body>
        <h3>品牌列表</h3>
        <h3>欢迎【{{session('admin')->u_name??''}}】登录，<a href="{{url('/logout')}}">退出</a></h3>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Bootstrap 实例 - 条纹表格</title>
            <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
            <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        </head>
        <body>
        <form action="">
            <input type="text" name="word" placeholder="请输入名称关键字" value="{{$query['word']??''}}">
            <input type="text" name="desc" placeholder="请输入描述关键字" value="{{$query['desc']??''}}">

            <button>搜索</button>
        </form>
        <br><br>
        <table class="table table-striped">
            <a href="{{url('brand/create')}}">添加</a>
            <caption>条纹表格布局</caption>
            <thead>
            @csrf
            <tr>
                <th>ID</th>
                <th>名称</th>
                <th>网址</th>
                <th>描述</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $v)
            <tr>
                <th>{{$v->brand_id}}</th>
                <td><img src="{{env('UPLOAD_URL')}}{{$v->brand_logo}}" width="100"/>{{$v->brand_name}}</td>
                <td>{{$v->brand_url}}</td>
                <td>{{$v->brand_desc}}</td>
                <td><a href="{{url('/brand/edit/'.$v->brand_id)}}" class="btn btn-success">编辑</a>|<a href="{{url('/brand/del/'.$v->brand_id)}}" class="btn btn-danger">删除</a></td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4"> {{$data->appends($query)->links()}}</td>
            </tr>>

            </tbody>
        </table>

        </body>
        </html>
</body>
</html>
<script>
//    //ajax 分页
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