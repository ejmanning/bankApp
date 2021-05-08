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
      <h1>Are you sure you want to delete this account?</h1>
      <a href= "delete-account.php?accountID=<?php echo $accountDataArray['accountID']; ?>"><button>Yes, I'm sure</button></a>
      <button onclick="history.go(-1);">No, go back </button>
</div>
</body>
</html>
