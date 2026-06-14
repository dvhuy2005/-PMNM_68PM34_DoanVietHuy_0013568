<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 30px;
            min-height: 100vh;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        th {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            padding: 18px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 1.05rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 16px 15px;
            border-bottom: 1px solid #eee;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #e8f4fd;
            transform: scale(1.01);
            transition: all 0.3s ease;
        }

        tr:last-child td {
            border-bottom: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }
            h1 {
                font-size: 2rem;
            }
            th, td {
                padding: 12px 8px;
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>
    <h1>Danh sách sinh viên</h1>
    <table>
    <tr>
        <th> STT </th>
        <th> Mã sinh viên </th>
        <th> Họ tên </th>
        <th> Lớp </th>
        <th> Số điện thoại </th>
    </tr>
    <?php foreach ($sinhviens as $index => $sinhvien): ?>
        <tr>
            <td> <?php echo $sinhvien['stt']; ?> </td>
            <td> <?php echo $sinhvien['mssv']; ?> </td>
            <td> <?php echo $sinhvien['hoten']; ?> </td>
            <td> <?php echo $sinhvien['lop']; ?> </td>
            <td> <?php echo $sinhvien['sdt']; ?> </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <div class="pagination" style="max-width: 1200px; margin: 25px auto 35px auto; text-align: center; clear: both;">
        <?php 
        // Hứng đúng chữ P hoa từ Controller truyền sang gán vào thuật toán
        $totalPage = isset($totalPage) ? $totalPage : 1; 
        $current_page = isset($current_page) ? $current_page : 1; 
        
        $context_limit = 2; 
        ?>

        <?php if ($current_page > 1): ?>
            <a href="?url=sinhvien&page=1" style="margin: 0 5px; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; text-decoration: none; color: #333; background: #fff;">« Đầu</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPage; $i++): ?>
            <?php 
            if ($i == 1 || $i == $totalPage || ($i >= $current_page - $context_limit && $i <= $current_page + $context_limit)): 
            ?>
                <a href="?url=sinhvien&page=<?php echo $i; ?>" 
                style="margin: 0 5px; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; text-decoration: none; 
                        <?php echo $i == $current_page ? 'background: #3498db; color: white; border-color: #3498db; font-weight: bold;' : 'color: #333; background: #fff;'; ?>">
                    <?php echo $i; ?>
                </a>

            <?php 
            elseif ($i == 2 || $i == $totalPage - 1): 
            ?>
                <span style="padding: 0 10px; color: #777;">...</span>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($current_page < $totalPage): ?>
            <a href="?url=sinhvien&page=<?php echo $totalPage; ?>" style="margin: 0 5px; padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px; text-decoration: none; color: #333; background: #fff;">Cuối »</a>
        <?php endif; ?>
    </div>
<div class="pagination" style="max-width: 1200px; margin: 25px auto 35px auto; text-align: center; clear: both;"></div>
