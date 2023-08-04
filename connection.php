<?php
$server="127.0.0.1";
$userid="root";
$password="";
$database="mydb";


$conn=mysqli_connect($server,$userid,$password,$database);
if(!$conn){
    die('Error: '.mysqli_connect_error());
}
?>