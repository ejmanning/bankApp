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
        <?php
        if($_SERVER['SCRIPT_NAME'] == '/bank/public/user-list.php' ) {?>
          <h1>Users</h1>
        <?php } else if($_SERVER['SCRIPT_NAME'] == '/bank/public/employee-list.php' ) {?>
          <h1>Employees</h1>
        <?php } ?>
        <?php if($_SERVER['SCRIPT_NAME'] == '/bank/public/user-list.php' ) {?>
          <a href="../public/user-input.php"><button>Add User</button></a>
        <?php } else if($_SERVER['SCRIPT_NAME'] == '/bank/public/employee-list.php' ) {?>
          <a href="../public/user-input.php"><button>Add Employee</button></a>
        <?php } ?>

              <table>
                  <tr>
                      <th>User ID&nbsp;&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=userID&sortDirection=ASC">A</a>&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=userID&sortDirection=DESC">D</a></th>
                      <th>First Name&nbsp;&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=firstName&sortDirection=ASC">A</a>&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=firstName&sortDirection=DESC">D</a></th>
                      <th>Last Name&nbsp;&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=lastName&sortDirection=ASC">A</a>&nbsp;<a href="<?php echo $_SERVER['SCRIPT_NAME']; ?>?sortColumn=lastName&sortDirection=DESC">D</a></th>
                      <th></th>
                      <th></th>
                      <th></th>

                  </tr>
                  <?php foreach ($userList as $userData)

                  { ?>

                      <tr>
                          <td><?php echo $userData['userID']; ?></td>
                          <td><?php echo $userData['firstName']; ?></td>
                          <td><?php echo $userData['lastName']; ?></td>
                          <?php if($userData['userLevel'] == "user") { ?>
                            <td><a href="../public/user-input.php?userID=<?php echo $userData['userID']; ?>"><button>Edit User Info</button></a></td>
                          <?php } else if($userData['userLevel'] == "employee") { ?>
                            <td><a href="../public/user-input.php?userID=<?php echo $userData['userID']; ?>"><button>Edit Employee</button></a></td>
                          <?php } ?>

                          <?php if($userData['userLevel'] == "user") { ?>
                            <td><a href="../public/user-accounts.php?userID=<?php echo $userData['userID']; ?>"><button>View Account Info</button></a></td>
                          <?php } else if($userData['userLevel'] == "employee") { ?>
                            <td><a href="../public/employee-info.php?userID=<?php echo $userData['userID']; ?>"><button>View Employee Info</button></a></td>
                          <?php } ?>
                          <td><a href="../public/delete-user-confirm.php?userID=<?php echo $userData['userID']; ?>"><button>Delete</button></a></td>

                      </tr>
                  <?php }
                 ?>
              </table>
          </div>
    </body>
</html>
