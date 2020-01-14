<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h3>文章信息添加修改</h3>

    <form   method="post" action="{{url('/member/update/'.$data->m_id)}}" enctype="multipart/form-data">
        @csrf
        <table>
            <tr>
                <td>文章标题</td>
                <td><input type="text" name="m_title" value="{{$data->m_title}}">
                </td>
            </tr>

            <tr>
                <td>文章分类</td>
                <td>
                    <select name="m_cate" value="{{$data->m_cate}}">
                        <option value="散文">散文</option>
                        <option value="小说">小说</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>文章重要性</td>
                <td>
                    <input type="radio" name="m_is_import"  checked>普通
                    <input type="radio" name="m_is_import" >置顶
                </td>
            </tr>
            <tr>
                <td>是否显示</td>
                <td>
                    <input type="radio" name="m_is_show"   value="1" checked>是

                    <input type="radio" name="m_is_show"  value="2"  >否

                </td>
            </tr>

            <tr>
                <td>文章作者</td>
                <td>
                    <input type="text" name="m_name" value="{{$data->m_name}}">
                </td>
            </tr>
            <tr>
                <td>email</td>
                <td>
                    <input type="text" name="m_email" value="{{$data->m_email}}">
                </td>
            </tr>
            <tr>
                <td>关键字</td>
                <td>
                    <input type="text" name="m_key" value="{{$data->m_key}}">
                </td>
            </tr>
            <tr>
                <td>网页描述</td>
                <td>
                    <textarea name="m_desc" id="" cols="30" rows="10">{{$data->m_desc}}</textarea>
                </td>
            </tr>
            <tr>
                <td>上传图片</td>
                <td><img src="{{env('UPLOAD_URL')}}{{$data->m_file}}" width="100"/> <input type="file"  placeholder="请输品牌图片" name="m_file"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="修改"></td>
            </tr>
        </table>
</form>
</body>
</html>