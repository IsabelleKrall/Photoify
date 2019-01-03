<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// Check if both email and password exists in the POST request.
if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    //Prepares, binds email parameter and executes the database query.
    $statement = $pdo->prepare('SELECT * FROM Users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    //Fetch the user as an associative array.
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    //If we dont find the user in db, redirect back to the login page.
    if (!$user) {
        redirect('/login.php');
    }

    //Compare the given password.
    if (password_verify($_POST['password'], $user['password'])) {
        unset($user['password']);
        $_SESSION['user'] = $user;
    }
}

redirect('/');
