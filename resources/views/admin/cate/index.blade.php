<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery.js"></script>
</head>
<body>
        <h3>分类列表</h3>
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

        <br><br>
        <table class="table table-striped">
            <a href="{{url('brand/create')}}">添加</a>
            <caption>条纹表格布局</caption>
            <thead>
            @csrf
            <tr>
                <th>ID</th>
                <th>名称</th>
                <th>是否显示</th>
                <th>是否导航显示</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $v)
            <tr>
                <th>{{$v->cate_id}}</th>
                <td>@php echo str_repeat('|-|-',$v->level); @endphp {{$v->cate_name}}</td>
                <td>@if($v->is_show==1)√ @else × @endif</td>
                <td>{{$v->is_nav_show==1?'√':'×'}}</td>
                <td><a href="{{url('/cate/edit/'.$v->cate_id)}}" class="btn btn-success">编辑</a>|<a href="{{url('/cate/del/'.$v->cate_id)}}" class="btn btn-danger">删除</a></td>
            </tr>
            @endforeach

            </tbody>
        </table>

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