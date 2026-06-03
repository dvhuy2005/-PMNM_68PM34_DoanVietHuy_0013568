<?php
require_once '../app/core/Controller.php';

class sinhvien extends Controller {

    public function index()
    {
        // 1. Gọi model 'sinhvienModel' dậy làm việc
        $sinhvienModel = $this->model('sinhvienModel');

        // 2. Chạy hàm lấy 22 sinh viên mồi dưới Database lên
        $sinhviens = $sinhvienModel->getAllSinhVien();

        // 3. Bắn cục dữ liệu sang file giao diện HTML/CSS để hiển thị
        $this->view('sinhvien/index', [
            'sinhviens' => $sinhviens
        ]);
    }

    public function create()
    {
        require_once '../app/views/sinhvien/create.php';
    }
}
?>