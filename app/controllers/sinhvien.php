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
    // Chức năng Sửa sinh viên
    public function edit()
    {
        $errors = [];
        // Lấy mssv từ URL xuống (?url=sinhvien/edit&mssv=0012002)
        $mssv = $_GET['mssv'] ?? '';

        $sinhvienModel = $this->model('sinhvienModel');
        // Gọi Model lấy thông tin cũ của sinh viên đó lên đổ vào Form
        $sv = $sinhvienModel->getByMssv($mssv);

        // Nếu không tìm thấy sinh viên này trong DB thì đá ngược về trang danh sách
        if (!$sv) {
            header("Location: ?url=sinhvien");
            exit();
        }

        // Khi người dùng sửa xong và nhấn nút "Cập nhật" (POST dữ liệu lên)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hoten = trim($_POST['hoten'] ?? '');
            $lop = trim($_POST['lop'] ?? '');
            $sdt = trim($_POST['sdt'] ?? '');

            // Validate dữ liệu cơ bản
            if (empty($hoten)) {
                $errors['hoten'] = "Họ tên không được để trống";
            }

            // Nếu không dính lỗi form thì tiến hành update vào database
            if (empty($errors)) {
                $updateStatus = $sinhvienModel->update($mssv, $hoten, $lop, $sdt);

                if ($updateStatus) {
                    header("Location: ?url=sinhvien");
                    exit();
                } else {
                    $errors['database'] = "Cập nhật thất bại, vui lòng kiểm tra lại!";
                }
            }
        }

        // Đẩy dữ liệu sang giao diện sửa
        $data = [
            'errors' => $errors,
            'sv' => $sv, // Truyền thông tin sinh viên cũ sang View hiển thị lên ô input
            'viewname' => 'sinhvien/edit',
            'title' => 'Chỉnh sửa Sinh viên'
        ];
        $this->view('layout/masterlayout', $data);
    }

    // Chức năng Xóa sinh viên
    public function delete()
    {
        // Lấy mssv cần xóa trên URL xuống 
        $mssv = $_GET['mssv'] ?? '';

        if (!empty($mssv)) {
            $sinhvienModel = $this->model('sinhvienModel');
            $sinhvienModel->delete($mssv);
        }

        // Xóa xong (dù được hay mất) cũng tự động chuyển hướng về lại trang danh sách 
        header("Location: ?url=sinhvien");
        exit();
    }
    public function create()
    {
        require_once '../app/views/sinhvien/create.php';
    }
}
?>