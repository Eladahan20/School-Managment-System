<?php
class Students extends Controller{
    
        public function __construct () {
            if (isLoggedIn()){
                $this->studentModel = $this->model('Student');
                $this->students = $this->studentModel->fetchAllStudents();
            }else {
                redirect('pages/index');
            }
        }
        public function displayStudent($id) {
            $student = $this->studentModel->findById($id);
            $studentCourses=$this->studentModel->getStudentCourses($student ->idStudent);
            $data = [
                'student' => $student,
                'studentCourses' => $studentCourses
            ];
            $this->view('Students/displaystudent', $data);

        }     
        public function addStudent() {
           //After registering a new student, and POST is loaded.
            if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST)){
                $data = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data =[
                        'name' => trim($_POST['name']),
                        'email' => trim($_POST['email']),
                        'phone' => trim($_POST['phone']),
                        'image' => '',
                        'name_err' => '',
                        'email_err' => '',
                        'phone_err' => '',
                       ];
                $data = ValidateInput($data,$this);
               
                    // Make sure errors are empty
                    if(empty($data['email_err']) && empty($data['name_err']) && empty($data['phone_err']) && empty($data['image_err'])){
                        if (!$this->studentModel->register($data)){
                            die('Something went wrong');
                        } else {
                            redirect('pages/index');
                            }
                    } else {
                        // Load view with errors
                        $this->view('Students/Addstudent', $data);
                        }
            } else {
                    // first click on add user without inserting details
                    $data =[
                    'name' => '',
                    'email' => '',
                    'phone' => '',
                    'image' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'phone_err' => '',
                    'image_err' => ''
                    ];
                    // Load view
                    $this->view('Students/Addstudent', $data);
                }
            }


            
            public function editStudent($id){
                if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST)){
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    $data =[
                        'id' => $id,
                        'name' => trim($_POST['name']),
                        'email' => trim($_POST['email']),
                        'phone' => trim($_POST['phone']),
                        'image' => '',
                        'name_err' => '',
                        'email_err' => '',
                        'phone_err' => '',
                        'courses' => ''
                        ];
                    $data = ValidateInput($data,$this);
                    if(empty($data['email'])){
                        $data['email_err'] = 'Pleae enter email';
                    }

                    unset($_POST['name']);
                    unset($_POST['email']);
                    unset($_POST['phone']);
                    if (!empty($_POST)) {
                        foreach($_POST as $key => $value) {
                            $coursesToTake[] = $key; 
                        }
                        $data['courses'] = $coursesToTake;
                    }

                           
                /*Updating student information after editing */
                    if(empty($data['name_err']) && empty($data['phone_err']) && empty($data['email_err'])){
                        if($this->studentModel->modifyStudent($data) &&
                         $this->studentModel->deleteStudentCourses($id) && 
                         ($this->studentModel->modifyStudentCourses($data['courses'],$id))){
                                redirect('Students/displaystudent/'. $id);
                            } else {
                                die('Something went wrong');
                            }
                    } else {
                    // Load view with errors
                    $this->view('Students/Editstudent', $data);

                    }
             } else {
                     $student = $this->studentModel->findById($id);
                     $studentCourses=$this->studentModel->getStudentCourses($id);
                     $data['student'] = $student;
                     $data['id'] = $student->idStudent;
                     $data['name'] = $student->StudentName;
                     $data['email'] = $student->StudentEmail;
                     $data['phone'] = $student->StudentPhone;
                     $data['studentCourses'] = $studentCourses;
                     $this->view('Students/editstudent', $data);
                
            }
        }

        public function deleteStudent($id) {
            if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST)){
                $this->studentModel->deleteStudent($id);
                redirect('pages/index');
            }else {
                $data = [
                    'id' => $id
                ];
                $this->view('students/deletestudent', $data);
            }
            
        }
  
  
  
  















        }//Class 



?>