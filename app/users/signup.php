<?php
declare(strict_types=1);

require __DIR__.'/../autoload.php';


if (isset($_POST['username'],$_POST['email'],$_POST['name'], $_POST['password'], $_POST['r_password'])) {

if ($_POST['password'] === $_POST['r_password']) {
  $_SESSION['message'] = 'Please insert the same password';
  redirect('/signup.php');


  $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
  $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
  $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  // $created_at = ("y-m-d");

  $statement = $pdo->prepare("SELECT email, username FROM users WHERE username = :username AND email = :email");

  if (!$statement){
  die(var_dump($pdo->errorInfo()));
  }

  $statement->bindParam(':username', $username, PDO::PARAM_STR);
  $statement->bindParam(':email', $email, PDO::PARAM_STR);

  $statement->execute();
  $user = $statement->fetch(PDO::FETCH_ASSOC);

  if ($user['email'] == $email || $user['username'] == $username) {
        $_SESSION['message'] = 'sorry you alredy have an account. sign in';
        redirect('/signup.php');
  }


  $statement = $pdo->prepare('INSERT INTO users(name, username, email, password)
  VALUES(:name, :username, :email, :password)');

  if (!$statement){
  die(var_dump($pdo->errorInfo()));
  }

  //Insert statement

  $statement->bindParam(':username', $username, PDO::PARAM_STR);
  $statement->bindParam(':name', $name, PDO::PARAM_STR);
  $statement->bindParam(':email', $email, PDO::PARAM_STR);
  $statement->bindParam(':password', $password, PDO::PARAM_STR);


  $statement->execute();
  $user = $statement->fetch(PDO::FETCH_ASSOC);


    $_SESSION['user'] = [
         'id' => $id,
         'email' => $email,
         'name' => $name,
         'profile_bio' => $profile_bio,
         'username' => $username,
         'profile_pic' => $profile_pic
          ];

$_SESSION['message'] = 'Log in to your new account';

redirect('/login.php');

die(var_dump($user[$name]));

}
   redirect('/');
}


?>
