<?php
require_once '../app/core/DB.php';
class SinhvienModel{
    private $conn;

    public function __construct(){
        $this->conn = ConnectDB::Connect();
    }

    public function getAllSinhvien(){
        $query = "SELECT sv.*, lp.tenlop 
                  FROM tbl_sinhviens sv 
                  LEFT JOIN tbl_lops lp ON sv.malop = lp.malop";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($hoten, $gioitinh, $mssv,$malop){
        $query = "INSERT INTO tbl_sinhviens(hoten, gioitinh, mssv, malop) VALUES(:hoten, :gioitinh, :mssv, :malop)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':hoten', $hoten, PDO::PARAM_STR);
        $stmt->bindParam(':gioitinh', $gioitinh, PDO::PARAM_STR);
        $stmt->bindParam(':mssv', $mssv, PDO::PARAM_STR);
        $stmt->bindParam(':malop', $malop, PDO::PARAM_STR);
        return $stmt->execute();
    }

  public function paging($limit = 5, $offset = 0, $search = "") {
        $searchParam = "%" . $search . "%";
        
        $query = "SELECT sv.*, lp.tenlop 
                      FROM tbl_sinhviens sv 
                LEFT JOIN tbl_lops lp ON sv.malop = lp.malop 
                WHERE sv.mssv LIKE :search 
                    OR sv.hoten LIKE :search 
                    OR sv.malop LIKE :search 
                    OR lp.tenlop LIKE :search
                LIMIT :limit OFFSET :offset";
                
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);

        /*
        $query = "SELECT * FROM tbl_sinhviens LIMIT ? OFFSET ?";
        $stmt->bindParam('ss', $limit, $offset);
        */

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Tinh tong so ban ghi
        $countQuery = "SELECT COUNT(*) FROM tbl_sinhviens sv 
                    LEFT JOIN tbl_lops lp ON sv.malop = lp.malop 
                    WHERE sv.mssv LIKE :search 
                        OR sv.hoten LIKE :search 
                        OR sv.malop LIKE :search 
                        OR lp.tenlop LIKE :search";
                        
        $selectAllQuery = $this->conn->prepare($countQuery);
        $selectAllQuery->bindParam(':search', $searchParam, PDO::PARAM_STR);
        $selectAllQuery->execute();
        $totalRecord = $selectAllQuery->fetchColumn();
        $totalPage = ceil($totalRecord/$limit);

        return ["sinhviens"=>$result, "totalpage"=>$totalPage];
    }

    public function getById($id){
        $query = "SELECT * FROM tbl_sinhviens WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $hoten, $gioitinh, $mssv,$malop){
        $query = "UPDATE tbl_sinhviens SET hoten = :hoten, gioitinh = :gioitinh, mssv = :mssv, malop = :malop WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':hoten', $hoten,  PDO::PARAM_INT);
        $stmt->bindParam(':gioitinh', $gioitinh,  PDO::PARAM_INT);
        $stmt->bindParam(':mssv', $mssv,  PDO::PARAM_INT);
        $stmt->bindParam(':malop', $malop, PDO::PARAM_STR);
        return $stmt->execute(); 
    }

    public function delete($id){
        $query = "DELETE FROM tbl_sinhviens WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute(); 
    
}
?>