<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';


//Checks if username, email, name, password exists in the POST request:
if (isset($_POST['username'],$_POST['email'],$_POST['name'], $_POST['password'], $_POST['rep_password'])) {


  //Checks if the password match & sanitizes username, name, email, password. And adds the new user to the database.
  if ($_POST['password'] === $_POST['rep_password']) {

    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $statement = $pdo->prepare('INSERT INTO Users(name, username, email, password) VALUES(:name, :username, :email, :password)');


      if (!$statement){
      die(var_dump($pdo->errorInfo()));
      }

//Checks if a user already exists:
if ($user['email'] == $email || $user['username'] == $username) {
  $statement = $pdo->prepare("SELECT email, username FROM Users WHERE username = :username AND email = :email");
  $_SESSION['message'] = 'You already have an account';
    redirect('/signup.php');
}
    if (!$statement){
    die(var_dump($pdo->errorInfo()));
    }


  // Insert statements:
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

  redirect('/');
}
?>
