<html>
<head>
    <style>
    </style>

</head>
<body>
<?php
include ("config.php");
$email = $_POST["email"];
$pwd = $_POST["pwd"];
$cEmail = formatter($email);
$sql = "SELECT * FROM users WHERE Email = '$cEmail'";
$pwd1 = "";
$result = mysql_query($sql);
if (mysql_num_rows($result)>0){
    while($row = mysql_fetch_assoc($result)){
        $pwd1 = $row["Password"];
    }
}
if ($pwd === $pwd1){
    session_start();
    $_SESSION['un'] = $cEmail;
    header('Location: Home.php');
}
else {
    echo "<p>Password and username are not matched</p>";
    echo "<p><button onclick='gologin()'>Back</button></p>";
}
function formatter($string){
    $string=trim($string);
    $string=stripslashes($string);
    $string=htmlspecialchars($string);
    return $string;
}
?>
<script>
    function gologin() {
        location.replace("Login.html");
    }
</script>
</body>
</html>