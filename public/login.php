<?php
session_start();
$_SESSION['validUser'] = 'no';
$_SESSION['validEmployee'] = 'no';
require_once('../inc/Users.class.php');
$user = new Users();

//print "<h1> $message</h1>";
if (isset($_POST['submitLogin']))
{
    $userData = $_POST;
    // sanitize
    $userData = $user->sanitize($userData);
    $user->set($userData);
    $user->authorizeUser($_POST['username'], $_POST['password']);
    if ($userInfo = $user->authorizeUser($_POST['username'], $_POST['password']))
    {

      $_SESSION['userID'] = $userInfo[0];
      $_SESSION['username'] = $userInfo[1];
      $_SESSION['user_level'] = $userInfo[3];

      if($userInfo[3] == "user") {
        $_SESSION['validUser'] = 'yes';
        $_SESSION['validEmployee'] = 'no';
        $_SESSION['userID'] = $userInfo[0];
      } else if($userInfo[3] == "employee") {
        $_SESSION['validUser'] = 'no';
        $_SESSION['validEmployee'] = 'yes';
      }

      if($userInfo[3] == "user") {
        header("location: user-welcome.php?userID=$userInfo[0]");
        exit;
      } else if($userInfo[3] == "employee") {
        header("location: employee-welcome.php?userID=$userInfo[0]");
        exit;
      }
    }
    else
    {
        echo "Login failed";
    }
}

require_once('../tpl/login.tpl.php');
?>
