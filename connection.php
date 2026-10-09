<?php


$servername="localhost";
$username="root";
$password="";
$db="asma";



$conn = mysqli_connect($servername,$username, $password, $db);


if($conn==false){

    echo 'error';
}

?>