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
      <div id="container">
        <h1><?php echo $userList[0]['firstName']?> <?php echo $userList[0]['lastName']?></h1>
        <a href="employee-info.php?userID=<?php echo $userList[0]['userID']; ?>"><button>View My Information</button></a>
        <a href="employee-list.php"><button>View All Employees</button></a>
        <a href="user-list.php"><button>View All Users</button></a>
        <a href="account-list.php"><button>View All Bank Accounts</button></a>
        <a href="logout.php"><button>Log Out</button></a>
          </div>
    </body>
</html>
