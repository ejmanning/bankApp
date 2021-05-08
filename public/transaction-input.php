<?php
session_start();
if($_SESSION['validUser'] == 'yes' && $_REQUEST['userID'] = $_SESSION['userID'] || $_SESSION['validEmployee'] == 'yes') {

require_once('../inc/Accounts.class.php');
require_once('../inc/Transactions.class.php');

$account = new Accounts();
$accountDataArray = array();



$transaction = new Transactions();

$transactionDataArray = array();
$transactionErrorsArray = array();

// load the account if we have it
if (isset($_REQUEST['transactionID']) && $_REQUEST['transactionID'] > 0)
{
    $transaction->load($_REQUEST['transactionID']);
    $transactionDataArray = $transaction->transactionData;
}

if (isset($_REQUEST['accountID']) && $_REQUEST['accountID'] > 0)
{
    $account->load($_REQUEST['accountID']);
    $accountDataArray = $account->accountData;
    //var_dump($accountDataArray['balance']);
    $currentBalance = $accountDataArray['balance'];
}

// apply the data if we have new data
if (isset($_POST['Save'])) {

    $transactionDataArray = $_POST;
    //var_dump(floatval($currentBalance));
    //var_dump($accountDataArray['balance']);

    if($transactionDataArray['type'] === "deposit") {
      $newBalance = floatval($currentBalance) + $transactionDataArray['amount'];
      $accountDataArray['balance'] = $newBalance;
      //var_dump($accountDataArray);
      //var_dump($newBalance);
    } else if($transactionDataArray['type'] == "withdraw") {
      $newBalance = floatval($currentBalance) - $transactionDataArray['amount'];
      $accountDataArray['balance'] = $newBalance;
      //var_dump($accountDataArray['balance']);
    }


    /*if($transactionDataArray['type'] == "deposit") {
      $account->depositMoney($transactionDataArray['amount'], $currentBalance);
    } else if($transactionDataArray['type'] == "withdraw") {
      $account->withdrawMoney($transactionDataArray['amount'], $currentBalance);
    }die;*/
    //sanitize
    $accountDataArray = $account->sanitize($accountDataArray);
    $transactionDataArray = $transaction->sanitize($transactionDataArray);
    //var_dump("sanitized");
    $account->set($accountDataArray);
    $transaction->set($transactionDataArray);

    //validate
    if ($transaction->validate() && $account->validate())
    {

        //  save
        if ($transaction->save() && $account->save())
        {

          header("location: transaction-save-success.php");


        }
        else
        {
            $transactionErrorsArray[] = "Save failed";
        }
    }
    else
    {
        $transactionErrorsArray = $transaction->errors;
        $transactionDataArray = $transaction->transactionData;
    }

    //var_dump($faqErrorsArray);
  }
    require_once('../tpl/transaction-input.tpl.php');
  } else {
    header("location: access-denied.php");
    exit;
  }
?>
