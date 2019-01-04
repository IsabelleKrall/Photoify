<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';


//Checks if user data exists in the POST request:
if (isset($_POST['profile_bio'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['username'],$_POST['password'], $_POST['confirmPassword']))
  {
   //Checks if passwords match:
   if ($_POST['password'] === $_POST['confirmPassword'])
   {
    //Sanitizes and saves posted user data to variables
      $bio = trim(filter_var($_POST['profile_bio'],FILTER_SANITIZE_STRING));
      $firstName = filter_var(trim($_POST['firstName']), FILTER_SANITIZE_STRING);
      $lastName = filter_var(trim($_POST['lastName']), FILTER_SANITIZE_STRING);
      $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
      $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $id = $_SESSION['user']['id'];

      $statement = $pdo->prepare('UPDATE Users SET profile_bio = :profile_bio, first_name = :firstName, last_name = :lastName, email = :email, username = :username, password = :password WHERE id = :id');

        if (!$statement){
          die(var_dump($pdo->errorInfo()));
        }

      //Binds variables to parameteres for insert statement:
        $statement->bindParam(':profile_bio', $bio, PDO::PARAM_STR);
        $statement->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $statement->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->execute();
      }

  //Keep this below???:
    // $statement = $pdo->prepare('SELECT * FROM Users WHERE id = :id');
    // $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_STR);
    // $statement->execute();
    // $user = $statement->fetch(PDO::FETCH_ASSOC);
    // $_SESSION['logedin'] = [
    //     'id' => $user['id'],
    //     'email' => $user['email'],
    //     'firstName' => $user['firstName'],
    //     'lastName' => $user['lastName'],
    //     'profile_pic' => $user['profile_pic'],
    //     'profile_bio' => $user['profile_bio'],
    //     'username' => $user['username'],
    //     ];

    redirect('/profile.php');
  };
