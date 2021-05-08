<html>
<head>
<meta name="viewport" content="width=device-width, initial scale=1, shrink-to-fit=no">
<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
	<meta charset="UTF-8">
  <link rel="stylesheet" href="css/user-input.css">
<title>Input or Edit Transaction</title>
</head>
<body>
	<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" enctype="multipart/form-data">
		<h1>Current Balance: $<?php echo $currentBalance; ?></h1>
		<?php if (isset($transactionErrorsArray['type']))
		      { ?>
		        <div id="error"><?php echo $transactionErrorsArray['type']; ?></div>
		<?php } ?>
		Transaction Type:<br>
    <input type="radio" name="type" id="withdraw" value="withdraw" <?php if (isset($transactionDataArray['type']) && $transactionDataArray['type'] == "withdraw") echo "checked";?>>Withdraw<br>
    <input type="radio" name="type" id="deposit" value="deposit"<?php if (isset($transactionDataArray['type']) && $transactionDataArray['type'] == "deposit") echo "checked";?>>Deposit<br>

		<?php if (isset($transactionErrorsArray['amount']))
		      { ?>
		        <div id="error"><?php echo $transactionErrorsArray['amount']; ?></div>
		<?php } ?>
		Amount: $<input type="text" name="amount" id="amount" value="<?php echo (isset($transactionDataArray['amount']) ? $transactionDataArray['amount'] : ''); ?>"><br />

		<?php if (isset($transactionErrorsArray['dateOfTransaction']))
		      { ?>
		        <div id="error"><?php echo $transactionErrorsArray['dateOfTransaction']; ?></div>
		<?php } ?>
		Date of Transaction: <input type="date" name="dateOfTransaction" id="dateOfTransaction" value="<?php echo (isset($transactionDataArray['dateOfTransaction']) ? $transactionDataArray['dateOfTransaction'] : ''); ?>"><br />


    <input type="text" name="accountID" value="<?php echo (isset($accountDataArray['accountID']) ? $accountDataArray['accountID'] : ''); ?>"/>
		<input type="text" name="transactionID" value="<?php echo (isset($transactionDataArray['transactionID']) ? $transactionDataArray['transactionID'] : ''); ?>"/>
		<input name="Save" type="submit" value="Save" />
    <input name="Cancel" type="button" value="Cancel" onclick = "window.history.back()" />
	</form>
</body>
</html>
