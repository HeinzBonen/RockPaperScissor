<?php
session_start();
if (!isset($_SESSION["user_id"]) || !isset($_SESSION["username"])) {
    header("Location: login.html");
    exit;
}

include("../db/db.php");
include("../functions/accountClass.php");
include("../functions/resultClass.php");
include("../functions/matchClass.php");

$accFun = new AccountFunctions($con);
$resFun = new ResultFunctions($con);
$matFun = new MatchFunctions($con);

$account = $accFun->GetAccountFromUsername($_SESSION["username"]);
$history = $resFun->GetHistoryFromId($_SESSION["user_id"]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geschiedenis</title>
</head>
<body>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
  margin-left: 20px;
  margin-right: 20px;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

<?php include("header.php"); ?>

<table>
<tr>
    <th>Spel datum</th>
    <th>Resultaat</th>
    <th>Tegen</th>
</tr>

<?php
    echo "<p>
        <strong>{$account['username']}</strong>: 
            gewonnen:{$account['total_wins']}, 
            verloren:{$account['total_losses']}, 
            gelijkspel:{$account['total_ties']}
        </p><br />";
$history = array_reverse($history);
        foreach ($history as $log) {
            switch($log['end_state']) {
                case "won":
                    $result = "gewonnen";
                    break;
                case "lost":
                    $result = "verloren";
                    break;
                default:
                    $result = "gelijkspel";
                    break;
            }

            echo "<tr>
                <th>
                    {$log['play_date']}
                </th>
                <th>
                    {$result}
                </th>
                <th>
                    {$log['opponent']}
                </th>
            </tr>";
        }
?>
<table>
    
</body>
</html>