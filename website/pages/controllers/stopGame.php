<?php
session_start();

if (isset($_SESSION["match_key"])) {
    // save game
    include("../../db/db.php");
    include("../../functions/resultClass.php");
    include("../../functions/matchClass.php");

    $resFun = new ResultFunctions($con);
    $matFun = new MatchFunctions($con);

    // check winner
    $match = $matFun->GetMatchInfoFromKey($_SESSION["match_key"]);
    $result = "lost";
    if ($match["user_score"] > $match["opponent_score"]) {
        $result = "won";
    }else if ($match["user_score"] == ($match["opponent_score"])) {
        $result = "tied";
    }
    
    $resFun->LogResults($_SESSION["user_id"], "CPU - ".$match["cpu_level"], $result, $_SESSION["match_key"]);
}

$_SESSION["match_key"] = null;
unset($_SESSION["match_key"]);
header("Location: ../index.php");
exit;
?>