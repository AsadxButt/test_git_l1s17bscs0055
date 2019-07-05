<?php
$connection = mysqli_connect('localhost','root','','army_db');
if(!$connection)
    die("'army_db' database not connected.");
$name = $_REQUEST["name"];
$reg = $_REQUEST["reg"];
$cgpa = $_REQUEST["cgpa"];
$dob = $_REQUEST["dob"];
$height = $_REQUEST["height"];
$check_candidate = "select * from candidates where reg = '$reg'";
$isApplied = mysqli_query($connection, $check_candidate);
if(mysqli_num_rows($isApplied)==0) {
    $insert_candidate = "insert into candidates (name,reg,cgpa,dob,height) values ('$name','$reg','$cgpa','$dob','$height');";
    if (mysqli_query($connection, $insert_candidate)) {
        echo "Applied Successfully";
    }
} else {
    echo "Can't Apply Twice";
}