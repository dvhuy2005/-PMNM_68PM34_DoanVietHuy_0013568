<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>'Hệ thống quản lý'</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .content{
            width: 60%;
            margin: auto;
            min-height: 400px;
        }
    </style>
</head>
<body>
        <div >
        <?php require_once "../app/views/layout/partial/header.php"; ?>
    </div>
    <div class="content">
        <?php 
            // Kiểm tra nếu viewname tồn tại thì mới include
            if (isset($viewname)) {
                require_once "../app/views/" . $viewname . ".php";
            }
        ?>
    </div>
    <div >
        <?php require_once "../app/views/layout/partial/footer.php"; ?>
    </div>
</body>
</html>