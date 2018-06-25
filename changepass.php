
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Retrieve Password</title>
    <style>

    </style>
</head>
<body>
<?php
session_start();
$email = $_SESSION[changing];

?>

<h1>Change your password</h1>
<form action="changepass.php" method="post" onsubmit="return valpass()">
    <p>Your Email: <input type="email" name = "email" value=<?php echo "$email";?> disabled>
    <p>New Password:<input id ="newpass" type="password" name="newpwd"></p>
    <p>Retype Password: <input id = "repass" type="password"></p>
    <p><input name = "changepass" type="submit"></p>
    <p id="error"></p>
</form>
</body>
<script>
    function valpass() {
        var pwd = document.getElementById("newpass").value;
        var newpwd = document.getElementById("repass").value;
        if(pwd !=newpwd){
            document.getElementById("error").innerHTML = "passwords do not match";
            return false;
        }
        else {
            return true;
        }
    }
    </script>
</html>
<?php
if(isset($_POST['changepass'])){

    $newpwd =$_POST["newpwd"];
    include ("config.php");
    $sql = "UPDATE users SET Password='$newpwd' WHERE Email='$email'";
     mysql_query($sql);
    session_unset();
    header("Location:Login.html");

}
?>
