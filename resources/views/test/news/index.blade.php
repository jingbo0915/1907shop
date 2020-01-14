<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="/static/admin/js/jquery.js"></script>
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
</head>
<body>
        <h3>新闻信息展示</h3>
        <a href="{{url('/news/create')}}">添加</a>
        @csrf
        <form action="">
            <input type="text" name="n_title" placeholder="请输入新闻标题" value="{{$query['n_title']??''}}">
            <input type="text" name="n_content" placeholder="请输入新闻内容关键字" value="{{$query['n_content']??''}}">
            <button>搜索</button>
        </form>
        <table>
            <thead>
            <tr>
                <th>新闻ID</th>
                <th>新闻标题</th>
                <th>新闻内容</th>
                <th>新闻图片</th>
                <th>操作</th>
            </tr>
            </thead>

            <tbody>
            @foreach($data as $v)
            <tr>
                <td>{{$v->n_id}}</td>
                <td>{{$v->n_title}}</td>
                <td>{{$v->n_content}}</td>
                <td><img src="{{env('NEWS_URL')}}{{$v->n_myfile}}" width="100px"></td>
                <td>
                    <a href="{{url('/news/edit/'.$v->n_id)}}">编辑</a>
                    <a href="{{url('/news/del/'.$v->n_id)}}">删除</a>
                </td>
            </tr>
                @endforeach
            <tr>
                <td colspan="5">
                    {{$data->appends($query)->links()}}
                </td>
            </tr>
            </tbody>
        </table>
</body>
        <script>

                $(document).on('click','.pagination a',function(){
                    //跳转的路径
                    var url =$(this).attr('href');
                    $.get(url,function(res){
                        $('tbody').html(res);
                });
                    return false;
            });
        </script>
</html>