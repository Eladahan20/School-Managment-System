<?php

class Courses extends Controller {
        
   public function __construct () {
    if (isLoggedIn()){
       $this->courseModel = $this->model('Course');
    } else {
        redirect('pages/index');
    }
}

public function addCourse() {  
    /*  This function has two different methods, one is when POST is loaded with user inputs, 
        and the other is to generate the Add Course view, without POST inputs.
    */   
    //First Method: Loading the POST and action
    if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST)){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data =[
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'image' =>''
                ];
            // Validate Inputs       
            $data = ValidateInput($data);
            // Make sure errors are empty
            if(empty($data['name_err']) && empty($data['description_err']) && empty($data['image_err'])){
                if ($this->courseModel->addCourse($data)) {
                    redirect('pages/index');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('Courses/AddCourse', $data);
            }
    } else {
        //Second Method: Load the view.
        $data =[
            'name' => '',
            'description' => '',
            'image' => '',
            'name_err' => '',
            'description_err' => '',
            'image_err' => ''
        ];
        // Load view
        $this->view('Courses/AddCourse', $data);
        }
    }


    public function editCourse($id){
    if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST)){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data =[
            'id' => $id,
            'name' => trim($_POST['name']),
            'description' => trim($_POST['description']),
            'name_err' => '',
            'description_err' => '',
            'courseStudents' => ''
            ];

        $data = ValidateInput($data,$this);
            //Fetch the students selected to take this course
        unset($_POST['name']);
        unset($_POST['description']);
        if (!empty($_POST)) {
            foreach($_POST as $key => $value) {
                $studentsParticipating[] = $key; 
            }
            $data['courseStudents'] = $studentsParticipating;
        }
                
        //After editing and validating new data, send to execution.
        if(empty($data['description_err']) && empty($data['name_err'])){
            if($this->courseModel->modifyCourse($data) && 
                $this->courseModel->deleteCourseStudents($id) && 
                ($this->courseModel->modifyCourseStudents($data['courseStudents'],$data['id']))){
                    redirect('Courses/displaycourse/'. $id);
                } else {
                    die('Something went wrong');
                }
            } else {
            // Load view with errors
        $this->view('Courses/editcourse', $data);

        }
    }else {
        /*To navigate to edit course page, setting up the data of the selected 
        course and send it to view: */
            $course = $this->courseModel->findById($id);
            $courseStudents=$this->courseModel->getCourseStudents($id);
        
            $data =[
            'id' => $course->idCourse,
            'name' => $course->CourseName,
            'description' =>$course->CourseDescription,
            'name_err' => '',
            'description_err' => '',
            'courseStudents' => $courseStudents,
            'course_amount'=> count($courseStudents),
            'name_err' => '',
            'description_err' => ''
            ];
            $this->view('Courses/editcourse', $data);
    
    }
}
          
            public function displayCourse($id) {
                $course = $this->courseModel->findById($id);
                $courseStudents = $this->courseModel->getCourseStudents($id);
                $courseNumberOfStudents = $this->courseModel->getAmountOfStudents($id);
                $data = [
                    'course' => $course,
                    'courseStudents' => $courseStudents,
                    'course_amount' => $courseNumberOfStudents
                  
                ];
                $this->view('courses/displayCourse', $data);

            }

            public function deleteCourse($id) {
                if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST)){
                    $this->courseModel->deleteCourse($id);
                    redirect('pages/index');
                }else {
                    $data = [
                        'id' => $id
                    ];
                    $this->view('courses/deletecourse', $data);
                }
                
            }
            










}//class


?>