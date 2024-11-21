<?php
    try{
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!preg_match("/^(?=.*[A-Z])(?=.*[\W]).{8,}$/", $_POST["pass"])){
                throw new Exception("Uw wachtwoord voldoet niet aan de eisen.");
            } else if ($_POST["pass"] != $_POST["repass"]){
                throw new Exception("De wachtwoorden komen niet overeen.");
            }
            if (!preg_match("/^(?=.{1,10}$)(?!.*[^a-zA-Z0-9].*[^a-zA-Z0-9].*)[a-zA-Z0-9]*[^a-zA-Z0-9]?[a-zA-Z0-9]*$/", $_POST["name"])) {
                throw new Exception("Uw gebruikersnaam voldoet niet aan de eisen.");
            }
            
            include("../../db/db.php");
            include("../../functions/accountClass.php");

            $accFun = new AccountFunctions($con);

            $existingUser = $accFun->GetAccountFromUsername($_POST["name"]);
            var_dump($existingUser);
            if (isset($existingUser) && isset($existingUser["username"])) {
                throw new Exception("Deze gebruiker bestaat al.");
            }

            $password = password_hash($_POST["pass"], PASSWORD_DEFAULT);

            $accFun->AddAccount($_POST["name"], $password);
            $user = $accFun->GetAccountFromUsername($_POST["name"]);
            
            session_start();
            $_SESSION["username"] = $user["username"];
            $_SESSION["user_id"] = $user["ID"];

            header("Location: ../index.php");
            exit;
        }
    } catch (Exception $ex){
        header("Location: ../makeAccount.php?errMsg=".$ex->getMessage());
        exit;
    }
?>