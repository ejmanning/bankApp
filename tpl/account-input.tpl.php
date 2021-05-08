<html>
<head>
<meta name="viewport" content="width=device-width, initial scale=1, shrink-to-fit=no">
<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
	<meta charset="UTF-8">
  <link rel="stylesheet" href="css/user-input.css">
<title>Input or Edit Account</title>
</head>
<body>
	<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" enctype="multipart/form-data">

		<?php if (isset($accountErrorsArray['type']))
		      { ?>
		        <div id="error"><?php echo $accountErrorsArray['type']; ?></div>
		<?php } ?>
		Account Type:<br>
    <input type="radio" name="type" id="checkings" value="checkings" <?php if (isset($accountDataArray['type']) && $accountDataArray['type'] == "checkings") echo "checked";?>>Checkings<br>
    <input type="radio" name="type" id="savings" value="savings"<?php if (isset($accountDataArray['type']) && $accountDataArray['type'] == "savings") echo "checked";?>>Savings<br>

		<?php if (isset($accountErrorsArray['balance']))
		      { ?>
		        <div id="error"><?php echo $accountErrorsArray['balance']; ?></div>
		<?php } ?>
		Balance: $<input type="text" name="balance" id="balance" value="<?php echo (isset($accountDataArray['balance']) ? $accountDataArray['balance'] : ''); ?>"><br />

<?php if (isset($accountErrorsArray['interestRate']))
      { ?>
        <div id="error"><?php echo $accountErrorsArray['interestRate']; ?></div>
<?php } ?>
		Interest Rate: <input type="number" name="interestRate" id="interestRate" readonly value="0.06"><br />

		<?php if (isset($accountErrorsArray['dateCreated']))
		      { ?>
		        <div id="error"><?php echo $accountErrorsArray['dateCreated']; ?></div>
		<?php } ?>
		Date Created: <input type="date" name="dateCreated" id="dateCreated" value="<?php echo (isset($accountDataArray['dateCreated']) ? $accountDataArray['dateCreated'] : ''); ?>"><br />


    <input type="hidden" name="userID" value="<?php echo (isset($userDataArray['userID']) ? $userDataArray['userID'] : ''); ?>"/>
		<input type="hidden" name="accountID" value="<?php echo (isset($accountDataArray['accountID']) ? $accountDataArray['accountID'] : ''); ?>"/>
		<input name="Save" type="submit" value="Save" />
    <input name="Cancel" type="button" value="Cancel" onclick = "window.history.back()" />
	</form>
</body>
</html>
