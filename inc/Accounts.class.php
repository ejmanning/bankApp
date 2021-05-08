<?php
class Accounts
{
    var $accountData = array();
    var $errors = array();

    var $db = null;

    function __construct()
    {
      //local
      $this->db = new PDO('mysql:host=localhost;dbname=bank;charset=utf8',
          'erica', 'Frozen21!');
      //host
      /*$this->db = new PDO('mysql:host=localhost;dbname=emanning11_murphy-cemetery;charset=utf8',
          'emanning11_murphy-cemetery', 'MurphyCemetery_Group2');*/
    }

    function set($dataArray)
    {
        $this->accountData = $dataArray;
        //var_dump($dataArray);
    }

    function sanitize($dataArray)
    {
        // sanitize data based on rules
          $dataArray['type'] = filter_var($dataArray['type'], FILTER_SANITIZE_STRING);
          $dataArray['balance'] = filter_var($dataArray['balance'], FILTER_SANITIZE_NUMBER_INT);
          $dataArray['interestRate'] = filter_var($dataArray['interestRate'], FILTER_SANITIZE_STRING);
          $dataArray['dateCreated'] = filter_var($dataArray['dateCreated'], FILTER_SANITIZE_STRING);
          $dataArray['userID'] = filter_var($dataArray['userID'], FILTER_SANITIZE_NUMBER_INT);


        return $dataArray;
    }
    function load($accountID)
    {
        $isLoaded = false;

        // load from database
        $stmt = $this->db->prepare("SELECT * FROM accounts WHERE accountID=?");
        $stmt->execute(array($accountID));

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

    function loadByUser($userID)
    {
        $isLoaded = false;

        // load from database
        $stmt = $this->db->prepare("SELECT * FROM accounts WHERE userID=?");
        $stmt->execute(array($accountID));

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

        if (empty($this->accountData['accountID']))
        {

            $stmt = $this->db->prepare(
                "INSERT INTO accounts
                    (type, balance, interestRate, dateCreated, userID)
                 VALUES (?, ?, ?, ?, ?)");

            $isSaved = $stmt->execute(array(
                    $this->accountData['type'],
                    $this->accountData['balance'],
                    $this->accountData['interestRate'],
                    $this->accountData['dateCreated'],
                    $this->accountData['userID']
                )
            );

            if ($isSaved)
            {
                $this->accountData['accountID'] = $this->db->lastInsertId();
            }
        }
        else
        {
            $stmt = $this->db->prepare(
                "UPDATE accounts SET
                    type = ?,
                    balance = ?,
                    interestRate = ?,
                    dateCreated = ?,
                    userID = ?
                WHERE accountID = ?"
            );

            $isSaved = $stmt->execute(array(
                    $this->accountData['type'],
                    $this->accountData['balance'],
                    $this->accountData['interestRate'],
                    $this->accountData['dateCreated'],
                    $this->accountData['userID'],
                    $this->accountData['accountID']

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
        if (empty($this->accountData['type']))
        {
            $this->errors['type'] = "Please enter an account type";
            $isValid = false;
        }

        if (empty($this->accountData['balance']))
        {
            $this->errors['balance'] = "Please enter an account balance";
            $isValid = false;
        } else {
            floatval($this->accountData['balance']);
        }

        if (empty($this->accountData['dateCreated']))
        {
            $this->errors['dateCreated'] = "Please enter the date created";
            $isValid = false;
        }

        if (empty($this->accountData['interestRate']))
        {
            $this->errors['interestRate'] = "Please enter the interest rate";
            $isValid = false;
        }

        return $isValid;
    }

    function getList($sortColumn = null, $sortDirection = null, $filterColumn = null, $filterText = null, $page = null)
    {
        $accountList = array();

        $sql = "SELECT * FROM accounts ";

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
          $total_pages_sql = "SELECT COUNT(*) FROM accounts";
          $stmtPages = $this->db->prepare($total_pages_sql);
          $numberOfRows = $this->db->query($total_pages_sql)->fetchColumn();
          $numberOfRows = (int)$numberOfRows;
          $numberOfPages = $numberOfRows/2;
    		}

        $stmt = $this->db->prepare($sql);

        if ($stmt)
        {
            $stmt->execute(array('%' . $filterText . '%'));

            $accountList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        return $accountList;
    }

    function getListByUser($userID, $sortColumn = null, $sortDirection = null, $filterColumn = null, $filterText = null, $page = null)
    {
        $accountList = array();

        $sql = "SELECT * FROM accounts WHERE userID = $userID";

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
          $total_pages_sql = "SELECT COUNT(*) FROM accounts";
          $stmtPages = $this->db->prepare($total_pages_sql);
          $numberOfRows = $this->db->query($total_pages_sql)->fetchColumn();
          $numberOfRows = (int)$numberOfRows;
          $numberOfPages = $numberOfRows/2;
    		}

        $stmt = $this->db->prepare($sql);

        if ($stmt)
        {
            $stmt->execute(array('%' . $filterText . '%'));

            $accountList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        return $accountList;
    }


function getPages($sortColumn = null, $sortDirection = null, $filterColumn = null, $filterText = null, $page = null)
{
    $accountList = array();

    $sql = "SELECT * FROM accounts ";

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

        $accountList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    return $numberOfPages;
}

  function depositMoney($amount, $balance) {
    floatval($amount);
    floatval($balance);

    $newBalance = $balance + $amount;

    return $newBalance;
  }

  function withdrawMoney($amount, $balance) {
    floatval($amount);
    floatval($balance);

    $newBalance = $balance - $amount;

    return $newBalance;
  }

  function delete($accountID) {
      $stmt = $this->db->prepare("DELETE FROM accounts WHERE accountID = $accountID");
      //run DELETE query
      //var_dump($stmt);
      //if the query runs successfully print  message telling the event was deleted
      if($stmt) {
        $stmt->execute(array('%' . $accountID . '%'));
        //var_dump($stmt);
      	$deleteMsg = "The burial associated with ID #". $_GET['accountID'] ." has been deleted.";
      } else {
      	$deleteMsg = "Uh-oh, we weren't able to delete the burial associated with ID #".$accountID." Please try again.";
      }

      //var_dump($deleteMsg);

      return $deleteMsg;
    }


  }
?>
