<?php

// This doc contain the code to run a SELECT query into the Dictionary table in our database.

include('connection_mysql.php');

/* The user may choose from the three options: Select all data from Dictionary, Select the data for a specific ID or for a
specific Subject. The DO/WHILE loop is used to validate the $opc variable inserted by the user. */

echo "Select from table:\n\n";
do{
    echo "1 - All data.\n";
    echo "2 - Specific ID.\n";
    echo "3 - Specific Subject.\n";
    echo "---------------------\n";
    $opc = trim(fgets(STDIN));
    if($opc<1 or $opc>3){
        echo "INVALID OPTION.\n\n";
    }
}while($opc<1 or $opc>3);

/* The SWITCH statement can perform in three ways: Case 1, the $select_query simply receives the common query. The $check_data
variable and the mysqli_num_rows() functions are used to check if there is any data. Case 2, the program asks for the reference
ID to use in the select query. The $check_id variable holds the result from a mysqli_query() and is used in the mysqli_num_rows()
function to validate the entered ID. Case 3, the user chooses to filter the select query with a specific subject from the collum
Subject. Again, a $check_subject variable and a mysqli_num_rows() function are used to validate the $subject informed by the user. */

switch($opc){
    case 1:
        $select_query = "SELECT * FROM DICTIONARY";
        $check_data = mysqli_query($connection,$select_query);
        if(mysqli_num_rows($check_data) == 0)
            exit("There is no data in the table Dictionary.\n");break;
    case 2:
        echo "ID: "; $id = trim(fgets(STDIN));
        $select_query = "SELECT * FROM DICTIONARY WHERE ID = $id";
        $check_id = mysqli_query($connection,$select_query);
        if(mysqli_num_rows($check_id)==0)
            exit("There is no data in Dictionary for ID ".$id.".\n");break;
    case 3:
        echo "Subject: "; $subject = trim(fgets(STDIN));
        $select_query = "SELECT * FROM DICTIONARY WHERE SUBJECT = '$subject'";
        $check_subject = mysqli_query($connection,$select_query);
        if(mysqli_num_rows($check_subject)==0)
            exit("There is no data in Dictionary for subject ".$subject.".\n");break;
}

/* Finally the $mysqli_access holds the result from mysqli_query() function, and being true, the table Dictionary is
shown according to the option chosen by the user. */

$mysql_access = mysqli_query($connection,$select_query);
if($mysql_access){
    echo "===============\n";
    echo "DICTIONARY\n";
    echo "===============\n";
    while($data = mysqli_fetch_array($mysql_access)){
        echo "ID: ".$data['ID']."\n";
        echo "Term: ".$data['Term'].".\n";
        echo "Translated: ".$data['Term_PT'].".\n";
        echo "Subject: ".$data['Subject'].".\n";
        echo "Application: ".$data['Application']."\n";
        echo "------------------------\n";
    }
}
?>