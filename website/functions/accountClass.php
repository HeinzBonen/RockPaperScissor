<?php
Class AccountFunctions{
    public $con;
    function __construct($con) {
        $this->con = $con;
    }

    public function AddAccount($username, $password) {
        try {
            $stmt = $this->con->prepare("INSERT INTO users (username, `password`) VALUES (?, ?);");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
        } catch(Exception $ex) {
            throw $ex;
        }
    }

    public function GetAccountFromUsername($username) {
        try {
            $stmt = $this->con->prepare("SELECT 
                ID, username, `password`, total_wins, total_losses, total_ties
                FROM users WHERE username = ?;");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmtResult = $stmt->get_result();

            $result;
            if($row = $stmtResult->fetch_assoc()) {
                $result = array(
                    "ID" => $row["ID"],
                    "username" => $row["username"],
                    "password" => $row["password"],
                    "total_wins" => $row["total_wins"],
                    "total_losses" => $row["total_losses"],
                    "total_ties" => $row["total_ties"]
                );
            };

            return $result;
        } catch(Exception $ex) {
            return null;
        }
    }
}
?>