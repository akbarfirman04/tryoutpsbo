<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

class Exam{
  private $db;
  private $fm;
  public function __construct(){
      $this->db = new Database();
      $this->fm = new Format();
  }
  public function getQuesMath(){
    $query = "SELECT * FROM tbl_ques WHERE mapel = '3'ORDER BY quesNo ASC";
    $result = $this->db->select($query);
    return $result;
  }

  public function addQuestions($data){
    $quesNo = mysqli_real_escape_string($this->db->link, $data['quesNo']);
    $ques = mysqli_real_escape_string($this->db->link, $data['ques']);
    $ans = array();
    $ans[1] = $data['ans1'];
    $ans[2] = $data['ans2'];
    $ans[3] = $data['ans3'];
    $ans[4] = $data['ans4'];
    $rightAns = $data['rightAns'];
  }

  public function deleteQuestion($quesNo){
    $tables = array("tbl_ques","tbl_ans");
    foreach ($tables as $table) {
      $delquery = "DELETE FROM $table WHERE quesNo='$quesNo'";
      $deldata = $this->db->delete($delquery);
    }
    if ($deldata) {
      $msg = "<span class = 'success'>Soal berhasil dihapus</span>";
      return $msg;
    }
    else {
      $msg = "<span class = 'success'>Terjadi Kesalahan</span>";
      return $msg;
    }
  }

  public function getTotalRows(){
    $query = "SELECT * FROM tbl_ques";
    $getResult = $this->db->select($query);
    $total = $getResult->num_rows;
    return $total;
  }
  }
 ?>
