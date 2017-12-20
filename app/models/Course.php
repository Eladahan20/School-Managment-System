<?php

class Course {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function fetchAllCourses(){
        $this->db->query('SELECT * FROM `course`');
        if ($courses = $this->db->resultSet()) {
            return $courses;
        } else {
            return false;
        }
    }

    public function findById($id){
        $this->db->query('SELECT * FROM course WHERE idCourse = :id');
        // Bind value
        $this->db->bind(':id', $id);
  
        if ($row = $this->db->single()){
          return $row;
        } else {
          return false;
        }
        // Check row
      }

    public function addCourse($data){
        $this->db->query('INSERT INTO `course` (CourseName, CourseDescription, CourseImage) VALUES(:name, :description, :image)');
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':image', $data['image']);
        // Execute
        return $this->db->execute();
      }

      public function getCourseStudents($id) {
        $this->db->query("SELECT IdStudent, StudentName, StudentImage FROM student INNER JOIN studentscourses ON student.idstudent = studentscourses.students WHERE courses = ". $id);
        if ($students = $this->db->resultSet()) {
          foreach ($students as $key => $value) {
            $courseStudents[] = $value->StudentName; 
          }
          return $courseStudents;
      } else {
          return false;
  }
    }

    public function getAmountOfStudents($id){
        $this->db->query("SELECT * FROM school.studentscourses WHERE courses=". $id);
        return $this->db->rowCount();
    }
     

      public function modifyCourse($data) {

        $this->db->query("UPDATE `course` SET CourseName = :name , CourseDescription = :description WHERE  idCourse=". $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);

        return $this->db->execute();
        
      }

      public function deleteCourseStudents($id) {
        $this->db->query("DELETE FROM `studentscourses` WHERE Courses=". $id);
        return $this->db->execute();
    }
      
    public function modifyCourseStudents($students, $id) {
          if (empty($students)){
            return true;
          }else {
              foreach($students as $student) {
              $this->db->query("INSERT INTO `school`.`studentscourses` (`Students`, `courses`) VALUES (:student, :id)");
              $this->db->bind(':student', $student);
              $this->db->bind(':id', $id);
              if (!$this->db->execute()){
                return false;
              }
          }
          return true;
        }
      }

      public function deleteCourse($id) {
        $this->deleteCourseStudents($id);
        $this->db->query('DELETE FROM `school`.`course` WHERE `idCourse`='. $id);
        return $this->db->execute();
      }
      
  
    }//Class




?>