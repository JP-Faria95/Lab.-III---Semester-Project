<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE TERM</title>
    <style>
        body{
            font-family: 'Consolas';
        }
        .radio-group span{
            display:inline-block;
            width:115px;
        }
        .no_data{
            color:red;
            font-size:25px;
        }
        .form-group textarea{
            min-width: 240px;
            max-width: 240px;
            min-height: 80px;
            max-height: 80px;
        }
        .form-group{
            display:flex;
        }
    </style>
</head>
<?php
include('connection.php');
?>
<body>
    <h1 style="margin-bottom:1px;">CHOOSE TO UPDATE</h1>
    <hr style="margin: 5px 0;border:1px solid black;margin-right:1065px;">
    <form action="update.php" method="POST">
        <h3 style="margin:5px;">
            <div class="radio-group">
                <span>ROW</span><input type="radio" name="opc" value="1" style="margin-bottom:10px;"><br>
                <span>FIELD</span><input type="radio" name="opc" value="2"><br>
            </div>
        </h3>
        <hr style="margin: 5px 0;border:1px solid black;margin-right:1065px;">
        <button type="submit" style="margin-top:5px;">OK</button>
    </form>
</body>
</html>
<?php
if($_SERVER['REQUEST_METHOD']=='POST' and isset($_POST['opc'])){
    $opc = $_POST['opc'];
    echo '<form method="POST" action="update.php">
            <h4>---------------<br>ID:
                <input type="text" name="id" style="width:20px;">
                <input type="hidden" name="opc" value="'.$opc.'">
                <button type="submit" style="margin-left:15px;">OK</button><br>
                ---------------
            </h4>
          </form>';
}

