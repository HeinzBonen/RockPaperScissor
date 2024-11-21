<?php
if(session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
?>

<style>
/* Algemene opmaak voor body */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
}

/* Header styling */
.site-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #4CAF50; /* Green background */
    color: white;
    padding: 15px 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Link-groep links */
.header-left {
    display: flex;
    gap: 20px;
}

.header-link {
    text-decoration: none;
    color: white;
    font-size: 1.2rem;
    font-weight: 400;
    transition: color 0.3s ease;
}

.header-link:hover {
    color: #ffeb3b;
}

/* Log uit knop aan de rechterkant */
.logout-button {
    background-color: #ff5722; /* Orange background */
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    font-weight: 600;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.logout-button:hover {
    background-color: #e64a19; /* Darker orange on hover */
}


</style>

<header class="site-header">
    <div class="header-left">
        <a href="index.php" class="header-link">Start</a>
        <a href="playerHistory.php" class="header-link">Geschiedenis</a>
    </div>
    <a href="login.html" class="logout-button">Log uit</a>
</header>

