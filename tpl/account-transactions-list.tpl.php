<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
  <link rel="stylesheet" href = "css/user-list.css">
  <style>
    table {
      width: 50%;
      text-align: center;
    }
  </style>
</head>
    <body>
      <h2>Welcome <?php echo $_SESSION['username']; ?></h2>
      <?php if($_SESSION['validUser'] == 'yes') { ?>
        <a href="user-welcome.php?userID=<?php echo $_SESSION['userID']?>"><button>Home</button></a>
      <?php } else if($_SESSION['validEmployee'] == 'yes') { ?>
        <a href="employee-welcome.php?userID=<?php echo $_SESSION['userID']?>"><button>Home</button></a>
      <?php } ?>
      <div id="container">
        <h1><?php echo $userList[0]['firstName']?>'s <?php echo $accountList[0]['type']?> Account Transactions</h1>
        <a href="transaction-input.php?userID=<?php echo $userList[0]['userID']?>&accountID=<?php echo $accountList[0]['accountID']; ?>"><button>New Transaction</button></a>
        <h2>Current Balance: $<?php echo $accountList[0]['balance']?></h2>
          <div style="overflow-x: auto">
              <table>
                  <tr>
                      <th>&nbsp;Date&nbsp;</th>
                      <th>&nbsp;Type&nbsp;</th>
                      <th>&nbsp;Amount&nbsp;</th>

                  </tr>
                  <?php foreach ($transactionList as $transactionData)
                  { ?>
                      <tr>
                          <?php
                            $oldDateOfTransaction = $transactionData['dateOfTransaction'];
                            $dateOfTransaction = date("F jS, Y", strtotime($oldDateOfTransaction));
                          ?>
                          <td><?php echo $dateOfTransaction ?></td>
                          <td><?php echo $transactionData['type']; ?></td>
                          <td>$<?php echo $transactionData['amount']; ?></td>

                      </tr>
                  <?php } ?>
              </table>
            </div>
          </div>
    </body>
</html>
