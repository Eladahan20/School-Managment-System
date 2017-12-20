<?php

class File {

    public $name;
    public $type;
    public $tmp_name;
    // public $error;
    public $size;
    public $uploadOk = 1;
    public $errors = [];
    

    public static $dir = PUBLICROOT. "\img";
    public static $paths = array("image/jpg", "image/jpeg", "image/png", "image/gif");


    public function __construct($data) {
            $this->name = $data['name'];
            $this->type = $data['type'];
            $this->tmp_name = $data['tmp_name']; 
            $this->error = $data['error']; 
            $this->size = $data['size'];
            $this->target_file = self::$dir. "/" . basename($data['name']);
    }


    public function Upload(){
            if ($this->checkSize() && $this->checkIfExist() && $this->checkFilePath()) {
            move_uploaded_file($this->tmp_name, $this->target_file);
            return true;
        } else {
            return $this->errors;
        }
    }
   


    public  function checkSize(){
        if ($this->size > 50000000) {
            $this->errors[] = "File is Too Big"; 
            return false;
        } else {
            return true;
        }
    }

    public  function checkIfExist() {
        if (file_exists($this->target_file)) {
            $this->errors[] = "File is Already Exist";
            return false;
        } else {
            return true;
        }
    }

    public  function checkFilePath(){
        if (!in_array($this->type, self::$paths)) {
            $this->errors[]="File is Not an Image";
        }  else {
            return true;
        }
    }


}

?>