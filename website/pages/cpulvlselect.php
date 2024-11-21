<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VS CPU</title>
    <link rel="stylesheet" href="../css/cpustyle.css">
</head>
<body>
    <div class="container">
        <h1>Speel tegen de CPU</h1>
        <p>Kies een moeilijkheidsgraad:</p>
        <form action="vscpu.php" method="POST">
            <button type="submit" name="easy" value="easy" class="btn easy">Makkelijk</button>
            <button type="submit" name="normal" value="normal" class="btn normal">Normaal</button>
            <button type="submit" name="hard" value="hard" class="btn hard">Moeilijk</button>
        </form>
        <a href="index.php" class="btn back">Terug</a>
    </div>
</body>
</html>
