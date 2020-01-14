<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h3> 登录页面</h3>
    <h2  style="color:red">{{session('msg')}}</h2>
    <form action="{{url('/dologin')}}" method="post">
    @csrf
        <table>
            <tr>
                <td>用户姓名</td>
                <td><input type="text" name="u_name"></td>
            </tr>
            <tr>
                <td>用户密码</td>
                <td><input type="text" name="u_pwd"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" ></td>
            </tr>
        </table>
    </form>
</body>
</html>