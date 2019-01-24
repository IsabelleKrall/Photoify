<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';
//In this file we update user password in db.


//Checks if user data exists in the POST request:
if (isset($_POST['username'], $_POST['password'], $_POST['newPassword'], $_POST['repNewPassword'], $_POST['user_id'])) {

    //Checks if the new password match:
    if ($_POST['newPassword'] === $_POST['repNewPassword'])
    {
      $user = getUserProfile($_POST['user_id'], $pdo);

        //If current password is correct with db, update to new password:
        if (password_verify($_POST['password'], $user[0]['password'])) {
          $password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
          $id = $_POST['user_id'];

          $statement = $pdo->prepare('UPDATE Users SET password = :password WHERE id = :id');

            if (!$statement){
              die(var_dump($pdo->errorInfo()));
            }

          $statement->bindParam(':password', $password, PDO::PARAM_STR);
          $statement->bindParam(':id', $id, PDO::PARAM_STR);
          $statement->execute();

          $_SESSION['message'] = "Your password has been updated!";
          redirect('/change-password.php');

        }
    }
}
