<?php
function my_connect_local_DB(){
    $user='root';
    $password='123456';
    $host='localhost:3306';

    $conn=mysqli_connect($host,$user,$password);
    mysql_iswork($conn,$conn,'Could not connect: ');
    mysqli_query($conn,'set names utf8');
    return $conn;
}

function mysql_iswork($conn,$result,$message){
    if(!$result) {
        die($message . mysqli_error($conn));
    }
}

function insert_into_user_info(mysqli $conn,$user,$psw){
    $sql="INSERT INTO user_info(user_name,user_key) VALUE ('$user','$psw');";
    $conn->query($sql);
}
