<?php
session_start();

require_once('../inc/Users.class.php');

$user = new Users();
$userList = $user->getList(
    (isset($_GET['sortColumn']) ? $_GET['sortColumn'] : null),
    (isset($_GET['sortDirection']) ? $_GET['sortDirection'] : null),
    ('userLevel'),
    ('employee')
);

//var_dump($userList);
require_once('../tpl/user-list.tpl.php');

?>
