<?php
session_start();
$_SESSION["match_key"] = null;
unset($_SESSION["match_key"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>start</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="welcome-message-div">
    <p>Steen🪨 Papier📃 Schaar✂️</p>
    <?php
        if (isset($_SESSION["username"])) {
            echo "<p>Welkom terug <strong>{$_SESSION['username']}</strong>!</p>";
        } else {
            header("Location: login.html");
            exit;
        }
    ?>
    </div>

    <a href="cpuLvlSelect.php" class="choice-button">tegen cpu</a><br />
    <a href="playerHistory.php" class="choice-button">geschiedenis</a><br />
    <a href="login.html" class="logout-button">log uit</a>

</body>
</html>