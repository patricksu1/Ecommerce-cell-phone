<?php
$host="localhost";
$username="wliu11";
$psw="wliu11";
$dbName="wliu11";
$conn=mysql_connect("$host","$username","$psw");
if(!$conn){
    die("Cannot connect to server");
}
else{
    mysql_select_db("$dbName");
    //echo "Connection established<br>";
}
?>