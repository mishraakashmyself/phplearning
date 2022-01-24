<?php

if (empty($_POST['email'])) {
    $data['success'] = false;
    $data['message'] = 'Email is required field. Please enter email.';
} else {

    $emailText = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $isEmailAvailable = isEmailAvailable($emailText);

  
    if ( $isEmailAvailable) {
        $data['success'] = false;
        $data['message'] = 'This Email is already registered with us. Please Login with this email and proceed.';
    } else {
        $data['success'] = true;
        $data['message'] = 'This Email is New.';
    }
}

function isEmailAvailable($email) {

    try {
        $host = 'localhost';
        $db = 'testDb';
        $user = 'testuser';
        $pwd = 'password';


        $conn = new PDO("mysql:host=$host; dbname=$db", $user, $pwd);

        $isEmailExistSql = "select  email  from user where email = ?";

        $stmt = $conn->prepare($isEmailExistSql);
        $stmt->execute(array($email));

        $count = $stmt->rowCount();
       
        return $count > 0 ? true: false;
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

echo json_encode($data);
?>
