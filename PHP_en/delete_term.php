<?php

/* This code will run a DELETE query into the Dictionary table in the Lab3_Projeto database. The DELETE function must be
used wisely because once confirmed, all data will be deleted from the table. 
In this code, the user may choose between deleting a specific row or deleting all data from the table. */

include('connection_mysql.php');
do{
    echo "Choose to Delete:\n";
    echo "1 - Row.\n";
    echo "2 - All Data.\n";
    echo "---------------------\n";
    $opc = fgets(STDIN);
    if($opc!=1 and $opc!=2){
        echo "INVALID OPTION.\n";
        echo "---------------------\n";
    }
}while($opc!=1 and $opc!=2);

/* If user chooses to delete one specific row, the program requests the ID and uses a mysqli_num_rows() to check if there is
any data associated. Being valid, the user again confirm the DELETE or may choose to cancel the operation. */

if($opc == 1){
    echo "ID to Delete: "; $id = trim(fgets(STDIN));
    $check_id = mysqli_query($connection,"SELECT * FROM DICTIONARY WHERE ID = $id");
    if(mysqli_num_rows($check_id)==0)
        exit("THERE IS NO DATA IN DICTIONARY FOR ID ".$id.".");
    else{
        echo "--------------------------------------------------\n";
        echo "ID ".$id." is valid. Plase confirm the Delete Operation.\n";
        echo "1 - Yes\n";
        echo "2 - No\n";
        echo "--------------------------------------------------\n";
        $opc = fgets(STDIN);
        switch($opc){
            case 1:
                $delete_query = "DELETE FROM DICTIONARY WHERE ID = $id";break;
            case 2:
                exit("DELETE Canceled by the User.");
        }
    }
}

/* If choose to delete all data from the table, the user has to confirm again the operation. If Yes, them a TRUNCATE query is
executed in the table Dictionary. If No, the operation is canceled. */

else{
    echo "User chooses to Delete all Data from Dictionary.\n";
    echo "Warning: This operation will Delete all Data from the Table.\n";
    do{
        echo "Please confirm again:\n";
        echo "1 - Yes\n";
        echo "2 - No\n";
        $opc = fgets(STDIN);
        if($opc!=1 and $opc!=2)
            echo "INVALID OPTION.\n";
    }while($opc!=1 and $opc!=2);
    switch($opc){
        case 1:
            $delete_query = "TRUNCATE DICTIONARY"; break;
        case 2: 
            exit("DELETE Canceled by the User.");
            
    }
}

/* When Data is successfully removed, a message is shown to the User. */ 

$mysql_access = mysqli_query($connection,$delete_query);
if($mysql_access){
    echo "DATA SUCCESSFULLY DELETED.";
}
?>