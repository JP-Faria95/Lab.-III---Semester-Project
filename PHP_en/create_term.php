<?php

// This code run an INSERT query into the table Dictionary.

include('connection_mysql.php');          // It's necessary to include the connection doc.

// Using the functions trim() and fgets() the program collects the respective variables which are used in the INSERT query.

echo "Please Insert:\n";
echo "----------------\n";
echo "Term: "; $term = trim(fgets(STDIN));
echo "Term translated: "; $term_pt = trim(fgets(STDIN));
echo "Subject: "; $subject = trim(fgets(STDIN));
echo "Application: "; $applic = trim(fgets(STDIN));
$insert_query = "INSERT INTO DICTIONARY VALUES (NULL,'$term','$term_pt','$subject','$applic')";

// The variable $mysql_access return the result from mysqli_query() and being true, the successful message is shown.

$mysql_access = mysqli_query($connection,$insert_query);
if($mysql_access){
    echo "---------------------------\n";
    echo "DATA SUCCESSFULLY INSERTED.\n";
    echo "---------------------------\n";
}
else{
    echo "FAILED TO INSERT.\n";
}
?>