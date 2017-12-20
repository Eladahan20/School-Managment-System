<?php


function ValidateInput($data) {
   
    foreach ($data as $key => $value) {
        switch ($key) {
            case 'name':
                // Validate Name
                if(empty($data['name'])){
                    $data['name_err'] = 'Pleae enter name';
                } else {
                    $data['name_err'] = '';
                }
                break;
            case 'email':
                 // Check email
                 if(empty($data['email'])){
                    $data['email_err'] = 'Pleae enter email';
                }  else {
                    $data['email_err'] = '';
                }
                break;
            case 'phone':
                // Validate Phone
                if(strlen($data['phone']) < 10 && !is_numeric($data['phone'])){
                    $data['phone_err'] = 'Pleae enter a valid phone number';
                } else{
                    $data['phone_err'] = '';
                } 
                break;
            case 'image':
                // Validate Image 
                $data['image_err'] = '';    
                if(empty($_FILES['image']['name'])) {
                    $data['image_err'] = "No image file"; 
                } else {
                    $data['image'] = new File($_FILES['image']);
                    $response = $data['image']->upload();
                    if(!is_bool($response)){
                        $data['image_err'] = implode(",",$response);;
                        } else {
                            $data['image'] = $data['image']->name;
                    }
                }
            case 'description':
                if(empty($data['description'])){
                    $data['description_err'] = 'Pleae enter description';
                } else {
                    $data['description_err']='';
                }
                break;
            case 'role':
                if(empty($data['role'])){
                    $data['role_err'] = 'Pleae select role';
                } else {
                    $data['role_err'] ='';
                }
            default:
                # code...
                break;
        }
    }
    return $data;
}



?>