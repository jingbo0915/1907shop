<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h3>房产添加</h3>

    <form  method="post" action="{{url('house/store')}}" enctype="multipart/form-data">
    <table>
        <tr>
            <td>小区名</td>
            <td><input type="text" name="h_name"></td>
        </tr>
        <tr>
            <td>地理位置</td>
            <td><input type="text" name="h_location"></td>
        </tr>
        <tr>
            <td>面积</td>
            <td><input type="text" name="h_sum"></td>
        </tr>
        <tr>
            <td>导购员</td>
            <td><input type="text" name="h_starff"></td>
        </tr>
        <tr>
            <td>联系电话</td>
            <td><input type="text" name="h_tel"></td>
        </tr>
        <tr>
            <td>楼盘主图</td>
            <td><input type="file" name="h_photo"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="提交"></td>
        </tr>
    </table>
    </form>
</body>
</html>