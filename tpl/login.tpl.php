<html>
  <head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    	<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/login.css">
  </head>
    <body>
      <form action="../public/login.php" method="POST">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" value="">
<br>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" value="">

<br>
      <button type="submit" name="submitLogin">Submit</button>
      <button type="reset">Reset</button>

    </form>
    <a href="index.php"><button>Home</button></a>
    </body>
</html>
