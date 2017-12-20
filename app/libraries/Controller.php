<?php

/* The base controller
* Loads the models and vies 
*/

class Controller {

    // Require and load the requested model.
    public function model($model) {
        require_once '../app/models/'. $model .'.php';
        return new $model();
    }

    public function view($view, $data=[]) {
        if (file_exists('../app/views/'. $view .'.php')){
        require_once '../app/views/'. $view .'.php';
        }else {
            die('view does not exist');
        }
    
    }
}