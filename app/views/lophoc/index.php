<div style="max-width: 1000px; margin: 30px auto; padding: 20px; font-family: 'Segoe UI', sans-serif;">
    <h2 style="color: #2c3e50; text-align: center; margin-bottom: 25px; font-size: 2rem;">Danh Sách Lớp Học</h2>

    <div style="margin-bottom: 20px; text-align: right;">
        <a href="?url=lophoc/create" style="padding: 10px 20px; background: #2ecc71; color: white; text-decoration: none; border-radius: 6px; font-weight: bold; transition: 0.2s;">+ Thêm Lớp Mới</a>
    </div>

    <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
        <thead>
            <tr style="background: #3498db; color: white; text-align: left; font-weight: 600;">
                <th style="padding: 15px;">STT</th>
                <th style="padding: 15px;">MÃ LỚP</th>
                <th style="padding: 15px;">TÊN LỚP</th>
                <th style="padding: 15px; text-align: center;">HÀNH ĐỘNG</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($lophocs)): ?>
                <?php foreach ($lophocs as $index => $lh): ?>
                    <tr style="border-bottom: 1px solid #eeeff1;">
                        <td style="padding: 15px;"><?php echo $index + 1; ?></td>
                        <td style="padding: 15px; font-weight: bold; color: #34495e;"><?php echo $lh['malop']; ?></td>
                        <td style="padding: 15px; color: #2c3e50;"><?php echo $lh['tenlop']; ?></td>
                        <td style="padding: 15px; text-align: center;">
                            <a href="?url=lophoc/edit&malop=<?php echo $lh['malop']; ?>" style="color: #3498db; text-decoration: none; font-weight: bold; margin-right: 15px;">Sửa</a>
                            <a href="?url=lophoc/delete&malop=<?php echo $lh['malop']; ?>" onclick="return confirm('Xóa lớp này có thể ảnh hưởng đến sinh viên thuộc lớp. Bạn chắc chắn muốn xóa?')" style="color: #e74c3c; text-decoration: none; font-weight: bold;">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="padding: 30px; text-align: center; color: #7f8c8d;">Chưa có lớp học nào trong hệ thống.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
