<?php
session_start();
if($_SESSION['validEmployee'] == 'yes') {
require_once('../inc/Users.class.php');

$user = new Users();
$userList = $user->getList(
    (isset($_GET['sortColumn']) ? $_GET['sortColumn'] : null),
    (isset($_GET['sortDirection']) ? $_GET['sortDirection'] : null),
    ('userLevel'),
    ('user')
);

//var_dump($userList);
require_once('../tpl/user-list.tpl.php');
} else {
  header("location: access-denied.php");
  exit;
}
?>
