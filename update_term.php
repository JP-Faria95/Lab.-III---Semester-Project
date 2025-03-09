<?php

// This code run an UPDATE query into the Dictionary table from the Lab3_Projeto database.

include('connection_mysql.php');

/* The User may choose between updating a whole line or only one field from the line. In both option, it'll be necessary to
enter the reference ID for the query. If mysqli_num_rows() return zero lines, them a message of "no data" is shown.  */ 

echo "Choose to Update:\n";
do{
    echo "1 - Row.\n";
    echo "2 - Field.\n";
    $opc = trim(fgets(STDIN));
    if($opc!=1 and $opc!=2){
        echo "INVALID OPTION.\n";
    }
}while($opc!=1 and $opc!=2);
echo "ID: "; $id = trim(fgets(STDIN));
$check_id = mysqli_query($connection,"SELECT * FROM DICTIONARY WHERE ID = $id");
if(mysqli_num_rows($check_id)==0)
    exit("NO DATA IN DICTIONARY FOR ID ".$id.".\n");

/* If ID is valid and the user chooses to update the whole line, the program asks for the new values for the columns. */ 
else if($opc == 1){
    echo "---------------------------\n";
    echo "Insert new values for ID ".$id."\n";
    echo "---------------------------\n";
    echo "Term: "; $term = trim(fgets(STDIN));
    echo "Term, translated: "; $term_pt = trim(fgets(STDIN));
    echo "Subject: "; $subject = trim(fgets(STDIN));
    echo "Application: "; $applic = trim(fgets(STDIN));
    $update_query = "UPDATE DICTIONARY SET Term = '$term', Term_PT = '$term_pt', Subject = '$subject', Application = '$applic' WHERE ID = $id";
}

/* If ID is valid but the user chooses to update only one field, the program asks which field will be update. After the choise,
is required from the user to provide the new value of the chosen field. The variable $update_query holds the new value. */

else{
    do{
        echo "-------------------\n";
        echo "Field to update:\n";
        echo "1 - Term.\n";
        echo "2 - Tranlated Term.\n";
        echo "3 - Subject.\n";
        echo "4 - Application.\n";
        echo "-------------------\n";
        $opc = trim(fgets(STDIN));
        if($opc<1 or $opc>4)
            echo "INVALID OPTION.\n";
    }while($opc<1 or $opc>4);
    switch($opc){
        case 1: 
            echo "New Term: "; $term = trim(fgets(STDIN));
            $update_query = "UPDATE DICTIONARY SET Term = '$term' WHERE ID = $id";break;
        case 2:
            echo "New translated Term: "; $term_pt = trim(fgets(STDIN));
            $update_query = "UPDATE DICTIONARY SET Term_pt = '$term_pt' WHERE ID = $id";break;
        case 3: 
            echo "New Subject: "; $subject = trim(fgets(STDIN));
            $update_query = "UPDATE DICTIONARY SET Subject = '$subject' WHERE ID = $id";break;
        case 4: 
            echo "New Application: "; $applic = trim(fgets(STDIN));
            $update_query = "UPDATE DICTIONARY SET Application = '$applic' WHERE ID = $id";break;
    }
}

/* After a successful operation, a message is shown. */ 

$mysql_access = mysqli_query($connection,$update_query);
if($mysql_access){
    echo "---------------------\n";
    echo "UPDATE SUCCESSFUL.\n";
    echo "---------------------\n";
}
?>