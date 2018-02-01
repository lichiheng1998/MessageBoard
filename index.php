<?php
header('content-type:text/html;charset=utf-8');
?>

<html>
<head>
    <link rel="stylesheet" href="css/login.css" />
</head>
<style>
    table, table input {
        text-align: center;
    }
</style>
<body>
<div id="main_body_wrapper">
    <div id="main_body">
            <table border="1">
                <form action="backstage/verify_page.php" method="post">
                <tr>
                    <td>用户名:</td>
                    <td><input type="text" name="user"></td>
                </tr>
                <tr>
                    <td>密码:</td>
                    <td><input type="password" name="psw"></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" id="submit" value="login"></td>
                </tr>
                </form>
            </table>
    </div>
</div>
</body>
</html>