if($_SERVER['REQUEST_METHOD']=='POST' and isset($_POST['id'],$_POST['opc'])){
    $id = $_POST['id'];
    $opc = $_POST['opc'];
    if($id<1 or $id>20)
        echo '<div class="no_data">WARNING: INVALID OPTION FOR ID.<br>PLEASE INSERT IDs FROM 1 - 20.</div>';
    else{
        $select_query = "SELECT * FROM DICTIONARY WHERE ID = $id";
        $access_mysql = mysqli_query($connection,$select_query);
        if(mysqli_num_rows($access_mysql)==0)
            echo '<div class="no_data">WARNING: NO DATA AVAILABLE FOR ID '.$id.'.<br>PLEASE ADD DATA USING CREATE OPTION.';
        else{
            switch($opc){
                case 1:
                    echo '<form method="POST" action="update.php">
                            <h4>
                                <div class="no_data" style="margin-left:30px;">
                                    INSERT NEW VALUES FOR ID '.$id.'<br>
                                </div>
                                <hr style="border:1px solid black;margin-right:900px;">
                                <div class="radio-group">
                                    <span>Term:</span>
                                        <input type="text" name="nterm" style="margin-left:30px;width:232px;"><br>
                                    <span>Term(PT):</span>
                                        <input type="text" name="nterm_pt" style="margin-top:15px;margin-left:30px;width:232px;"><br>
                                    <span style="margin-top:20px;">Subject:</span>
                                        <select name="nsubject" style="margin-left:29px;">
                                                <option value=""></option>
                                                <option value="Database Architecture and Modelling">Database Architecture and Modelling</option>
                                                <option value="Programming I">Programming I</option>
                                                <option value="Software Engineering">Software Engineering</option>
                                        </select>
                                </div><br>
                                <div class="form-group">
                                    <label for="napplication">Application: </label><br>
                                    <textarea id="napplication" name="napplication" style="margin-left:45px;"></textarea>
                                </div>
                                <hr style="border:1px solid black;margin-right:900px;">
                                <input type="hidden" name="id" value="'.$id.'">
                                <button type="submit" style="margin-left:170px;">UPDATE</button>
                            </h4>
                         </form>';break;
                         
                case 2:
                    echo '<form method="POST" action="update.php">
                            <h4>
                                <div class="no_data" style="margin-left:40px;">
                                    FIELD TO UPDATE:<br>
                                </div>
                                <hr style="border:1px solid black;margin-right:1060px;">
                                <div class="radio-group">
                                    <span>TERM</span><input type="radio" name="opc2" value="1"><br>
                                    <span>TERM(PT)</span><input type="radio" name="opc2" value="2"><br>
                                    <span>SUBJECT</span><input type="radio" name="opc2" value="3"><br>
                                    <span>APPLICATION</span><input type="radio" name="opc2" value="4">
                                </div>
                                <input type="hidden" name="id" value="'.$id.'">
                                <hr style="border:1px solid black;margin-right:1060px;">
                                <button type="submit">OK</button>
                            </h4>
                         </form>';break;
            }
        }
    }
}
if($_SERVER['REQUEST_METHOD']=='POST' and isset($_POST['id']) and isset($_POST['nterm'],$_POST['nterm_pt'],$_POST['nsubject'],
$_POST['napplication'])){
        $id = $_POST['id'];
        $nterm = $_POST['nterm'];
        $nterm_pt = $_POST['nterm_pt'];
        $nsubject = $_POST['nsubject'];
        $napplication = $_POST['napplication'];
        $update_query = "UPDATE DICTIONARY SET Term = '$nterm', Term_PT = '$nterm_pt', Subject = '$nsubject', Application = '$napplication'
                        WHERE ID = $id";
        if(mysqli_query($connection, $update_query));
            header("Location:messages.php?message=2");
}
if($_SERVER['REQUEST_METHOD']=="POST" and isset($_POST['opc2'],$_POST['id'])){
    $opc2 = $_POST['opc2'];
    $id = $_POST['id'];
    echo '<form method="POST" action="update.php">';
    /*echo '<input type="hidden" name="opc" value="2"></input>';*/
    echo '<input type="hidden" name="id" value="'.$id.'"></input>';
    if($opc2==1){
        echo '<h4>
                <label style="margin-left:5px;">Insert a new Term:</label><br>
                    <input type="text" name="term2" style="margin-top:5px;"></input> 
                <button type="submit">UPDATE</button>
             </h4>';        
    }
    else if($opc2==2){
        echo '<h4>
                <label style="margin-left:5px;">Insert a new Term(PT):</label><br>
                    <input type="text" name="term_pt2" style="margin-top:5px;width:195px;"></input>
                <button type="submit">UPDATE</button>
             <h4>';
    }
    else if($opc2==3){
        echo '<h4>
                <label style="margin-left:15px;">Insert a new Subject:</label><br>
                    <select name="subject2">
                        <option value=""></option>
                        <option value="Database Architecture and Modelling">Database Architecture and Modelling</option>
                        <option value="Programming I">Programming I</option>
                        <option value="Software Engineering">Software Engineering</option>
                    </select>
                <button type="submit">UPDATE</button>
             </h4>';
    }
    else{
        echo '<h4>
                <label style="margin-left:5px;">Insert a new Application:</label><br>
                    <div class="form-group">
                        <textarea id="application2" name="application2" style="margin-top:5px;"></textarea>
                    </div>
                <button type="submit" style="margin-top:10px;">UPDATE</button>
             </h4>';
    }
    echo '</form>';           
}
if($_SERVER['REQUEST_METHOD']=="POST" and isset($_POST['id'],$_POST['term2'])){
    $id = $_POST['id'];
    $term2 = $_POST['term2'];
    $update_query = "UPDATE DICTIONARY SET Term = '$term2' WHERE ID = $id";
    if(mysqli_query($connection,$update_query));
        header("Location:messages.php?message=2");
}
else if($_SERVER['REQUEST_METHOD']=="POST" and isset($_POST['id'],$_POST['term_pt2'])){
    $id = $_POST['id'];
    $term_pt2 = $_POST['term_pt2'];
    $update_query = "UPDATE DICTIONARY SET Term_PT = '$term_pt2' WHERE ID = $id";
    $access_mysql = mysqli_query($connection,$update_query);
    if($access_mysql){
        header("Location:messages.php?message=2");
    }
    
}
else if($_SERVER['REQUEST_METHOD']=="POST" and isset($_POST['id'],$_POST['subject2'])){
    $id = $_POST['id'];
    $subject2 = $_POST['subject2'];
    $update_query = "UPDATE DICTIONARY SET Subject = '$subject2' WHERE ID = $id";
    $access_mysql = mysqli_query($connection,$update_query);
    if($access_mysql){
        header("Location:messages.php?message=2");
    }
}
else if($_SERVER['REQUEST_METHOD']=="POST" and isset($_POST['id'],$_POST['application2'])){
    $id = $_POST['id'];
    $application2 = $_POST['application2'];
    $update_query = "UPDATE DICTIONARY SET Application = '$application2' WHERE ID = $id";
    $access_mysql = mysqli_query($connection,$update_query);
    if($access_mysql){
        header("Location:messages.php?message=2");
    }
}