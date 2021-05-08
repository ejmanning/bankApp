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
        <h1>Accounts</h1>

          <div>
              <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="GET">
                  Search:
                  <select name="filterColumn">
                      <option value="accountID">Account ID</option>
                      <option value="type">Type</option>
                      <option value="userID">User ID</option>
                  </select>
                  &nbsp;<input type="text" name="filterText"/>
                  &nbsp;<input type="submit" name="filter" value="Search"/>
              </form>
          </div>

            <div style="overflow-x: auto">
              <table>
                  <tr>
                      <th>User ID&nbsp;&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=userID&sortDirection=ASC">A</a>&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=userID&sortDirection=DESC">D</a></th>
                      <th>Account ID&nbsp;&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=accountID&sortDirection=ASC">A</a>&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=accountID&sortDirection=DESC">D</a></th>
                      <th>Type&nbsp;&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=type&sortDirection=ASC">A</a>&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=type&sortDirection=DESC">D</a></th>
                      <th>Balance&nbsp;&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=balance&sortDirection=ASC">A</a>&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=balance&sortDirection=DESC">D</a></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                  </tr>
                  <?php foreach ($accountList as $accountData)
                  { ?>
                      <tr>
                          <td><?php echo $accountData['userID']; ?></td>
                          <td><?php echo $accountData['accountID']; ?></td>
                          <td><?php echo $accountData['type']; ?></td>
                          <td>$<?php echo $accountData['balance']; ?></td>
                          <td><a href="../public/account-input.php?userID=<?php echo $accountData['userID'];?>&accountID=<?php echo $accountData['accountID']; ?>"><button>Edit Account</button></a></td>
                          <td><a href="../public/transaction-input.php?accountID=<?php echo $accountData['accountID']; ?>"><button>Make Transaction</button></a></td>
                          <td><a href="../public/account-transactions-list.php?userID=<?php echo $accountData['userID']; ?>&accountID=<?php echo $accountData['accountID']; ?>"><button>View Transactions</button></a></td>
                          <td><a href="../public/delete-account-confirm.php?accountID=<?php echo $accountData['accountID']; ?>"><button>Delete Account</button></a></td>

                      </tr>
                  <?php } ?>
              </table>
            </div>
          </div>
    </body>
</html>
