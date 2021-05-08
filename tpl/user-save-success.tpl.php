<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/user-save-success.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    	<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
  </head>
  <body>
    <h1>User was saved!</h1>
    <?php if($_SESSION['validEmployee'] == 'yes') { ?>
      <a href="user-list.php"><button>User list</button></a>
    <?php } else { ?>
      <a href="login.php"><button>Log In</button></a>
    <?php } ?>
  </body>
</html>
