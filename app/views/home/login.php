<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>
<body>

    <h1>Đăng nhập</h1>

    <form action="http://localhost/PMNM_68PM3_DoanVietHuy_0013568/public/auth/login" method="post">
        <div>
            <label for="username">Username</label>
            <input type="text" id="username" name="username">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember me</label>
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
    </form>
    <?php if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<h3>Thông báo lỗi!</h3>';
    } ?>
</body>
</html>