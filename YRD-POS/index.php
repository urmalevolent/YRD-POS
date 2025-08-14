<?php
session_start();

if (isset($_SESSION['login'])) {
    header('location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading - YRD POS</title>
    <link rel="stylesheet" href="style.css">
    <!-- Favicon -->
    <link rel="shortcut icon" href="./assets/image/Logo-Politeknik-Negeri-Bali.png">
</head>

<body>
    <div class="lds-ring">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <!-- <div class="loading">
        <div class="title">Loading...</div>
        <div class="progress-bar">
            <div class="progress"></div>
        </div>
    </div> -->
    <script src="script.js"></script>
</body>

</html>