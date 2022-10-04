<?php

if(isset($_POST['name'], $_POST['email'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    if(is_string($name)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $data = file_get_contents('users.json');
            $dataArray = json_decode($data, true);
            $input = [
                'name' => $name,
                'email' => $email,
            ];
            $dataArray[] = $input;
            $dataArray = json_encode($dataArray, JSON_PRETTY_PRINT);
            file_put_contents('users.json', $dataArray);
            echo "You have successfully subscribe";

        }else{
            echo "Sorry enter valid email address";
        }

    }else{
        echo "Please enter a valid name";
    }

}else{
    echo "Sorry enter name and valid email"
}