<?php

class Users extends Controller {

    public function __construct(){
      $this->userModel = $this->model('User'); //inheritance from father, instanciate new user class.
      
    }

    public function index(){
      if (isLoggedIn()){
              $data['users']=  $this->userModel->getAllAdmins($_SESSION['user_role']);
              $this->view('pages/main', $data);
      } else {
          redirect('users/login');
      }
   }

   public function login(){
    // Check for POST
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      // Process form
      // Sanitize POST data
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
      // Init data
      $data =[
        'email' => trim($_POST['email']),
        'password' => trim($_POST['password']),
        'email_err' => '',
        'password_err' => '',      
      ];

      // Validate Email
      if(empty($data['email'])){
        $data['email_err'] = 'Pleae enter email';
      }

      // Validate Password
      if(empty($data['password'])){
        $data['password_err'] = 'Please enter password';
      }

      // Check for user/email
      if($this->userModel->findUserByEmail($data['email'])){
        // User found
      } else {
        // User not found
        $data['email_err'] = 'No user found';
      }

      // Make sure errors are empty
      if(empty($data['email_err']) && empty($data['password_err'])){
        // Validated
        // Check and set logged in user
        $loggedInUser = $this->userModel->login($data['email'], $data['password']);

        if($loggedInUser){
          // Create Session
          $this->createUserSession($loggedInUser);
        } else {
          $data['password_err'] = 'Password incorrect';
        // Load view with errors
          $this->view('users/login', $data);
        }
      } else {
        // Load view with errors
        $this->view('users/login', $data);
      }


    } else {
      // Init data
      $data =[    
        'email' => '',
        'password' => '',
        'email_err' => '',
        'password_err' => '',        
      ];

      // Load view
      $this->view('users/login', $data);
    }
  }


    public function addUser(){
      // Check for POST
      if (isLoggedIn()){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
  
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'phone' => trim($_POST['phone']),
          'phone_err' => '',
          'role' => '',
          'role_err' => '',
          'image' => '',
          'image_err' => '',
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => '',
          'users'=> $this->userModel->getAllAdmins($_SESSION['user_role'])
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Pleae enter email';
        } else {
          // Check email
          if($this->userModel->findUserByEmail($data['email'])){
            $data['email_err'] = 'Email is already taken';
          }
        }

        // Validate Name
        if(empty($data['name'])){
          $data['name_err'] = 'Pleae enter name';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Pleae enter password';
        } elseif(strlen($data['password']) < 6){
          $data['password_err'] = 'Password must be at least 6 characters';
        }

        // Validate Confirm Password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Pleae confirm password';
        } else {
          if($data['password'] != $data['confirm_password']){
            $data['confirm_password_err'] = 'Passwords do not match';
          }
        }
        //validate image
        if(empty($_FILES['image']['name'])) {
          $data['image_err'] = "No image file"; 
      } elseif (empty($data['image'])) {
          $data['image'] = new File($_FILES['image']);
          $response = $data['image']->upload();
          if(!is_bool($response)){
              $data['image_err'] = implode(",",$response);;
              } else {
                  $data['image'] = $data['image']->name;
          }
      }
         // Validate Phone
         if(empty($data['phone'])){
          $data['phone_err'] = 'Pleae enter phone';
      } elseif(strlen($data['phone']) < 10 && !is_numeric($data['phone'])){
          $data['phone_err'] = 'Phone is invalid';
      }
      //validate Role
      if (array_key_exists( 'role' , $_POST )) {
        $data['role'] = $_POST['role'];
      } else {
        $data['role_err'] = "Choose a role please";
      }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['phone_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['image_err']) && empty($data['role_err'])){
          // Register User
          if($this->userModel->register($data)){
            redirect('users/index');
          } else {
            die('Something went wrong');
          }

        } else {
          // Load view with errors
          $this->view('users/adduser', $data);
        }

      } else {
        // Init data
        $data =[
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'phone' => '',
          'phone_err' =>'',
          'role' => '',
          'role_err' => '',
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'image_err' => '',
          'users'=> $this->userModel->getAllAdmins($_SESSION['user_role'])
        ];

        // Load view
        $this->view('users/adduser', $data);
      }
    } else {
      redirect('users/login');
  }
}

    public function displayUser($id) {
      if (isLoggedIn()){
      $data['user'] = $this->userModel->findById($id);
      $data['users'] = $this->userModel->getAllAdmins($_SESSION['user_role']);
      $this->view('users/displayuser', $data);
      }else {
        redirect('users/login');
    }

   }     
  
  public function deleteUser($id) {
    if (isLoggedIn()){
    if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST)){
        $this->userModel->deleteUser($id);
        redirect('users/index');
    }else {
        $data = [
            'id' => $id,
            'users' => $this->userModel->getAllAdmins($_SESSION['user_role'])
        ];
        $this->view('users/deleteuser', $data);
    }
  }else {
    redirect('users/login');
}

    
}

public function editUser($id){
  if (isLoggedIn()){
  if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST)){
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
      $data =[
          'id' => $id,
          'name' => trim($_POST['name']),
          'phone' => trim($_POST['phone']),
          'role' => '',
          'role_err'=> '',
          'name_err' => '',
          'email_err' => '',
          'phone_err' => '',
          'users' =>  $this->userModel->getAllAdmins($_SESSION['user_role'])
          ];


      $data = ValidateInput($data,$this);
        $data['email'] = trim($_POST['email']);
        if(empty($data['email'])){
          $data['email_err'] = 'Pleae enter email';
        }

      if (array_key_exists( 'role' , $_POST )) {
        $data['role'] = $_POST['role'];
      } else {
        $data['role_err'] = "Choose a role please";
      }


             
  /*Updating student information after editing */
      if(empty($data['name_err']) && empty($data['email_err']) && empty($data['phone_err'])){
          if($this->userModel->modifyUser($data)) {
                  redirect('users/displayuser/'. $id);
              } else {
                  die('Something went wrong');
              }
      } else {
      // Load view with errors
      $this->view('users/edituser', $data);

      }
} else {
  $data['user'] = $this->userModel->findById($id);  
  $data['id'] = $data['user']->iduser;
  $data['name'] =  $data['user']->userName;
  $data['email'] = $data['user']->userEmail;
  $data['phone'] = $data['user']->userPhone;
  $data['role'] = $data['user']->userRole;
  $data['users'] =$this->userModel->getAllAdmins($_SESSION['user_role']);
  $this->view('users/edituser', $data);
  
}
} else {
  redirect('users/login');
}
}

   

      public function createUserSession($user){
        $_SESSION['user_id'] = $user->iduser;
        $_SESSION['user_email'] = $user->userEmail;
        $_SESSION['user_name'] = $user->userName;
        $_SESSION['user_role'] = $user->userRole;
        redirect('pages/index');
      }
  
      public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['students']);
        unset($_SESSION['courses']);
        session_destroy();
        redirect('users/login');
      }
  


}


?>