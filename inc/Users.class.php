<?php
class Users
{
    var $userData = array();
    var $errors = array();

    var $db = null;

    function __construct()
    {
      //local
      /*$this->db = new PDO('mysql:host=localhost;dbname=bank;charset=utf8',
          'erica', 'Frozen21!');*/
      //host
      $this->db = new PDO('mysql:host=localhost;dbname=emanning11_bank;charset=utf8',
          'emanning11_bank', 'Frozen21!');
    }

    function set($dataArray)
    {
        $this->userData = $dataArray;
        //var_dump($dataArray);
    }

    function sanitize($dataArray)
    {
        // sanitize data based on rules
          $dataArray['username'] = filter_var($dataArray['username'], FILTER_SANITIZE_STRING);
          $dataArray['password'] = filter_var($dataArray['password'], FILTER_SANITIZE_STRING);
          $dataArray['firstName'] = filter_var($dataArray['firstName'], FILTER_SANITIZE_STRING);
          $dataArray['lastName'] = filter_var($dataArray['lastName'], FILTER_SANITIZE_STRING);
          $dataArray['email'] = filter_var($dataArray['email'], FILTER_SANITIZE_STRING);
          $dataArray['address'] = filter_var($dataArray['address'], FILTER_SANITIZE_STRING);

        return $dataArray;
    }
    function load($userID)
    {
        $isLoaded = false;

        // load from database
        $stmt = $this->db->prepare("SELECT * FROM users WHERE userID=?");
        $stmt->execute(array($userID));

        if ($stmt->rowCount() == 1)
        {
            $dataArray = $stmt->fetch(PDO::FETCH_ASSOC);
            //var_dump($dataArray);
            $this->set($dataArray);

            $isLoaded = true;
        }

        //var_dump($stmt->rowCount());

        return $isLoaded;
    }

