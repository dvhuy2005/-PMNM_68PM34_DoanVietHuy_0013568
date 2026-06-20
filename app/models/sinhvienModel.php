<?php
require_once '../app/core/Database.php';

class sinhvienModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = ConnectDB::connect();
    }
    public function getAllSinhVien()
    {
        $query = "SELECT * FROM sinhvien";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function paging($limit, $offset, $search)
    {
        // 1. Tạo điều kiện tìm kiếm dạng tương đối %từ_khóa%
        $searchTerm = "%" . $search . "%";

        // 2. Câu lệnh đếm TỔNG SỐ BẢN GHI THEO TỪ KHÓA (Quan trọng nhất)
        $sqlCount = "SELECT COUNT(*) as total FROM sinhvien WHERE hoten LIKE :search OR lop LIKE :search";
        $stmtCount = $this->conn->prepare($sqlCount);
        $stmtCount->bindValue(':search', $searchTerm, PDO::PARAM_STR);
        $stmtCount->execute();
        $totalRecords = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];

        // Tính lại tổng số trang dựa trên số bản ghi đã được lọc
        $totalPage = ceil($totalRecords / $limit);
        if ($totalPage < 1)
            $totalPage = 1; // Đảm bảo luôn có ít nhất 1 trang

        // 3. Câu lệnh lấy danh sách dữ liệu có phân trang và tìm kiếm
        $sqlData = "SELECT * FROM sinhvien 
                        WHERE hoten LIKE :search OR lop LIKE :search 
                        LIMIT :limit OFFSET :offset";

        $stmtData = $this->conn->prepare($sqlData);
        $stmtData->bindValue(':search', $searchTerm, PDO::PARAM_STR);
        $stmtData->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmtData->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmtData->execute();
        $sinhviens = $stmtData->fetchAll(PDO::FETCH_ASSOC);

        // 4. Trả về đúng định dạng dữ liệu mà Controller đang chờ nhận
        return [
            'sinhviens' => $sinhviens,
            'totalPage' => $totalPage
        ];
    }
    // 1. Lấy thông tin chi tiết của 1 sinh viên dựa vào mssv (để đổ dữ liệu cũ vào Form Sửa)
    public function getByMssv($mssv)
    {
        try {
            $sql = "SELECT * FROM sinhvien WHERE mssv = :mssv";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':mssv', $mssv, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    // 2. Hàm cập nhật (Sửa) thông tin sinh viên
    public function update($mssv, $hoten, $lop, $sdt)
    {
        try {
            $sql = "UPDATE sinhvien SET hoten = :hoten, lop = :lop, sdt = :sdt WHERE mssv = :mssv";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':mssv', $mssv, PDO::PARAM_STR);
            $stmt->bindValue(':hoten', $hoten, PDO::PARAM_STR);
            $stmt->bindValue(':lop', $lop, PDO::PARAM_STR);
            $stmt->bindValue(':sdt', $sdt, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // 3. Hàm xóa sinh viên khỏi hệ thống
    public function delete($mssv)
    {
        try {
            $sql = "DELETE FROM sinhvien WHERE mssv = :mssv";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':mssv', $mssv, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }


}

?>