<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MESSAGES</title>
    <style>
        .message1{
            color:green;
            font-family:'Consolas';
        }
    </style>
</head>
<body>
</body>
</html>
<?php
if(isset($_GET['message'])){
    $message = $_GET['message'];
    switch($message){
        case 1:
            echo '<br><div class="message1">
                    <h1>
                        ==========================<br>
                        DATA SUCESSFULLY INSERTED<br>
                        ==========================<br>
                    </h1>
                 </div>';
            break;
        case 2:
            echo '<div class="message1">
                    <h1>
                        <br>=========================<br>
                        DATA SUCESSFULLY UPDATED<br>
                        =========================
                    </h1>
                  </div>';  
            break;
        case 3:
            $id = $_GET['id'];
            echo '<div class="message1">
                    <h1>
                        <br>====================================<br>
                        DATA FROM ID '.$id.' SUCCESSFULLY DELETED
                        <br>====================================
                    </h1>
                  </div>';
            break;
        case 4:
            echo '<div class="message1">
                    <h1>
                        <br>========================================<br>
                        TABLE DICTIONARY SUCCESSFULLY TRUNCATED
                        <br>========================================<br>
                    </h1>
                  </div>';
            break;
    }
}
include('return_to_index.php');
?>