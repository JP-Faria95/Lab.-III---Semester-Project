<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESET IDs</title>
    <style>
        .message{
            color:green;
            font-family: 'Consolas';
        }
    </style>
</head>
<body>
    
</body>
</html>
<?php
include ('connection.php');
$reset_query = "SET @COUNT = 0";
$reset2_query = "UPDATE DICTIONARY SET ID = (@COUNT := @COUNT+1)";
if(mysqli_query($connection, $reset_query) and mysqli_query($connection,$reset2_query)){
    $reset3_query = "ALTER TABLE DICTIONARY AUTO_INCREMENT = 1";
    if(mysqli_query($connection, $reset3_query))
        echo '<div class="message">
                <h2>
                    IDs ARE NOW RESETED.
                </h2>';
}