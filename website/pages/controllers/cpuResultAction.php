<?php

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        include("../../db/db.php");
        include("../../functions/cpuClass.php");
        include("../../functions/resultClass.php");
        include("../../functions/matchClass.php");
    
        $cpuFun = new CpuFunctions();
        $resFun = new ResultFunctions($con);
        $matchFun = new MatchFunctions($con);
    
        $currentMatch = null;
        session_start();
        if (isset($_SESSION["match_key"])) 
            $currentMatch = $matchFun->GetMatchInfoFromKey($_SESSION["match_key"]);
        
        // get difficulty
        $difficulty = $currentMatch["cpu_level"] ?? "easy";
    
        // get players current choice
        $playerChoice = "scissor";
        if (isset($_POST["rock"])) {
            $playerChoice = "rock";
        } else if (isset($_POST["paper"])) {
            $playerChoice = "paper";
        }
    
        // check who wins
        $cpuChoice = null;
        switch ($difficulty) {
            case "normal":
                $cpuChoice = $cpuFun->MakeChoiceNormal();
                break;
            case "hard":
                $cpuChoice = $cpuFun->MakeChoiceHard($currentMatch["user_moves"]);
                break;
            default:
                $x = isset($currentMatch["opponent_moves"]) ? $currentMatch["opponent_moves"][count($currentMatch["opponent_moves"]) - 1] : null;
                $cpuChoice = $cpuFun->MakeChoiceEasy($x);
                break;
        }
    
        $result = $resFun->DeclareWinnerFromAnswers($playerChoice, $cpuChoice);

        if (is_array($currentMatch["user_moves"]))
            array_push($currentMatch["user_moves"], $playerChoice);
        else
            $currentMatch["user_moves"] = [$playerChoice];
        if (is_array($currentMatch["opponent_moves"]))
            array_push($currentMatch["opponent_moves"], $cpuChoice);
        else
            $currentMatch["opponent_moves"] = [$playerChoice];

        $playerScore = $result == 1 ? $currentMatch["user_score"] + 1 : $currentMatch["user_score"];
        $opponentScore = $result == 2 ? $currentMatch["opponent_score"] + 1 : $currentMatch["opponent_score"];
    
        $matchFun->UpdateMatch($_SESSION["match_key"], $currentMatch["user_moves"], $currentMatch["opponent_moves"], $playerScore, $opponentScore);
    
        header("Location: ../vscpu.php?result=".$result);
        exit;
    }
} catch (Exception $ex) {
    header("Location: ../index.php?errMsg=".$ex->getMessage());
    echo $ex;
    exit;
}

?>