<?php
require_once '../app/core/Database.php';

class lophocModel
{
    private $conn;

    public function __construct()
    {
        // Khởi tạo kết nối CSDL giống sinhvienModel
        $this->conn = ConnectDB::connect();
    }

    // 1. Lấy toàn bộ danh sách lớp học (Dùng để hiển thị bảng danh sách và làm dropdown cho sinh viên chọn)
    public function getAllLopHoc()
    {
        try {
            $query = "SELECT * FROM lophoc";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    // 2. Lấy thông tin chi tiết 1 lớp học dựa trên malop (Phục vụ chức năng Sửa)
    public function getByMaLop($malop)
    {
        try {
            $sql = "SELECT * FROM lophoc WHERE malop = :malop";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':malop', $malop, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    // 3. Hàm thêm lớp học mới (Create)
    public function insert($malop, $tenlop)
    {
        try {
            $sql = "INSERT INTO lophoc (malop, tenlop) VALUES (:malop, :tenlop)";
            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindValue(':malop', $malop, PDO::PARAM_STR);
            $stmt->bindValue(':tenlop', $tenlop, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // 4. Hàm cập nhật thông tin lớp học (Update)
    public function update($malop, $tenlop)
    {
        try {
            $sql = "UPDATE lophoc SET tenlop = :tenlop WHERE malop = :malop";
            $stmt = $this->conn->prepare($sql);
            
            $stmt->bindValue(':malop', $malop, PDO::PARAM_STR);
            $stmt->bindValue(':tenlop', $tenlop, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // 5. Hàm xóa lớp học (Delete)
    public function delete($malop)
    {
        try {
            $sql = "DELETE FROM lophoc WHERE malop = :malop";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':malop', $malop, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>