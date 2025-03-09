<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DELET TERM</title>
    <style>
        body{
            font-family:'Consolas';
        }
        .no_data{
            color:red;
            font-size:23px;
        }
    </style>
</head>
<?php
include("connection.php");
$check_opc = '';
if (isset($_POST['opc'])) {
    $_SESSION['check_opc'] = $_POST['opc'];
        if (isset($_SESSION['check_opc']))
            $check_opc = $_SESSION['check_opc']; // Pega o valor da sessão
        else
            $check_opc = ''; // Deixa a variável vazia caso não haja seleção ainda
}
?>
<body><br>
    <form action="delete.php" method="POST">
        <hr style="border:1px solid black;margin-right:1000px;">
        <h1 style="margin-top:5px;">
            CHOOSE TO DELETE:  
        </h1>
        <h3 style="margin-bottom:5px;">
            ONE ROW <input type="radio" name="opc" value="1" style="margin-left:40px;"
            <?php if ($check_opc == "1") echo "checked"; ?>><br>
            ALL DATA <input type="radio" name="opc" value="2" style="margin-left:29px; margin-top:10px;"  
            <?php if ($check_opc == "2") echo "checked"; ?>>
        </h3>
        <hr style="border:1px solid black;margin-right:1000px;">
        <button style="submit">OK</button>
    </form>
</body>
</html>
<?php
if($_SERVER['REQUEST_METHOD']=="POST" and isset($_POST['opc'])){  /* PRIMEIRO $_SERVER */
    $opc = $_POST['opc'];
    switch($opc){
        case 1:
            echo '<br><form action="delete.php" method="POST">
                        <h4>
                            ===================<br>FROM ID:
                            <input type="text" name="id" style="width:25px;">
                            <input type="hidden" name="opc" value="'.$opc.'">
                            <button type="submit">OK</button>
                            <br>===================
                        </h4>
                      </form>';
            /* testando $_SERVER dentro do primeiro $_SERVER. */
            if(isset($_POST['opc'],$_POST['id'])){              /* segundo $_server */
                $id = $_POST['id'];
                if($id<1 or $id>20){
                    exit("<div class='no_data'>
                            <h1>
                             WARNING: INVALID VALUE FOR ID.<br>PLEASE INSERT A VALID ID(1-20).
                            </h1>
                        </div>");
                }    
                else{
                    $check_query = "SELECT * FROM DICTIONARY WHERE ID = $id";
                    if($access_mysql = mysqli_query($connection,$check_query)){
                        if(mysqli_num_rows($access_mysql)==0){
                            exit("<div class='no_data'>
                                    <h1>
                                        WARNING: NO DATA AVAILABLE<br>IN DICTIONARY FOR ID ".$id.".
                                    </h1>
                                </div>");
                        }
                        else{
                            echo '<br><form action="delete.php" method="POST">
                                        <h3><hr style="border:1px solid black;margin-right:810px;">
                                            ID '.$id.' is valid, please confirm the DELETE Operation.<br>
                                            YES <input type="radio" name="opc2" value="1" style="margin-top:15px;"><br>
                                            NO <input type="radio" name="opc2" value="2" style="margin-top:10px;margin-left:15px;">
                                            <input type="hidden" name="id" value="'.$id.'"> 
                                            <input type="hidden" name="opc" value="'.$opc.'">
                                            <hr style="border:1px solid black;margin-right:810px;">
                                            <button type="submit">CONFIRM</button>
                                        </h3>
                                      </form>';
                            if(isset($_POST['opc2'])){   /* 3º $_server */
                                $opc2 = $_POST['opc2'];
                                switch($opc2){
                                    case 1:
                                        $delete_query = "DELETE FROM DICTIONARY WHERE ID = $id";
                                        if(mysqli_query($connection,$delete_query)){
                                            header("Location:messages.php?message=3&id=$id");
                                        } 
                                    case 2: exit("<div class='no_data'><h2>DELETE OPERATION CANCELED BY THE USER.</h2></div>");
                                }
                            }
                        }
                    }
                }
            }break;
        case 2:
            echo '<form action="delete.php" method="POST">
                    <div class="no_data">
                        <h4>
                            <br><hr style="border:1px solid black;margin-right:972px;">
                            PLEASE CONFIRM THE TRUNCATE<br>OPERATION IN TABLE DICTIONARY
                        </h4>
                    </div>
                    <h3>
                        YES <input type="radio" name="opc3" value="1" style="margin-left:14px;"><br>
                        NO <input type="radio" name="opc3" value="2" style="margin-top:12px;margin-left:23px;">
                        <input type="hidden" name="opc" value="'.$opc.'">   
                        <hr style="border:1px solid black;margin-right:972px;">
                        <button type="submit">CONFIRM</button>
                    </h3>
                 </form>';
            if(isset($_POST['opc3'])){
                $opc3 = $_POST['opc3'];
                switch($opc3){
                    case 1:
                        $delete_query = "TRUNCATE DICTIONARY";
                        if(mysqli_query($connection,$delete_query)){
                            header("Location:messages.php?message=4");
                        }
                    case 2:
                        exit('<div class="no_data">
                                <h3>
                                    TRUNCATE OPERATION CANCELED BY THE USER.
                                </h3>
                             </div>');
                }
            }

    }
}