<?php

class Pages extends Controller{
  
    public function __construct () {
        $this->studentModel = $this->model('Student');
        $this->courseModel = $this->model('Course');
        $this->userModel = $this->model('User');
    }

    public function index (){
        if (isLoggedIn()){
                $_SESSION['students'] = $this->studentModel->fetchAllStudents();
                $_SESSION['courses'] = $this->courseModel->fetchAllCourses();
          $this->view('pages/index');
        } else {
            redirect('users/login');
        }
     }

     public function administration(){
        if (isLoggedIn()){
          $data['users'] = $this->userModel->getAllAdmins($_SESSION['user_role']);
          $this->view('pages/main',$data);
          
        } else {
            redirect('users/login');
        }
     }

     

}


?>