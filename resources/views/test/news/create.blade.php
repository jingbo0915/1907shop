<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h3>新闻添加</h3>
    <form action="{{url('/news/store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <table>
            <tr>
                <td>新闻标题</td>
                <td><input type="text" name="n_title"></td>
            </tr>
            <tr>
                <td>新闻内容</td>
                <td><input type="text" name='n_content'></td>
            </tr>

            <tr>
                <td>新闻图片</td>
                <td><input type="file" name="n_myfile"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type='submit'></td>
            </tr>
        </table>
    </form>
</body>
</html>