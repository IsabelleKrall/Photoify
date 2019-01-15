<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';
// In this file we store/insert new posts in the database.
if(isset($_FILES['content'], $_POST['username'])) {
    $content = $_FILES['content'];
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $created_at = date("Y-m-d");
    $description = trim(filter_var($_POST['description'], FILTER_SANITIZE_STRING)) ?? '';
    $errors = [];

    if($content['size'] >= 4194304) {
        $errors[] = $content['name'] . ' Is too big';
    }
    if (!file_exists(__DIR__ .'/../uploads/')) {
        mkdir(__DIR__ .'/../uploads/');
    }
    if(count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        print_r($errors);
        exit;
    }

    $destination = '/../uploads/' . $content['name'];
    move_uploaded_file($content['tmp_name'], __DIR__.$destination);

    //Sets destination and inserts file in DB
    $destination = '/app/uploads/' . $content['name'];
    $statement = $pdo->prepare('INSERT INTO Posts (user_id, description, content, created_at, username)
    VALUES (:user_id, :description, :content, :created_at, :username)');
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':content', $content['name'], PDO::PARAM_STR);
    $statement->bindParam(':created_at', $created_at, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    if(!$statement){
        die(var_dump($statement->errorInfo()));
    }
    redirect('/profile.php');
}
