<?php

$difficulty = "easy";

if (isset($_POST["normal"])) {
    $difficulty = "normal";
} else if (isset($_POST["hard"])) {
    $difficulty = "hard";
}

// create match data
include("../db/db.php");
include("../functions/matchClass.php");
$matchFun = new MatchFunctions($con);
session_start();
if (!isset($_SESSION["match_key"])) {
    $_SESSION["match_key"] = $matchFun->CreateGuid();
    $matchFun->CreateMatch($_SESSION["user_id"], null, $difficulty, $_SESSION["match_key"]);
}
$matchData = $matchFun->GetMatchInfoFromKey($_SESSION["match_key"]);
$difficulty = $matchData["cpu_level"];

if (isset($_GET["result"])) {
    if ($_GET["result"] == 0) {
        // user and cpu have tied
        $bodyClass = 'body-tie';
        echo "<strong>gelijkspel</strong>";
    } else if ($_GET["result"] == 1) {
        // user has won
        $bodyClass = 'body-win';
        echo "<strong>je hebt gewonnen</strong>";
    } else {
        // user has lost
        $bodyClass = 'body-loss';
        echo "<strong>je hebt verloren</strong>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🪨📃✂️</title>
    <link rel="stylesheet" href="../css/ingamestyle.css">
</head>
<body class="<?php echo $bodyClass; ?>">

    <?php
        // scoreboard
        echo "<div class='score-board'>
            <p>ronde: <span id='user-score'>{$matchData['rounds']}</span></p>
            <p>{$_SESSION['username']}: <span id='user-score'>{$matchData['user_score']}</span></p>
            <p>CPU: <span id='cpu-score'>{$matchData['opponent_score']}</span></p>
        </div>";

        echo "<p class='difficulty-message'>Huidige moeilijkheid: <strong>";

        switch ($difficulty) {
            case "normal":
                echo "normaal";
                break;
            case "hard":
                echo "moeilijk";
                break;
            default:
                echo "makkelijk";
                break;
        }

        echo "</strong></p>";

    ?>

    <form action="controllers/cpuResultAction.php" method="POST" class="game-form">
        <button type="submit" name="rock" value="rock" class="btn">Steen🪨</button>
        <button type="submit" name="paper" value="paper" class="btn">Papier📃</button>
        <button type="submit" name="scissor" value="scissor" class="btn">Schaar✂️</button>
    </form>

    <a href="controllers/stopGame.php" class="btn stop">Stop spel</a>
</body>
</html>