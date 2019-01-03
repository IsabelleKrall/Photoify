<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';


//Checks if username, email, name, password exists in the POST request:
if (isset($_POST['username'],$_POST['email'],$_POST['name'], $_POST['password'], $_POST['confirmPassword'])) {


//Checks if the password match & sanitizes username, firstname, lastname, email, password. And adds the new user to the database.
if ($_POST['password'] === $_POST['confirmPassword']) {

  $firstName = filter_var(trim($_POST['firstName']), FILTER_SANITIZE_STRING);
  $lastName = filter_var(trim($_POST['lastName']), FILTER_SANITIZE_STRING);
  $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
  $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $created_at = date("Y-m-d");

  $statement = $pdo->prepare('INSERT INTO Users(first_name, last_name, email, username, password, created_at)
  VALUES (:firstName, :lastName, :email, :userName, :password, :created_at)');

    if (!$statement){
    die(var_dump($pdo->errorInfo()));
    }

//Checks if a user already exists:
if ($user['email'] == $email || $user['username'] == $username) {
  $statement = $pdo->prepare("SELECT email, username FROM Users WHERE username = :username AND email = :email");
  $_SESSION['message'] = 'You already have an account';
    redirect('/login.php');
}

    if (!$statement){
    die(var_dump($pdo->errorInfo()));
    }

//Binds variables to parameteres for insert statement:
    $statement->bindParam(':firstName', $firstName, PDO::PARAM_STR);
    $statement->bindParam(':lastName', $lastName, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':userName', $username, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':created_at', $created_at, PDO::PARAM_STR);
    $statement->execute();
    redirect('/login.php');
    }
};
?>
