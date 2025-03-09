<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>READ TERM</title>
    <style>
        body{
            font-family: 'Consolas';
        }
        .radio-group span{
            display: inline-block;
            width: 180px;
        }
        .message{
            color:green;
            font-size:18px;
        }
        .no_data{
            color:red;
            
        }
    </style>
</head>
<?php
include('connection.php');
?>
<body>
    <h1>SELECT FROM DICTIONARY:</h1>
    <form method="POST" action="read.php">
        <h3>----------------------------------<br>
            <div class="radio-group">
                <span>ALL DATA </span><input type="radio" name="opc" value="1"></input><br>
                <span>SPECIFIC ID </span><input type="radio" name="opc" value="2"><button type="submit"
                    style="margin-left:70px;">CONFIRM</button></input><br>
                <span>SPECIFIC SUBJECT </span><input type="radio" name="opc" value="3"></input><br>
            </div>
            ----------------------------------
        </h3>
    </form>
</body>
</html>
<?php
if(isset($_POST['opc']) and $_SERVER['REQUEST_METHOD']=='POST'){
    $opc = $_POST['opc'];
    switch($opc){
        case 1:
            $select_query = "SELECT * FROM DICTIONARY";
            $access_mysql = mysqli_query($connection,$select_query);
            if(mysqli_num_rows($access_mysql)==0)
                echo '<div class="no_data">
                        <h1>
                            WARNING: TABLE DICTIONARY IS EMPTY!<br>PLEASE ADD DATA USING CREATE OPTION.
                        </h1>
                      </div>';break;
        case 2:
            echo '<form method="POST" action="read.php">
                    <h4>---------------------<br>ID: 
                        <input type="text" style="width:20px;margin-top:-10px;" name="id"></input>
                        <input type="hidden" name="opc" value="2"></input>
                        <button type="submit" style="margin-left:20px;">SELECT</button>
                        <br>---------------------<br>
                    </h4>
                  </form>';
            if($_SERVER['REQUEST_METHOD']=='POST' and isset($_POST['id'])){
                $id = $_POST['id'];
                if($id<1 or $id>20)
                    echo '<div class="no_data">
                            <h1>
                                WARNING: INVALID OPTION FOR ID.<br>PLEASE INSERT IDs FROM 1 - 20.</div>
                            </h1>';
                else{
                    $select_query = "SELECT * FROM DICTIONARY WHERE ID = $id";
                    $access_mysql = mysqli_query($connection,$select_query);
                    if(mysqli_num_rows($access_mysql)==0)
                        echo "<div class='no_data'>WARNING: NO DATA AVAILABLE FOR ID ".$id.".<br>PLEASE ADD DATA USING CREATE OPTION.
                             </div>";
                }
            }break;
        case 3:
            echo '<form method="POST" action="read.php">
                    <h4>---------------------------------------------<br>SUBJECT: 
                        <select name="subject">
                            <option value=""></option>
                            <option value="Database Architecture and Modelling">Database Architecture and Modelling</option>
                            <option value="Programming I">Programming I</option>
                            <option value="Software Engineering">Software Engineering</option>
                        </select>
                        <input type="hidden" name="opc" value="3"></input>
                        <button type="submit" style="margin-left:10px;margin-top:10px;">SELECT</button>
                        <br>---------------------------------------------<br>
                    </h4>
                 </form>';
            if($_SERVER['REQUEST_METHOD']=='POST' and isset($_POST['subject'])){
                $subject = $_POST['subject'];
                $select_query = "SELECT * FROM DICTIONARY WHERE SUBJECT = '$subject'";
                $access_mysql = mysqli_query($connection,$select_query);
                if(mysqli_num_rows($access_mysql)==0)
                    echo "<div class='no_data'>WARNING: NO DATA AVAILABLE FOR THE SUBJECT<br>".$subject.".<br>
                         PLEASE ADD DATA USING CREATE OPTION.</div>";
            }break;         
    }
    if(isset($select_query) and (mysqli_num_rows($access_mysql)>0)){
        $access_mysql = mysqli_query($connection,$select_query);
        if($access_mysql){
            echo "<table border='1'>";
            echo "<tr>
                    <th>ID</th><th>Term</th><th>Term_PT</th><th>Subject</th><th>Application</th>
                </tr>";
            while($read = mysqli_fetch_array($access_mysql)){
                echo "<tr>";
                echo "<td>".$read['ID']."</td>";
                echo "<td>".$read['Term']."</td>";
                echo "<td>".$read['Term_PT']."</td>";
                echo "<td>".$read['Subject']."</td>";
                echo "<td>".$read['Application']."</td>";
                echo "</tr>";
            }
        }
    }
}