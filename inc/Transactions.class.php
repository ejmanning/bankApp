<?php
class Transactions
{
    var $transactionData = array();
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
        $this->transactionData = $dataArray;
        //var_dump($dataArray);
    }

    function sanitize($dataArray)
    {
        // sanitize data based on rules
          $dataArray['amount'] = filter_var($dataArray['amount'], FILTER_SANITIZE_STRING);
          $dataArray['type'] = filter_var($dataArray['type'], FILTER_SANITIZE_STRING);
          $dataArray['dateOfTransaction'] = filter_var($dataArray['dateOfTransaction'], FILTER_SANITIZE_STRING);
          $dataArray['accountID'] = filter_var($dataArray['accountID'], FILTER_SANITIZE_NUMBER_INT);


        return $dataArray;
    }
    function load($transactionID)
    {
        $isLoaded = false;

        // load from database
        $stmt = $this->db->prepare("SELECT * FROM transactions WHERE transactionID=?");
        $stmt->execute(array($transactionID));

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

    function loadByAccount($accountID)
    {
        $isLoaded = false;

        // load from database
        $stmt = $this->db->prepare("SELECT * FROM transactions WHERE accountID=?");
        $stmt->execute(array($transactionID));

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

        if (empty($this->transactionData['transactionID']))
        {

            $stmt = $this->db->prepare(
                "INSERT INTO transactions
                    (amount, type, dateOfTransaction, accountID)
                 VALUES (?, ?, ?, ?)");

            $isSaved = $stmt->execute(array(
                    $this->transactionData['amount'],
                    $this->transactionData['type'],
                    $this->transactionData['dateOfTransaction'],
                    $this->transactionData['accountID']

                )
            );

            if ($isSaved)
            {
                $this->transactionData['transactionID'] = $this->db->lastInsertId();
            }
        }
        else
        {
            $stmt = $this->db->prepare(
                "UPDATE transactions SET
                    amount = ?,
                    type = ?,
                    dateOfTransaction = ?,
                    accountID = ?
                WHERE transactionID = ?"
            );

            $isSaved = $stmt->execute(array(
                    $this->transactionData['amount'],
                    $this->transactionData['type'],
                    $this->transactionData['dateOfTransaction'],
                    $this->transactionData['accountID'],
                    $this->transactionData['transactionID']

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
        if (empty($this->transactionData['type']))
        {
            $this->errors['type'] = "Please enter a transaction type (withdraw or deposit)";
            $isValid = false;
        }

        if (empty($this->transactionData['amount']))
        {
            $this->errors['amount'] = "Please enter a transaction amount";
            $isValid = false;
        } else {
            floatval($this->transactionData['amount']);
        }

        if (empty($this->transactionData['dateOfTransaction']))
        {
            $this->errors['dateOfTransaction'] = "Please enter the date of the transaction";
            $isValid = false;
        }

        return $isValid;
    }

    function getList($sortColumn = null, $sortDirection = null, $filterColumn = null, $filterText = null, $page = null)
    {
        $transactionList = array();

        $sql = "SELECT * FROM transactions ";

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
          $total_pages_sql = "SELECT COUNT(*) FROM transactions";
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

    function getListByAccount($accountID, $sortColumn = null, $sortDirection = null, $filterColumn = null, $filterText = null, $page = null)
    {
        $transactionList = array();

        $sql = "SELECT * FROM transactions WHERE accountID = $accountID";

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
          $total_pages_sql = "SELECT COUNT(*) FROM transactions";
          $stmtPages = $this->db->prepare($total_pages_sql);
          $numberOfRows = $this->db->query($total_pages_sql)->fetchColumn();
          $numberOfRows = (int)$numberOfRows;
          $numberOfPages = $numberOfRows/2;
    		}

        $stmt = $this->db->prepare($sql);

        if ($stmt)
        {
            $stmt->execute(array('%' . $filterText . '%'));

            $transactionList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        return $transactionList;
    }


function getPages($sortColumn = null, $sortDirection = null, $filterColumn = null, $filterText = null, $page = null)
{
    $transactionList = array();

    $sql = "SELECT * FROM transactions ";

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

        $transactionList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    return $numberOfPages;
}


  }
?>
