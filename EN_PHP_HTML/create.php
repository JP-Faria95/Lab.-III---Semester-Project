<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREATE TERM</title>
    <style>
        body{
            font-family: 'Consolas';
        }
        .form-group label {
            display: block;
            margin-bottom: 10px; 
        }
        .form-group textarea{
            min-width: 340px;
            max-width: 340px;
            min-height: 95px;
            max-height: 95px;
        }
        .message{
            color:green;
            font-size:18px;
        }
    </style>
</head>
<?php
include('connection.php');
?>
<body>
    <form action="create.php" method="POST" >
        <h1> 
            <br><hr style="border:1px solid black;margin-right:950px;">PLEASE INSERT:
        </h1>
        <h3>
            Term: <input type="text" name="term" style="margin-left:40px;"><br><br>
            Term(PT): <input type="text" name="term_pt" style="margin-right:1000px;"><br><br>
            Subject:
            <select name="subject" style="margin-left:10px;">
                <option value=""></option>
                <option value="Database Architecture and Modelling">Database Architecture and Modelling</option>
                <option value="Programming I">Programming I</option>
                <option value="Software Engineering">Software Engineering</option>
            </select>
        </h3>
        <div class="form-group">
            <h3><label for="application">Application:</label>
                <textarea cols="30" rows="3" name="application"></textarea>
            </h3>
        </div>
        <hr style="border:1px solid black;margin-right:950px;">
        <button type="submit">CREATE</button>
    </form>
</body>
</html>
<?php
// This code will run an INSERT query into the table Dictionary.
if($_SERVER['REQUEST_METHOD']=='POST' and isset($_POST['term'],$_POST['term_pt'],$_POST['subject'],$_POST['application'])){
    $term = $_POST['term'];
    $term_pt = $_POST['term_pt'];
    $subject = $_POST['subject'];
    $application = $_POST['application'];
    $insert_query = "INSERT INTO Dictionary VALUES (NULL,'$term', '$term_pt', '$subject', '$application')";
    $mysql_access = mysqli_query($connection,$insert_query);
    if($mysql_access){
        header("Location:messages.php?message=1");
    }  
} 
