<?php

    session_start();

    function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
          return true;
        } else {
          return false;
        }
      }
    
      function redirect($location){
        header('location: '. URLROOT . '/'. $location);
    }
    
    function alert($message){
      echo "<script>alertify.alert('$message')</script>";
    }
    // Flash message helper
    // Example - flash('register_success', 'You are now registered', optional:'alert alert-danger');
    // display in view <?php echo flash('register_success'); 
    function flash($name='', $message= '', $class='alert alert-success'){
        if(!empty($name)){
            if(!empty($message) && empty($_SESSION[$name])){
                if (!empty($_SESSION[$name])) {
                    unset($_SESSION[$name]);
                }
                if (!empty($_SESSION[$name. '_class'])) {
                    unset($_SESSION[$name. '_class']);
                }
                $_SESSION[$name] = $message;
                $_SESSION[$name. '_class']= $class;
            } else if (empty($message) && !empty($_SESSION[$name])) {
                $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
                echo '<div class="'. $class.'" id="msg-flash">'. $_SESSION[$name] .'</div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$name. '_class']);
                }
            }
        }

        


?>