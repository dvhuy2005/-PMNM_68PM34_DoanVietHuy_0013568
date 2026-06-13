<?php
require_once '../app/core/Controller.php';

class sinhvien extends Controller {

    public function index()
    {
        // 1. Gọi model 'sinhvienModel' làm việc
        $sinhvienModel = $this->model('sinhvienModel');

        // 2. Chạy hàm lấy 22 sinh viên mồi dưới Database lên
        $sinhviens = $sinhvienModel->getAllSinhVien();

        // 3. Bắn cục dữ liệu sang file giao diện HTML/CSS để hiển thị
        $this->view('layout/masterlayout', [
            'title'     => 'Trang Danh Sách Sinh Viên', // Tiêu đề tab web
            'viewname'  => 'sinhvien/index',           // Tên file con để nhúng vào giữa (chính là file app/views/sinhvien/index.php)
            'sinhviens' => $sinhviens                 // Truyền dữ liệu để file con bốc ra dùng
        ]);
    }

    public function create()
    {
        require_once '../app/views/sinhvien/create.php';
    }
}
?>