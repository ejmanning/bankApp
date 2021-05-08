<html>
<head>
<meta name="viewport" content="width=device-width, initial scale=1, shrink-to-fit=no">
<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
	<meta charset="UTF-8">
  <link rel="stylesheet" href="css/user-input.css">
<title>Input or Edit User</title>
</head>
<body>
	<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" enctype="multipart/form-data">

		<?php if (isset($userErrorsArray['firstName']))
		      { ?>
		        <div id="error"><?php echo $userErrorsArray['firstName']; ?></div>
		<?php } ?>
		First Name: <input type="text" name="firstName" id="firstName" value="<?php echo (isset($userDataArray['firstName']) ? $userDataArray['firstName'] : ''); ?>"><br />

		<?php if (isset($userErrorsArray['lastName']))
		      { ?>
		        <div id="error"><?php echo $userErrorsArray['lastName']; ?></div>
		<?php } ?>
		Last Name: <input type="text" name="lastName" id="lastName" value="<?php echo (isset($userDataArray['lastName']) ? $userDataArray['lastName'] : ''); ?>"><br />

<?php if (isset($userErrorsArray['username']))
      { ?>
        <div id="error"><?php echo $userErrorsArray['username']; ?></div>
<?php } ?>
		Username: <input type="text" name="username" id="username" value="<?php echo (isset($userDataArray['username']) ? $userDataArray['username'] : ''); ?>"><br />

		<?php if (isset($userErrorsArray['password']))
		      { ?>
		        <div id="error"><?php echo $userErrorsArray['password']; ?></div>
		<?php } ?>
		Password: <input type="password" name="password" id="password" value="<?php echo (isset($userDataArray['password']) ? $userDataArray['password'] : ''); ?>"><br />

		<?php if (isset($userErrorsArray['address']))
		      { ?>
		        <div id="error"><?php echo $userErrorsArray['address']; ?></div>
		<?php } ?>
		Address: <input type="text" name="address" id="address" value="<?php echo (isset($userDataArray['address']) ? $userDataArray['address'] : ''); ?>"><br />

		<?php if (isset($userErrorsArray['email']))
		      { ?>
		        <div id="error"><?php echo $userErrorsArray['email']; ?></div>
		<?php } ?>
		User Email: <input type="email" name="email" id="email" value="<?php echo (isset($userDataArray['email']) ? $userDataArray['email'] : ''); ?>"><br />

		<?php if (isset($userErrorsArray['userLevel']))
		      { ?>
		        <div id="error"><?php echo $userErrorsArray['userLevel']; ?></div>
		<?php } ?>
    User<input type="radio" name="userLevel" id="user" value="user" <?php if (isset($userDataArray['userLevel']) && $userDataArray['userLevel'] == "user") echo "checked";?>>
    Employee<input type="radio" name="userLevel" id="employee" value="employee" <?php if (isset($userDataArray['userLevel']) && $userDataArray['userLevel'] == "employee") echo "checked";?>><br>
		<input type="hidden" name="userID" value="<?php echo (isset($userDataArray['userID']) ? $userDataArray['userID'] : ''); ?>"/>

		<input name="Save" type="submit" value="Save" />
    <input name="Cancel" type="button" value="Cancel" onclick = "window.history.back()" />
	</form>
</body>
</html>
