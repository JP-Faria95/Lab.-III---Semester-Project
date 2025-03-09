<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab III - Projeto Semestral</title>
    <style>
        body{
            font-family: 'Consolas';
        }
        .radio-group span{
            display: inline-block;
            width: 150px;
        }
        .message{
            color:red;
        }
    </style>
</head>
<body>
    <h1>
        CRUD Function into MySQL with PHP and HTML<br>
        ==================<br>Table: DICTIONARY<br>==================<br><br>
        <hr style="border:1px solid black;margin-right:935px;">CHOOSE A CRUD FUNCTION
    </h1>
    <form method="POST" action="index.php">
        <h3>
            <div class="radio-group">
                <span>CREATE TERM</span><input name="opc" type="radio" value="1"><br>
                <span>READ TERM</span><input name="opc" type="radio" value="2"><br>
                <span>UPDATE TERM</span><input name="opc" type="radio" value="3"><br>
                <span>DELETE TERM</span><input name="opc" type="radio" value="4"><br>
                <hr style="border:1px solid black;margin-right:935px;">
            </div>
        </h3>
        <h2 style="margin-left:180px;">
            OR<br><br>
        </h2>
        <h2>
            RESET IDs<input name="opc" type="radio" value="5" style="margin-left:35px;">
            <hr style="border:1px solid black;margin-right:925px;">
            <button type="submit">OK</button>
        </h2>   
    </form>
</body>
</html>
<?php
if($_SERVER['REQUEST_METHOD']=='POST' and isset($_POST['opc'])){
    $choose = $_POST['opc'];
    switch($choose){
        case '1':
            header("Location:create.php");break;
        case '2':
            header("Location:read.php");break;
        case '3':
            header("Location:update.php");break;
        case '4':
            header("Location:delete.php");break;
        case 5:
            header("Location:reset_ids.php");break;
    }
}
else if($_SERVER['REQUEST_METHOD']=="POST"){
    echo '<div class="message">
            <h1>YOU MUST SELECT ONE OPTION.
          </div>';
}
?>