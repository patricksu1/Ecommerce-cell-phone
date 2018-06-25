<html>
<head>
    <link href="style.css" rel="stylesheet">
    <style>
        img{
            width: 100px;
            height: 100px;
        }
        .itemlist{
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        #checkout{
            position: fixed;
            top: 10%;
            right: 10%;
        }
        #delete{
            position: fixed;
            top: 15%;
            right: 10%;
        }
        .item{
            width: 100%;
            position: relative;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .content{
            width: 80%;
            position: relative;
        }
        .name{
            position: absolute;
            height: 30%;
            right: 20%;
            top: 10%;
        }
        .price{
            position: absolute;
            height: 30%;
            right: 20%;
            top: 50%;
        }
        .sub{
            position: absolute;
            right: 20%;
            bottom: 5%;
        }
        [type=checkbox]{

        }
    </style>
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
        <li class="active" ><a href = 'cart.php' id="cartNav">Cart</a></li>
        <li><a href = 'Ordered.php'>Order</a></li>
        <li><a href = 'Account.php'>Account</a></li>
        <li><a href='logout.php'>Logout</a></li>
    </ul>
</div>
<div class="content">
    <?php
    include ("config.php");
    session_start();
    $priceList=Array();
    $email = $_SESSION['un'];
    if ($email == NULL) {
        header('Location: Home.php');
    }
    $sql = "SELECT * FROM cart WHERE Email = '$email'";
    $result = mysql_query($sql);
    echo "<form action='cart.php' method='post'>";
    echo "<ul class='itemlist'>";
    while($row = mysql_fetch_assoc($result)){
        $num = $row['Quantity'];
        $cartId = $row['Id'];
        $itemid = $row['Item'];
        $getItem = "SELECT * FROM item WHERE ItemId = '$itemid'";
        $itemResult = mysql_query($getItem);
        $itemRow = mysql_fetch_assoc($itemResult);
        $name =$itemRow['Name'];
        $price = $itemRow['Price'];
        $pic = $itemRow['Pic'];
        $cap = $itemRow['Cap'];
        $brand = $itemRow['Brand'];

        $sum = $num * $price;
        $priceList[$cartId] = Array($sum,$brand);

        echo "$test";
        echo "<li><div class='item'><img src='$pic'><div class='name'>$name</div><div class='price'>$$price</div><div class='sub'>sub total: $$sum</div><input type='checkbox' name ='buy[]' value='$cartId'></div>";

    }
    echo "<p>Coupon: <input type='text' name='coupon'></p>";
    echo "<input type='submit' value='checkout' name='checkout' id='checkout'>";
    echo "<input type='submit' value='delete' name='delete' id='delete'>";
    echo "</form>";
    $coupon = $_POST["coupon"];
    if (isset($_POST['checkout'])) {
        $cartItem = $_POST["buy"];
        $itemList =Array();
        if (count($cartItem)==0){
            echo "<p>Please check at least one item</p>";
        }
        else {
            if ($coupon == "") {
                for ($i = 0; $i < count($cartItem); $i++) {
                    // echo "$cartItem[$i]";
                    $itemList[$i] = Array($cartItem[$i], $priceList[$cartItem[$i]][0]);

                }
                session_start();
                $_SESSION['TotalAmount'] = $itemList;
                header('Location: Checkout.php');
            } elseif ($coupon == "ALL5") {
                for ($i = 0; $i < count($cartItem); $i++) {
                    // echo "$cartItem[$i]";
                    $itemList[$i] = Array($cartItem[$i], $priceList[$cartItem[$i]][0] * 0.95);

                }
                session_start();
                $_SESSION['TotalAmount'] = $itemList;
                header('Location: Checkout.php');
            } else {
                $couponquery = "SELECT * FROM coupon WHERE CouponNum = '$coupon'";
                $couponResult = mysql_query($couponquery);
                if (mysql_num_rows($couponResult) == 0) {
                    echo "<p>Invalid coupon</p>";
                } else {
                    $couponRow = mysql_fetch_assoc($couponResult);
                    $couponbrand = $couponRow['Brand'];
                    $temp = 0;
                    for ($i = 0; $i < count($cartItem); $i++) {
                        if ($couponbrand == $priceList[$cartItem[$i]][1]) {
                            $dis = $couponRow['Discount'];
                            $itemList[$i] = Array($cartItem[$i], $priceList[$cartItem[$i]][0] * $dis);
                            $temp++;
                        }
                    }
                    if ($temp == 0) {
                        echo "<p>Invalid coupon</p>";
                    } else {
                        session_start();
                        $_SESSION['TotalAmount'] = $itemList;
                        header('Location: Checkout.php');
                    }
                }
            }
        }
    }
    if(isset($_POST['delete'])){
        $cartItem = $_POST["buy"];
        for($i=0;$i<count($cartItem);$i++){
            $delete="DELETE FROM cart WHERE Id='$cartItem[$i]'";
            mysql_query($delete);
            header("Location: cart.php");
        }

    }
    ?>
</div>

</body>
</html>
