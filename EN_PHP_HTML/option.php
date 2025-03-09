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
    }
}
else{
    echo "NO OPTIONS CHOSEN.\n";
}
?>