    function save()
    {
        $isSaved = false;

        if (empty($this->userData['userID']))
        {

            $stmt = $this->db->prepare(
                "INSERT INTO users
                    (username, password, firstName, lastName, email, address, userLevel)
                 VALUES (?, ?, ?, ?, ?, ?, ?)");

            $isSaved = $stmt->execute(array(
                    $this->userData['username'],
                    $this->userData['password'],
                    $this->userData['firstName'],
                    $this->userData['lastName'],
                    $this->userData['email'],
                    $this->userData['address'],
                    $this->userData['userLevel']
                )
            );

            if ($isSaved)
            {
                $this->userData['userID'] = $this->db->lastInsertId();
            }
        }
        else
        {
            $stmt = $this->db->prepare(
                "UPDATE users SET
                    username = ?,
                    password = ?,
                    firstName = ?,
                    lastName = ?,
                    email = ?,
                    address = ?,
                    userLevel = ?
                WHERE userID = ?"
            );

            $isSaved = $stmt->execute(array(
                    $this->userData['username'],
                    $this->userData['password'],
                    $this->userData['firstName'],
                    $this->userData['lastName'],
                    $this->userData['email'],
                    $this->userData['address'],
                    $this->userData['userLevel'],
                    $this->userData['userID']
                )
            );
        }

        return $isSaved;
    }

    function validate()
    {
        $isValid = true;

        // if an error, store to errors using column name as key

        // validate the data elements in articleData property
        if (empty($this->userData['username']))
        {
            $this->errors['username'] = "Please enter a username";
            $isValid = false;
        }

        if (empty($this->userData['password']))
        {
            $this->errors['password'] = "Please enter a password";
            $isValid = false;
        }

        if (empty($this->userData['firstName']))
        {
            $this->errors['firstName'] = "Please enter your first name";
            $isValid = false;
        }

        if (empty($this->userData['lastName']))
        {
            $this->errors['lastName'] = "Please enter your last name";
            $isValid = false;
        }

        if (empty($this->userData['email']))
        {
            $this->errors['email'] = "Please enter your email";
            $isValid = false;
        }

        if (empty($this->userData['address']))
        {
            $this->errors['address'] = "Please enter your address";
            $isValid = false;
        }

        if (empty($this->userData['userLevel']))
        {
            $this->errors['userLevel'] = "Please enter the user level";
            $isValid = false;
        }

        return $isValid;
    }

    function getList($sortColumn = null, $sortDirection = null, $filterColumn = null, $filterText = null, $page = null)
    {
        $userList = array();

        $sql = "SELECT * FROM users ";

        if (!is_null($filterColumn) && !is_null($filterText))
        {
            $sql .= " WHERE " . $filterColumn . " LIKE ?";
        }

        if (!is_null($sortColumn))
        {
            $sql .= " ORDER BY " . $sortColumn;

            if (!is_null($sortDirection))
            {
                $sql .= " " . $sortDirection;
            }
        }

        // setup paging if passed
    		if (!is_null($page)) {
          //var_dump($page);
    			$sql .= " LIMIT " . ((2 * $page) - 2) . ",2";
          //var_dump($sql);
          $total_pages_sql = "SELECT COUNT(*) FROM users";
          $stmtPages = $this->db->prepare($total_pages_sql);
          $numberOfRows = $this->db->query($total_pages_sql)->fetchColumn();
          $numberOfRows = (int)$numberOfRows;
          $numberOfPages = $numberOfRows/2;
    		}

        $stmt = $this->db->prepare($sql);

        if ($stmt)
        {
            $stmt->execute(array('%' . $filterText . '%'));

            $userList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        return $userList;
    }

function hashPassword($passwordToHash) {
  $passwordHash = password_hash($passwordToHash, PASSWORD_BYCRYPT);
}


function getPages($sortColumn = null, $sortDirection = null, $filterColumn = null, $filterText = null, $page = null)
{
    $userList = array();

    $sql = "SELECT * FROM users ";

    if (!is_null($filterColumn) && !is_null($filterText))
    {
        $sql .= " WHERE " . $filterColumn . " LIKE ?";
    }

    if (!is_null($sortColumn))
    {
        $sql .= " ORDER BY " . $sortColumn;

        if (!is_null($sortDirection))
        {
            $sql .= " " . $sortDirection;
        }
    }

    // setup paging if passed
		if (!is_null($page)) {
      //var_dump($page);
			//$sql .= " LIMIT " . ((2 * $page) - 2) . ",2";


		}

    $stmt = $this->db->prepare($sql);

    if ($stmt)
    {
        $stmt->execute(array('%' . $filterText . '%'));
        $numberOfRows = $stmt->rowCount();
        //var_dump($numberOfRows);
        $numberOfPages=$numberOfRows/2;
        //var_dump($numberOfPages);

        $userList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    return $numberOfPages;
}


function authorizeUser($inUsername, $inPassword){
  $userID=null;
  $checkUsersql="SELECT userID, username, password, userLevel
                FROM users
                WHERE username = :username
                AND password = :password";
                $query= $this->db->prepare($checkUsersql);
                                    $query->bindParam('username', $inUsername, PDO::PARAM_STR);
                                    $query->bindValue('password', $inPassword, PDO::PARAM_STR);
                                    $query->execute();

                                    $count = $query->rowCount();
                                    $row   = $query->fetch(PDO::FETCH_ASSOC);

          if ($row!=false) {
            $userID = $row["userID"];
            $username = $row['username'];
            $password = $row['password'];
            $userLevel = $row['userLevel'];

            $userInfo = array($userID, $username, $password, $userLevel);

          }
            return $userInfo;
    }

    function getUserLevel($userID) {
      $stmt = $this->db->prepare("SELECT userLevel FROM users WHERE userID='$userID'");
      $stmt->execute(array($userID));
      $userLevel = $row['userLevel'];
      return $userLevel;
}

function delete($userID) {
    $stmt = $this->db->prepare("DELETE FROM users WHERE userID = $userID");
    //run DELETE query
    //var_dump($stmt);
    //if the query runs successfully print  message telling the event was deleted
    if($stmt) {
      $stmt->execute(array('%' . $userID . '%'));
      //var_dump($stmt);
    	$deleteMsg = "The burial associated with ID #". $_GET['userID'] ." has been deleted.";
    } else {
    	$deleteMsg = "Uh-oh, we weren't able to delete the burial associated with ID #".$userID." Please try again.";
    }

    //var_dump($deleteMsg);

    return $deleteMsg;
  }


  }
?>
