<html>
<head>
    <title>Register</title>
    <style>
    </style>
</head>
<body>
<?php
include ("config.php");
$email = $_POST["email"];
$pwd = $_POST["pwd"];
$first = $_POST["first"];
$last = $_POST["last"];
$sql = "SELECT * FROM users WHERE Email = '$email'";
$sql2 = "INSERT INTO users (Email, Password, FirstName, LastName) VALUES('$email','$pwd','$first','$last')";
$result = mysql_query($sql);
    if (mysql_num_rows($result) == 0) {
            mysql_query($sql2);
            header('Location: Login.html');
    }
    else{
        echo  "<p>username exist</p>";
        echo "<p><button onclick='gologin()'>Back</button></p>";
    }

?>
<script>
    function gologin() {
        location.replace("Register.html");
    }
    </script>
</body>
</html>