<?php
try {
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["name"]) && isset($_POST["pass"])) {
        if (!preg_match("/^(?=.*[A-Z])(?=.*[\W]).{8,}$/", $_POST["pass"])){
            throw new Exception("Uw wachtwoord voldoet niet aan de eisen.");
        }
        if (!preg_match("/^(?=.{1,10}$)(?!.*[^a-zA-Z0-9].*[^a-zA-Z0-9].*)[a-zA-Z0-9]*[^a-zA-Z0-9]?[a-zA-Z0-9]*$/", $_POST["name"])) {
            throw new Exception("Uw gebruikersnaam voldoet niet aan de eisen.");
        }

        include("../../db/db.php");
        include("../../functions/accountClass.php");

        $accFun = new AccountFunctions($con);

        $user = $accFun->GetAccountFromUsername($_POST["name"]);
        if (!password_verify($_POST["pass"], $user["password"])) {
            throw new Exception("U heeft de verkeerde gegevens ingevuld.");
        }

        session_start();
        $_SESSION["username"] = $user["username"];
        $_SESSION["user_id"] = $user["ID"];

        header("Location: ../index.php");
        exit;

    } else {
        throw new Exception();
    }
} catch(Exception $ex) {
    header("Location: ../login.php?errMsg=".$ex->getMessage());
    exit;
}


?>