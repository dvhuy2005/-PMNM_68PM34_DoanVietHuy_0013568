<?php
require_once '../app/core/Controller.php';

class lophoc extends Controller
{
    // 1. Hiển thị danh sách lớp học
    public function index()
    {
        $lophocModel = $this->model('lophocModel');
        $lophocs = $lophocModel->getAllLopHoc();

        $data = [
            'lophocs' => $lophocs,
            'viewname' => 'lophoc/index',
            'title' => 'Danh sách Lớp học'
        ];

        $this->view('layout/masterlayout', $data);
    }

    // 2. Thêm mới lớp học
    public function create()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $malop = trim($_POST['malop'] ?? '');
            $tenlop = trim($_POST['tenlop'] ?? '');

            if (empty($malop)) $errors['malop'] = "Mã lớp không được để trống";
            if (empty($tenlop)) $errors['tenlop'] = "Tên lớp không được để trống";

            if (empty($errors)) {
                $lophocModel = $this->model('lophocModel');
                $status = $lophocModel->insert($malop, $tenlop);

                if ($status) {
                    header("Location: ?url=lophoc");
                    exit();
                } else {
                    $errors['database'] = "Mã lớp đã tồn tại hoặc có lỗi xảy ra!";
                }
            }
        }

        $data = [
            'errors' => $errors,
            'viewname' => 'lophoc/create',
            'title' => 'Thêm mới Lớp học'
        ];
        $this->view('layout/masterlayout', $data);
    }

    // 3. Chỉnh sửa lớp học
    public function edit()
    {
        $errors = [];
        $malop = $_GET['malop'] ?? '';

        $lophocModel = $this->model('lophocModel');
        $lh = $lophocModel->getByMaLop($malop);

        if (!$lh) {
            header("Location: ?url=lophoc");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenlop = trim($_POST['tenlop'] ?? '');

            if (empty($tenlop)) {
                $errors['tenlop'] = "Tên lớp không được để trống";
            }

            if (empty($errors)) {
                $status = $lophocModel->update($malop, $tenlop);

                if ($status) {
                    header("Location: ?url=lophoc");
                    exit();
                } else {
                    $errors['database'] = "Cập nhật thất bại!";
                }
            }
        }

        $data = [
            'errors' => $errors,
            'lh' => $lh,
            'viewname' => 'lophoc/edit',
            'title' => 'Chỉnh sửa Lớp học'
        ];
        $this->view('layout/masterlayout', $data);
    }

    // 4. Xóa lớp học
    public function delete()
    {
        $malop = $_GET['malop'] ?? '';

        if (!empty($malop)) {
            $lophocModel = $this->model('lophocModel');
            $lophocModel->delete($malop);
        }

        header("Location: ?url=lophoc");
        exit();
    }
}
?>