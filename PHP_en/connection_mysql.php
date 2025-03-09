<?php

/* This doc contain the program to connect the PHP application with our MySQL database.
Our main goal is to perform a simple CRUD into the MySQL DB, directly from the VSCODE terminal.
We used the native function "mysqli_connect()" that requires four parameters: Host name, User name, the password
and the database name. */

$hostname = 'localhost';
$username = 'root';
$password = '1234';
$database = 'lab3_projeto';
$connection = mysqli_connect($hostname,$username,$password,$database);

/* The variable $connection holds the boolean result from mysqli_connect(). If true, a success message is shown and if false
a fail message is shown. */

if($connection){
    echo "---------------------\n";
    echo "CONNECTION SUCCESSFUL\n";
    echo "---------------------\n";
}
else {
    exit("FAILED TO CONNECT.\n");
}
?>