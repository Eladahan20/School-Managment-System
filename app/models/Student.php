<?php

class Student {

    private $db;
    // public $name;
    public function __construct (){
        $this->db = new Database();
    }

    public function register($data){
        $this->db->query('INSERT INTO `student` (StudentName, StudentEmail, StudentPhone, StudentImage) VALUES(:name, :email, :phone, :image)');
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':image', $data['image']);
  
        // Execute
        return $this->db->execute();

         
      }

      public function findByEmail($email){
        $this->db->query('SELECT * FROM student WHERE StudentEmail = :email');
        // Bind value
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        // Check row
        if($this->db->rowCount() > 0){
          return true;
        } else {
          return false;
        }
      }

      public function findById($id){
        $this->db->query('SELECT * FROM student WHERE idStudent = :id');
        // Bind value
        $this->db->bind(':id', $id);
  
        if ($row = $this->db->single()){
          return $row;
        } else {
          return false;
        }
        // Check row
      }

    public function fetchAllStudents(){
        $this->db->query('SELECT * FROM `student`');
        if ($students = $this->db->resultSet()) {
            return $students;
        } else {
            return false;
        }

        
    }

    function getStudentCourses($id) {
        $this->db->query("SELECT  CourseName FROM course INNER JOIN studentscourses ON course.idcourse = studentscourses.courses WHERE Students = ". $id);
        if ($courses = $this->db->resultSet()) {
          foreach ($courses as $key => $value) {
            $studentCourses[] = $value->CourseName; 
          }
          return $studentCourses;
      } else {
          return false;
  }
    }
    function modifyStudent($data) {
      $this->db->query("UPDATE `student` SET StudentName = :name , StudentEmail = :email, StudentPhone = :phone WHERE  idStudent=". $data['id']);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':phone', $data['phone']);
  
      return $this->db->execute();
      
    }
      
      public function modifyStudentCourses($data, $id) {
          if (empty($data)){
            return true;
          }else {
              foreach($data as $course) {
              $this->db->query("INSERT INTO `school`.`studentscourses` (`Students`, `courses`) VALUES (:id, :course)");
              $this->db->bind(':id', $id);
              $this->db->bind(':course', $course);
              if (!$this->db->execute()){
                return false;
              }
          }
          return true;
        }
      }
               
  public function deleteStudent($id) {
    $this->deleteStudentCourses($id);
    $this->db->query('DELETE FROM `school`.`student` WHERE `idStudent`='. $id);
    return $this->db->execute();
  }
    
    public function deleteStudentCourses($id) {
      $this->db->query("DELETE FROM `studentscourses` WHERE Students=". $id);
      return $this->db->execute();
    }
}

?>