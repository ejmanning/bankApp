<html>
<head>
<meta name="viewport" content="width=device-width, initial scale=1, shrink-to-fit=no">
<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
	<meta charset="UTF-8">
  <link rel="stylesheet" href="css/user-list.css">
</head>
<body>
	<h2>Welcome <?php echo $_SESSION['username']; ?></h2>
	<a href="employee-welcome.php?userID=<?php echo $_SESSION['userID'] ?>"><button>Home</button></a>
    <div id ="container">
      <h1>Employee: <?php echo $userDataArray['firstName'];?> <?php echo $userDataArray['lastName']; ?></h1>
          Employee ID: <?php echo (isset($userDataArray['userID']) ? $userDataArray['userID'] : ''); ?><br>
          Username: <?php echo (isset($userDataArray['username']) ? $userDataArray['username'] : ''); ?><br>
          Password: <?php echo (isset($userDataArray['password']) ? $userDataArray['password'] : ''); ?><br>
          Email: <?php echo (isset($userDataArray['email']) ? $userDataArray['email'] : ''); ?><br>
          Address: <?php echo (isset($userDataArray['address']) ? $userDataArray['address'] : ''); ?><br>
        <a href="employee-list.php"><button>Employee List</button></a>
				<a href="user-input.php?userID=<?php echo $userDataArray['userID']; ?>"><button>Edit Employee Info</button></a>

    </div>
</body>
</html>
