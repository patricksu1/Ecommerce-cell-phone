<html>
<head>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<script>
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        //alert(this.readyState);
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("cartNav").innerHTML ="Cart("+ this.responseText +")";
        }
    };
    xhttp.open("GET", "cartNum.php", true);
    xhttp.send();
</script>
<div class="header">
    <ul>
        <li><a href = 'Home.php'>Home</a></li>
        <li><a href = 'cart.php' id="cartNav">Cart</a></li>
        <li><a href = 'Ordered.php'>Order</a></li>
        <li class="active"><a href = 'Account.php'>Account</a></li>
        <li><a href='logout.php'>Logout</a></li>
    </ul>
</div>
<?php
include ("config.php");

session_start();
$oldEmail=$_SESSION['un'];
if ($oldEmail == null){
    header('Location: Home.php');
}

if(isset($_POST['submitButton'])){
    //updateProfile();
    //echo "$FirstNameErr";
    $FirstName=$_POST['FirstName'];
    $LastName=$_POST['LastName'];
    $Email=$_POST['Email'];
    $Password=$_POST['Password'];
    $ConfirmPassword=$_POST['ConfirmPassword'];
    $oldEmail=$_SESSION['un'];
    $sql="UPDATE users 
                SET FirstName='$FirstName', LastName='$LastName', Password='$Password'
                WHERE Email='$oldEmail'";
    $FirstNameErr=$LastNameErr=$EmailErr=$PwdErr=$CfmPwdErr="";
    $firstNamePass=$lastNamePass=$emailPass=$pwdPass=$cfmPwdPass=false;
    if(empty($FirstName)){
        $FirstNameErr="First Name is required";
    }
    elseif(!preg_match("/^[a-zA-Z ]*$/",formatter($FirstName))){
        $FirstNameErr="Only letters and space are allowed";
    }
    else{
        $firstNamePass=true;
    }
    if(empty($LastName)){
        $LastNameErr="Last Name is required";
    }
    elseif(!preg_match("/^[a-zA-Z ]*$/",formatter($LastName))){
        $LastNameErr="Only letters and space are allowed";
    }
    else{
        $lastNamePass=true;
    }
    if(empty($Email)){
        $EmailErr="Email is required";
    }
    elseif(!filter_var(formatter($Email),FILTER_VALIDATE_EMAIL)){
        $EmailErr="Invalid email format";
    }
    else{
        $emailPass=true;
    }
    if(empty($Password)){
        $PwdErr="Password is required";
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/",formatter($Password))){
        $PwdErr="Invalid password";
    }
    else{
        $pwdPass=true;
    }
    if(empty($ConfirmPassword)){
        $CfmPwdErr="Re-enter password is required";
    }
    elseif ($Password!==$ConfirmPassword){
        $CfmPwdErr="Password didn't match";
    }
    else{
        $cfmPwdPass=true;
    }
    if($firstNamePass&&$lastNamePass&&$emailPass&&$pwdPass&&$cfmPwdPass){
        $result=mysql_query($sql);
        if($result){
            // $_SESSION['Email']=$Email;
        }
        else{
            echo "Update failed<br>";
        }
    }
}
//$oldEmail=$_SESSION['un'];
$sql="SELECT * FROM users WHERE Email='$oldEmail'";
$result=mysql_query($sql);
if(mysql_num_rows($result)>0){
    while($row=mysql_fetch_array($result)){
        $FirstName=$row['FirstName'];
        $LastName=$row['LastName'];
        $Password=$row['Password'];
        $Email=$row['Email'];
    }
}
else{
    header('Location: Login.php');
}
function formatter($string){
    $string=trim($string);
    $string=stripslashes($string);
    $string=htmlspecialchars($string);
    return $string;
}
?>
<form action="Account.php" method="post">
    First Name:<br><input type="text" value='<?php echo "$FirstName"; ?>' name="FirstName"><span>* <?php echo "$FirstNameErr"; ?></span><br><br>
    Last Name:<br><input type="text" value='<?php echo "$LastName"; ?>' name="LastName"><span>* <?php echo "$LastNameErr"; ?></span><br><Br>
    Email:<br><input type="text" value='<?php echo "$Email"; ?>' name="Email" readonly><span>* <?php echo "$EmailErr"; ?></span><br><br>
    Password<br><input type="password" value='<?php echo "$Password"; ?>' name="Password"><span>* <?php echo "$PwdErr"; ?></span><br><br>
    Re-enter password:<br><input type="password" value='<?php echo "$Password"; ?>' name="ConfirmPassword"><span>* <?php echo "$CfmPwdErr"; ?></span><br><br>
    <input type="submit" value="Update" name="submitButton">
</form>
</body>
