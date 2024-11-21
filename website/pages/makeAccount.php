<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account aanmaken</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="container">
        <form action="controllers/signupAction.php" method="POST">
            <input type="text" placeholder="gebruikers naam..." name="name" /><br />
            <input type="password" placeholder="wachtwoord..." name="pass" /><br />
            <input type="password" placeholder="wachtwoord herhalen..." name="repass" /><br />
            <input type="submit" />
        </form>
        <p>Uw wachtwoord moet minstens:</p>
        <ul>
            <li>1 speciaal teken,</li>
            <li>1 hoofdletter,</li>
            <li>8 karakters</li>
        </ul>
        <p>bevatten.</p><br />
        <p>Uw gebruikersnaam mag:</p>
        <ul>
            <li>max 10 letters,</li>
            <li>max 1 speciaal teken</li>
        </ul>
        <p>bevatten.</p>
        <a href="login.html">Log in</a>
    </div>   
</body>
</html>