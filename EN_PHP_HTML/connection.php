<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONNECTION</title>
    <style>
        .message{
            font-family:'Consolas';
            color:green;
            font-size:25px;
        }
    </style>
</head>
<body>
    
</body>
</html>
<?php

// This doc will contain the program to connect the PHP application with our mysql database.
// Our main goal is to do a simple CRUD into the MySQL DB, direct from our PHP code.
// We are using the following native functions: "mysqli_connect()"; 

$hostname = 'localhost';
$username = 'root';
$password = '1234';
$database = 'lab3_projeto';
$connection = mysqli_connect($hostname,$username,$password,$database);

if($connection){
    echo '<h1>
            <div class="message">
                =======================<br>CONNECTION ESTABLISHED<br>=======================<br></div>
         </h1>';
}
else {
    exit("FAILED TO CONNECT.\n");
}
include('return_to_index.php');
?>