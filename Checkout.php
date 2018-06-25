<html>
<head>
    <style>
        .header{
            text-align: center;
        }
        .content{
            width: 80%;
            position: relative;
        }

    </style>
</head>
<body>
<?php
include ("config.php");
function formatter($string){
    $string=trim($string);
    $string=stripslashes($string);
    $string=htmlspecialchars($string);
    return $string;
}
function showShipAddress(){
    $Name =$_POST['Name'];
    $AddLine1 = $_POST['AddLine1'];
    $AddLine2 = $_POST['AddLine2'];
    $City = $_POST['City'];
    $State = $_POST['State'];
    $ZipCode = $_POST['ZipCode'];
    $NameErr =$GLOBALS['NameErr'];
    $AddLine1Err = $GLOBALS['AddLine1Err'];
    $AddLine2Err = $GLOBALS['AddLine2Err'];
    $CityErr = $GLOBALS['CityErr'];
    $StateErr = $GLOBALS['StateErr'];
    $ZipCodeErr = $GLOBALS['ZipCodeErr'];
    echo '
                    <div class="header">
                        <h1>Shipping Information</h1>
                    </div>
                    <div class="content">
                        <form action="Checkout.php" method="post">
                            Name:<br><input type="text" name="Name" value="'.$Name.'"><span>* '."$NameErr".'</span><br><br>
                            Address Line1:<br><input type="text" name="AddLine1" value="'.$AddLine1.'"><span>* '."$AddLine1Err".'</span><br><br>
                            Address Line2:<br><input type="text" name="AddLine2" value="'.$AddLine2.'"><span>'."$AddLine2Err".'</span><br><br>
                            City:<br><input type="text" name="City" value="'.$City.'"><span>* '."$CityErr".'</span><br><br>
                            State:<br>
                            <select name="State">
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="DC">District Of Columbia</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                            </select><span>* </span><br><br>
                            Zip Code:<br><input type="text" maxlength="5" name="ZipCode" value="'.$ZipCode.'"><span>* '."$ZipCodeErr".'</span><br><br>
                            <input type="submit" value="Continue" name="ShipToPay">
                        </form>
                    </div>  
                ';
}
function showPayment(){
    $FirstNameErr=$GLOBALS['FirstNameErr'];
    $LastNameErr=$GLOBALS['LastNameErr'];
    $CardNumErr=$GLOBALS['CardNumErr'];
    $DateErr=$GLOBALS['DateErr'];
    $SecCodeErr=$GLOBALS['SecCodeErr'];
    $ZipCodeErr=$GLOBALS['ZipCodeErr'];
    $EmailErr=$GLOBALS['EmailErr'];
    $FirstName=$GLOBALS['FirstName'];
    $LastName=$GLOBALS['LastName'];
    $Email=$_POST['Email'];
    $CardNumber=$_POST['CardNumber'];
    $SecurityCode=$_POST['SecurityCode'];
    $ZipCode=$_POST['ZipCode'];
    echo '
                    <div class="header">
                        <h1>Billing Information</h1>
                    </div>
                    <div class="content">
                    <form action="Checkout.php" method="post">
                    First Name:<br><input type="text" name="FirstName" value="'.$FirstName.'"><span>* '."$FirstNameErr".'</span><br><br>
                    Last Name:<br><input type="text" name="LastName" value="'.$LastName.'"><span>* '."$LastNameErr".'</span><br><br>
                    Card Number<br><input type="text" maxlength="16" name="CardNumber" value="'.$CardNumber.'"><span>* '."$CardNumErr".'</span><br><br>
                    Expiration Date:<br>
                        <select name="Month">
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select><span>*</span>
                        <select name="Year">
                            <option>2018</option>
                            <option>2019</option>
                            <option>2020</option>
                            <option>2021</option>
                            <option>2022</option>
                            <option>2023</option>
                            <option>2024</option>
                            <option>2025</option>
                            <option>2026</option>
                            <option>2027</option>
                        </select><span>* '."$DateErr".'</span><br><br>
                        Security Code:<br><input type="text" maxlength="3" name="SecurityCode" value="'.$SecurityCode.'"><span>* '."$SecCodeErr".'</span><br><br>
                        Zip Code:<br><input type="text" maxlength="5" name="ZipCode" value="'.$ZipCode.'"><span>* '."$ZipCodeErr".'</span><br><br>
                        Email:<br><input type="text" name="Email" value="'.$Email.'"><span>* '."$EmailErr".'</span><br><br>
                        <input type="submit" value="Place Orders" name="PlaceOrders">
                    </form><form action="Checkout.php"><input type="submit" value="Back" name="back"></form>
                    </div>
                ';
}
if(isset($_POST['ShipToPay'])) {
    $Name = formatter($_POST['Name']);
    $AddLine1 = formatter($_POST['AddLine1']);
    $AddLine2 = formatter($_POST['AddLine2']);
    $City = formatter($_POST['City']);
    $State = $_POST['State'];
    $ZipCode = formatter($_POST['ZipCode']);
    $NameErr = $AddLine1Err = $AddLine2Err = $CityErr = $StateErr = $ZipCodeErr = "";
    $namePass = $addLine1Pass = $addLine2Pass = $cityPass = $statePass = $zipCodePass = false;
    if (empty($Name)) {
        $NameErr = "First Name is required";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $Name)) {
        $NameErr = "Only letters and space are allowed";
    } else {
        $namePass = true;
    }
    if (empty($AddLine1)) {
        $AddLine1Err = "Address Line1 is required";
    } elseif (!preg_match("/^[a-z0-9- ]+$/i",$AddLine1)) {
        $AddLine1Err = "Invalid Address format";
    } else {
        $addLine1Pass = true;
    }
    if (!preg_match("/^[a-z0-9- ]*$/i", $AddLine2)) {
        $AddLine2Err = "Invalid Address format";
    } else {
        $addLine2Pass = true;
    }
    if (empty($City)) {
        $CityErr = "City is required";
    } elseif (!preg_match("/^[a-zA-Z]+$/", $City)) {
        $CityErr = "Invalid City";
    } else {
        $cityPass = true;
    }
    if (empty($ZipCode)) {
        $ZipCodeErr = "Zip Code is required";
    } elseif (!preg_match("/^[0-9]*$/", $ZipCode) || strlen($ZipCode) < 5) {
        $ZipCodeErr = "Invalid Zip Code";
    } else {
        $zipCodePass = true;
    }
    if($namePass&&$addLine1Pass&&$addLine2Pass&&$cityPass&&$zipCodePass){
        showPayment();
    }
    else{
        showShipAddress();
    }
}
/*else{
    showShipAddress();
}*/
elseif(isset($_POST['PlaceOrders'])){
    $FirstName=formatter($_POST['FirstName']);
    $LastName=formatter($_POST['LastName']);
    $Email=formatter($_POST['Email']);
    $CardNumber=formatter($_POST['CardNumber']);
    $Month=formatter($_POST['Month']);
    $Year=formatter($_POST['Year']);
    $SecurityCode=formatter($_POST['SecurityCode']);
    $ZipCode=formatter($_POST['ZipCode']);
    $FirstNameErr=$LastNameErr=$EmailErr=$CardNumErr=$DateErr=$SecCodeErr=$ZipCodeErr="";
    $firstNamePass=$lastNamePass=$emailPass=$cardNumPass=$datePass=$secCodePass=$zipCodePass=false;
    if(empty($FirstName)){
        $FirstNameErr="First Name is required";
    }
    elseif(!preg_match("/^[a-zA-Z ]*$/",$FirstName)){
        $FirstNameErr="Only letters and space are allowed";
    }
    else{
        $firstNamePass=true;
    }
    if(empty($LastName)){
        $LastNameErr="Last Name is required";
    }
    elseif(!preg_match("/^[a-zA-Z ]*$/",$LastName)){
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
    if(empty($CardNumber)){
        $CardNumErr="Card Number is required";
    }
    elseif(!preg_match("/^[0-9]*$/",$CardNumber)||strlen($CardNumber)<16){
        $CardNumErr="Invalid Card Number";
    }
    else{
        $cardNumPass=true;
    }
    if(empty($SecurityCode)){
        $SecCodeErr="Security Code is required";
    }
    elseif(!preg_match("/^[0-9]*$/",$SecurityCode)||strlen($SecurityCode)<3){
        $SecCodeErr="Invalid Security Code";
    }
    else{
        $secCodePass=true;
    }
    if(empty($ZipCode)){
        $ZipCodeErr="Zip Code is required";
    }
    elseif(!preg_match("/^[0-9]*$/",$ZipCode)||strlen($ZipCode)<5){
        $ZipCodeErr="Invalid Zip Code";
    }
    else{
        $zipCodePass=true;
    }
    $currMonth=date("m");
    $currYear=date("Y");
    if($Year>$currYear){
        $datePass=true;
    }
    elseif($Month>$currMonth){
        $datePass=true;
    }
    else{
        $DateErr="Invalid date";
    }
    if($firstNamePass&&$lastNamePass&&$cardNumPass&&$datePass&&$zipCodePass&&$secCodePass&&$emailPass){
        session_start();
        $cartInfo=$_SESSION['TotalAmount'];
        echo count($cartInfo)."<br>";
        $total=0;
        $pass=false;
        for($i=0;$i<count($cartInfo);$i++){
            $total+=$cartInfo[$i][1];
            $cartID=$cartInfo[$i][0];
            //echo "$total $cartID<br>";
            $sql="SELECT * FROM cart WHERE Id=$cartID";
            $cartResult=mysql_query($sql);
            //echo mysql_num_rows($cartResult);
            if(mysql_num_rows($cartResult)>0){
                while ($row=mysql_fetch_array($cartResult)){
                    $email=$row['Email'];
                    $session['un']=$email;
                    $item=$row['Item'];
                    $quantity=$row['Quantity'];
                    $date=date("Y-m-d");
                    //echo "$email $item $quantity $date";
                    $sql1="INSERT INTO orders SET OrderNum='DEFAULT', User='$email', Item='$item', Quantity='$quantity', Date='$date', Total = '$total'";
                    $pass=mysql_query($sql1);
                }
            }
            $sql2="DELETE FROM cart WHERE Id='$cartID'";
            mysql_query($sql2);
        }
        if($pass){
            header('Location: Ordered.php');
        }

    }
    else{
        showPayment();
    }
}
else{
    showShipAddress();
}
if(isset($_POST['back'])){
    showShipAddress();
}
?>
</body>
</html>