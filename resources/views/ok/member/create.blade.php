<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h3>房产添加列表</h3>
<form class="form-horizontal" role="form" method="post" action="{{url('member/store')}}" enctype="multipart/form-data">
    @csrf
<table>
    <tr>
        <td>房子名字</td>
        <td><input type="text" name="m_title">
		</td>
    </tr>

    {{--<tr>--}}
        {{--<td>商品分类</td>--}}
        {{--<td>--}}
            {{--<select name="m_cate">--}}
                {{--<option value="小吃">小吃</option>--}}
                {{--<option value="麻辣香锅">麻辣香锅</option>--}}
                {{--<option value="成都小龙虾">成都小龙虾</option>--}}
            {{--</select>--}}
        {{--</td>--}}
    {{--</tr>--}}
  {{----}}
    {{--<tr>--}}
        {{--<td>商品是否上架</td>--}}
        {{--<td>--}}
            {{--<input type="radio" name="m_is_import"  checked>上架--}}
            {{--<input type="radio" name="m_is_import" >不上架--}}

        {{--</td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
        {{--<td>是否还有库存显示</td>--}}
        {{--<td>--}}
            {{--<input type="radio" name="m_is_show"   value="1" checked>是--}}

            {{--<input type="radio" name="m_is_show"  value="2"  >否--}}

        {{--</td>--}}
    {{--</tr>--}}

    {{--<tr>--}}
        {{--<td>商品的名字</td>--}}
        {{--<td>--}}
            {{--<input type="text" name="m_name">--}}
        {{--</td>--}}
    {{--</tr>--}}
    <tr>
        <td>联系电话</td>
        <td>
            <input type="text" name="m_email">
        </td>
    </tr>
    <tr>
        <td>商品导购员</td>
        <td>
            <input type="text" name="m_key">
        </td>
    </tr>
    <tr>
        <td>商品面积</td>
        <td><input type="text" name="m_desc"></td>
        {{--<td>--}}
            {{--<textarea name="m_desc" id="" cols="30" rows="10"></textarea>--}}
        {{--</td>--}}
    </tr>
    <tr>
        <td>上传图片</td>
        <td> <input type="file"  placeholder="请输品牌图片" name="m_file"></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit"></td>
    </tr>
</table>
    </form>
</body>
</html>