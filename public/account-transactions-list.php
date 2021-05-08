<?php
session_start();
if($_SESSION['validUser'] == 'yes' && $_REQUEST['userID'] == $_SESSION['userID'] || $_SESSION['validEmployee'] == 'yes') {

//users = Accounts
//accounts = transactions

require_once('../inc/Transactions.class.php');
require_once('../inc/Accounts.class.php');
require_once('../inc/Users.class.php');

$transaction = new Transactions();
$transactionList = $transaction->getListByAccount(
  $_REQUEST['accountID'],
  (isset($_GET['sortColumn']) ? $_GET['sortColumn'] : null),
  (isset($_GET['sortDirection']) ? $_GET['sortDirection'] : null),
  (isset($_GET['filterColumn']) ? $_GET['filterColumn'] : null),
  (isset($_GET['filterText']) ? $_GET['filterText'] : null)
);

$account = new Accounts();
$accountList = $account->getList(
    (isset($_GET['sortColumn']) ? $_GET['sortColumn'] : null),
    (isset($_GET['sortDirection']) ? $_GET['sortDirection'] : null),
    ('accountID'),
    ($_REQUEST['accountID'])
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
require_once('../tpl/account-transactions-list.tpl.php');

} else {
  header("location: access-denied.php");
  exit;
}
?>
