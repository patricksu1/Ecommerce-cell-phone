<?php
include "config.php";
session_start();
$email = $_SESSION['un'];
$query="SELECT * FROM cart WHERE Email='$email'";
$answer=mysql_query($query);
$numrow = mysql_num_rows($answer);
echo $numrow;