<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(!empty($_POST['name']) && !empty($_POST['email'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    if(is_string($name)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $data = file_get_contents('users.json');
            $dataArray = json_decode($data, true);
            
            if(!empty($dataArray) && in_array($email, array_column($dataArray, 'email'))){
                echo "Sorry this email is already used";
                exit;
            }
            $input = [
                'name' => $name,
                'email' => $email,
            ];
            $dataArray[] = $input;
            $dataArray = json_encode($dataArray, JSON_PRETTY_PRINT);
            file_put_contents('users.json', $dataArray);
            echo "You have successfully subscribed";

        }else{
            echo "Sorry enter valid email address";
        }

    }else{
        echo "Please enter a valid name";
    }

}else{
    echo "Sorry enter name and valid email";
}