<?php
session_start();

if($_SESSION['validEmployee'] == 'yes') {

require_once('../inc/Accounts.class.php');
require_once('../inc/Users.class.php');

$account = new Accounts();
$accountList = $account->getListByUser(
  $_REQUEST['userID'],
  (isset($_GET['sortColumn']) ? $_GET['sortColumn'] : null),
  (isset($_GET['sortDirection']) ? $_GET['sortDirection'] : null),
  (isset($_GET['filterColumn']) ? $_GET['filterColumn'] : null),
  (isset($_GET['filterText']) ? $_GET['filterText'] : null)
);

$user = new Users();
$userList = $user->getList(
    (isset($_GET['sortColumn']) ? $_GET['sortColumn'] : null),
    (isset($_GET['sortDirection']) ? $_GET['sortDirection'] : null),
    ('userID'),
    ($_REQUEST['userID'])
);

//var_dump($userList);
//var_dump($_REQUEST['userID']);
//var_dump($accountList);

//var_dump($_SESSION['userID']);
require_once('../tpl/employee-welcome.tpl.php');
} else {
  header("location: access-denied.php");
  exit;
}
?>
