<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
	  <script src="/static/admin/js/jquery.js"></script>

    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h3>商品信息展示</h3>

    <form action="">

        商品分类：<input type="text" name="word" placeholder="请输入名称关键字" value="{{$query['word']??''}}">
         商品标题： <input type="text" name="desc" placeholder="请输入描述关键字" value="{{$query['desc']??''}}">

        <button>搜索</button>
    </form>
    <a href="{{url('member/create')}}">添加</a>

    <table >
        <thead>
        <tr>
            <th>商品ID</th>
            <th>商品价格</th>
            <th>商品分类</th>
            <th>商品是否上架</th>
            <th>是否还有库存显示</th>
            <th>商品的名字</th>
            <th>商品厂家地址</th>
            <th>商品的使用</th>
            <th>商品描述</th>
            <th>图片</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $v)
        <tr>
            <td>{{$v->m_id}}</td>
            <td>{{$v->m_title}}</td>
            <td>{{$v->m_cate}}</td>
            <td>{{$v->m_is_import==1?'是':'否'}}</td>
            <td>{{$v->m_is_show==1?'是':'否'}}</td>
            <td>{{$v->m_name}}</td>
            <td>{{$v->m_email}}</td>
            <td>{{$v->m_key}}</td>
            <td>{{$v->m_desc}}</td>
            <td><img src="{{env('UPLOAD_URL')}}{{$v->m_file}}" width="100"/></td>
            <td><a href="{{url('/member/edit/'.$v->m_id)}}" class="btn btn-success">编辑</a>|<a href="javascript:viod(0)" onclick="ajaxdel({{$v->m_id}})"  class="btn btn-danger">删除</a></td>
        </tr>
        @endforeach
        <tr>

            <td colspan="12">{{$data->appends($query)->links()}}</td>

        </tr>

        </tbody>
    </table>





</body>
<script>
    //删除
    //第一种ajax删除
    //        function ajaxdel(id){
    //            $.ajaxSetup({
    //                headers: {
    //                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                }
    //            });
    //            $.ajax({
    //                method:"POST",
    //                url:"/member/del/"+id,
    //                data:'',
    //                dataType:'json',
    //            }).done(function(res){
    //                if(res.code =='00000'){
    //                    alert(res.msg);
    //                    location.reload();
    //                }
    //            })
    //        }
    //


    // 第二种ajax删除
    function ajaxdel(id){
        //判断id是否存在 如果不存在给出提示
        if(!id){
            return
        }
        $.get('/member/del/'+id,function(res){
            if(res.code =='00000'){
                alert(res.msg);
                location.reload();
            }
        },'json')
    }

    //ajax 分页
    $(function(){
        $(document).on("click",'.pagination a',function(){

            var url =$(this).attr('href');
            $.get(url,function(res){
               // alert(res);
                $('tbody').html(res);
            });
            return false;

        });

    })

</script>
</html>