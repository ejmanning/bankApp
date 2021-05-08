<html>
<head>
<meta name="viewport" content="width=device-width, initial scale=1, shrink-to-fit=no">
<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
	<meta charset="UTF-8">
  <link rel="stylesheet" href="css/delete.css">
</head>
<body>
<div id="container">
  <h1><?php echo $deleteMsg ?></h1>
  <?php if($_SESSION['validEmployee'] == 'yes') { ?>
    <a href="user-list.php"><button>User list</button></a>
  <?php } else { ?>
    <a href="user-welcome.php?userID=<?php echo $_SESSION['userID'];?>"><button>Home</button></a>
  <?php } ?>

</div>
</body>
</html>
