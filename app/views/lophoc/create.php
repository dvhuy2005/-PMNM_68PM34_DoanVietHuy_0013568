<div style="max-width: 500px; margin: 40px auto; background: #ffffff; padding: 35px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); font-family: 'Segoe UI', sans-serif;">
    <h2 style="color: #2c3e50; margin-bottom: 25px; text-align: center; font-weight: 700;">Thêm Lớp Học Mới</h2>
    
    <?php if (isset($errors['database'])): ?>
        <p style="color: #e74c3c; text-align: center; font-weight: bold; font-size: 0.95rem;"><?php echo $errors['database']; ?></p>
    <?php endif; ?>

    <form action="?url=lophoc/create" method="POST">
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #34495e;">Mã Lớp Học:</label>
            <input type="text" name="malop" style="width: 100%; padding: 12px 15px; border: 1px solid #dcdde1; border-radius: 8px; box-sizing: border-box;" placeholder="Ví dụ: 68IT4" required>
            <?php if (isset($errors['malop'])): ?>
                <span style="color: #e74c3c; font-size: 0.85rem; margin-top: 5px; display: block;"><?php echo $errors['malop']; ?></span>
            <?php endif; ?>
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #34495e;">Tên Lớp Học:</label>
            <input type="text" name="tenlop" style="width: 100%; padding: 12px 15px; border: 1px solid #dcdde1; border-radius: 8px; box-sizing: border-box;" placeholder="Ví dụ: Công nghệ thông tin 4" required>
            <?php if (isset($errors['tenlop'])): ?>
                <span style="color: #e74c3c; font-size: 0.85rem; margin-top: 5px; display: block;"><?php echo $errors['tenlop']; ?></span>
            <?php endif; ?>
        </div>

        <div style="text-align: center;">
            <button type="submit" style="padding: 12px 30px; background: #2ecc71; color: white; border: none; border-radius: 8px; font-size: 1rem; cursor: pointer; font-weight: bold;">Lưu Lại</button>
            <a href="?url=lophoc" style="margin-left: 15px; text-decoration: none; color: #7f8c8d; font-size: 0.95rem;">Hủy bỏ</a>
        </div>
    </form>
</div>