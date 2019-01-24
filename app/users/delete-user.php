<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';
// In this file we delete users in the database.


//Checks if user data exists in the POST request:
if (isset($_POST['username'], $_POST['password'], $_POST['confirmPassword'], $_POST['user_id'])) {

    if ($_POST['password'] === $_POST['confirmPassword'])
    {
      $user = getUserProfile($_POST['user_id'], $pdo);

        //If current password is correct with db, update to new password:

        //DUBBELKOLLA DETTA!! Verkar som att usern inte raderas helt - kolla in view-profile.php
        // Lägga till att även Posts, Comments och Likes ska raderas vid detta tillfälle??
        if (password_verify($_POST['password'], $user[0]['password'])) {
          $id = $_POST['user_id'];
          $statement = $pdo->prepare('DELETE FROM Users WHERE id = :id');

            if (!$statement) {
              die(var_dump($pdo->errorInfo()));
            }

            $statement->bindParam(':id', $id, PDO::PARAM_STR);
            $statement->execute();
        }
    }
    redirect('/app/users/logout.php');
  }
