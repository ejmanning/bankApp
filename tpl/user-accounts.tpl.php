<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
  <link rel="stylesheet" href = "css/user-list.css">
</head>
    <body>
      <h2>Welcome <?php echo $_SESSION['username']; ?></h2>
      <?php if($_SESSION['validUser'] == 'yes') { ?>
        <a href="user-welcome.php?userID=<?php echo $_SESSION['userID']?>"><button>Home</button></a>
      <?php } else if($_SESSION['validEmployee'] == 'yes') { ?>
        <a href="employee-welcome.php?userID=<?php echo $_SESSION['userID']?>"><button>Home</button></a>
      <?php } ?>
      <div id="container">
        <h1><?php echo $userList[0]['firstName']?>'s Accounts</h1>
        <a href="account-input.php?userID=<?php echo $userList[0]['userID']; ?>"><button>Add Account</button></a>
            <div style="overflow-x: auto">
              <table>
                  <tr>
                      <th>&nbsp;Type&nbsp;</th>
                      <th>&nbsp;Balance&nbsp;</th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>

                  </tr>
                  <?php foreach ($accountList as $accountData)
                  { ?>
                      <tr>
                          <td><?php echo $accountData['type']; ?></td>
                          <td>$<?php echo $accountData['balance']; ?></td>
                          <td><a href="../public/account-input.php?userID=<?php echo $userList[0]['userID'];?>&accountID=<?php echo $accountData['accountID']; ?>"><button>Edit Account</button></a></td>
                          <td><a href="../public/transaction-input.php?userID=<?php echo $userList[0]['userID'];?>&accountID=<?php echo $accountData['accountID']; ?>"><button>Make Transaction</button></a></td>
                          <td><a href="../public/account-transactions-list.php?userID=<?php echo $userList[0]['userID']; ?>&accountID=<?php echo $accountData['accountID']; ?>"><button>View Transactions</button></a></td>
                          <td><a href="../public/delete-account-confirm.php?accountID=<?php echo $accountData['accountID']; ?>"><button>Delete Account</button></a></td>

                      </tr>
                  <?php } ?>
              </table><br>
            </div>
              <button onclick="window.history.back()">Back</button></a>
          </div>
    </body>
</html>
