<?php
require_once '../app/core/Controller.php';

class sinhvien extends Controller
{

public function index()
    {
        // 1. Khởi động session nếu hệ thống của bạn chưa bật tự động
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $page = isset($_GET['page']) ? $_GET['page'] : 1;   

    
        $current_page = is_numeric($page) ? (int) $page : 1;
        if ($current_page < 1) {
            $current_page = 1;
        }

        // 2. Xử lý logic lưu từ khóa tìm kiếm thông minh qua Session
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $search = $_POST['search'] ?? '';
            $_SESSION['search_keyword'] = $search; 
        } else {
            $search = $_SESSION['search_keyword'] ?? '';
        }

        $limit = 5;
        $offset = ($current_page - 1) * $limit;

        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->paging($limit, $offset, $search);
        
        $sinhviens = $result['sinhviens'];
        $total_page = $result['totalPage']; 

        $data = [
            'sinhviens' => $sinhviens,
            'totalPage' => $total_page,      
            'current_page' => $current_page, 
            'search' => $search, 
            'viewname' => 'sinhvien/index',
            'title' => 'Danh sách Sinh viên'
        ];

        $this->view('layout/masterlayout', $data);
    }

    public function create()
    {
        require_once '../app/views/sinhvien/create.php';
    }
}
?>