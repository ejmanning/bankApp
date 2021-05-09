<?php
session_start();
if($_SESSION['validUser'] == 'yes' && $_REQUEST['userID'] == $_SESSION['userID'] || $_SESSION['validEmployee'] == 'yes' || $_SESSION['validUser'] == 'no' || $_SESSION['validUser'] == null) {

require_once('../inc/Users.class.php');

$user = new Users();

$userDataArray = array();
$userErrorsArray = array();

// load the faq if we have it
if (isset($_REQUEST['userID']) && $_REQUEST['userID'] > 0)
{
    $user->load($_REQUEST['userID']);
    $userDataArray = $user->userData;
}

// apply the data if we have new data
if (isset($_POST['Save'])) {
    $userDataArray = $_POST;
    //var_dump($userDataArray);
    //sanitize

    $userDataArray = $user->sanitize($userDataArray);
    //var_dump("sanitized");
    $user->set($userDataArray);
    //var_dump($user);
    //validate
    if ($user->validate())
    {
      //var_dump($user);
        //  save
        if ($user->save())
        {
          header("location: user-save-success.php");


        }
        else
        {
            $userErrorsArray[] = "Save failed";
        }
    }
    else
    {
        $userErrorsArray = $user->errors;
        $userDataArray = $user->userData;
    }

    //var_dump($faqErrorsArray);
  }
    require_once('../tpl/user-input.tpl.php');
  } else {
    header("location: access-denied.php");
    exit;
  }
?>
