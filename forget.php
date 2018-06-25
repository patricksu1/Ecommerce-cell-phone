<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Retrieve Password</title>
    <style>
        *{
            text-align: center;
        }
        .button{

            font-size: 20px;
            border: none;
            border-radius: 10%;
        }
        .button:hover{

            color: lightskyblue;
        }
    </style>
</head>
<body>
<h1>Find your password</h1>
<form action="forget.php" method="post">
    <p>Please enter your Email: <input type="email" name = "email">
    <p><input class="button" name = "forget" type="submit" value="send"></p>
</form>
<button type="button" class="button"  onclick="back()">cancel</button>
</body>
<script>
    function back() {
        location.replace("Login.html");
    }
</script>
</html>
<?php
if(isset($_POST['forget'])){
 $email =$_POST["email"];
    include ("config.php");
    session_start();
$sql = "SELECT * FROM users WHERE Email = '$email'";
$result = mysql_query($sql);
if (mysql_num_rows($result) == 0) {
    echo"<p>sorry your email does not exist</p>";
    }
    else{
        header("Location:Login.html");

    $_SESSION['changing']=$email;
$subject = 'Changing Password';
$content = "please click on the following link to change password: http://codd.cs.gsu.edu/~wliu11/FinalPro/changepass.php";
$headers = 'From: noreply@goPhones.com';
mail($email,$subject,$content,$headers);

    }
}
?>