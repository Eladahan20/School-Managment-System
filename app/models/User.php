<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }


    public function register($data){
      $this->db->query('INSERT INTO user (userName, userEmail,userPhone, userPassword, userRole,userImage) VALUES(:name, :email, :phone, :password, :role, :image)');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);
      $this->db->bind(':role', $data['role']);
      $this->db->bind(':image', $data['image']);
      $this->db->bind(':phone', $data['phone']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
     // Login User
     public function login($email, $password){
        $this->db->query('SELECT * FROM user WHERE userEmail = :email');
        $this->db->bind(':email', $email);
  
        $row = $this->db->single();
        if($password == $row->userPassword){
          return $row;
        } else {
          return false;
        }
      }

      // Find user by email
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM user WHERE userEmail = :email');
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
        $this->db->query('SELECT * FROM user WHERE iduser = :id');
        // Bind value
        $this->db->bind(':id', $id);
  
        if ($row = $this->db->single()){
          return $row;
        } else {
          return false;
        }
        // Check row
      }

      public function getAllAdmins($role) {
        if ($role =='Owner') {
            $this->db->query('SELECT * FROM `user` WHERE userRole != "Owner" ORDER BY userRole');
            if ($admins = $this->db->resultSet()) {
                return $admins;
            } else {
                return false;
            }
    
            
        } elseif ($role== 'Manager') {
            $this->db->query('SELECT * FROM `user` WHERE userRole= "Salesman"');
            if ($admins = $this->db->resultSet()) {
                return $admins;
            } else {
                return false;
            }
        }

    }

    public function deleteUser($id) {
        $this->db->query('DELETE FROM `school`.`user` WHERE `iduser`='. $id);
        return $this->db->execute();
    }

    function modifyUser($data) {
      $this->db->query("UPDATE `user` SET userName = :name , userEmail = :email, userPhone = :phone, userRole= :role WHERE  iduser=". $data['id']);
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':phone', $data['phone']);
      $this->db->bind(':role', $data['role']);
  
      return $this->db->execute();
      
    }
    
  
  
}//Class

?>
