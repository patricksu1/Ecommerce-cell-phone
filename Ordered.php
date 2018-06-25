<html>
<head>
    <link href="style.css" rel="stylesheet">
    <style>
        img{
            width: 200px;
            height: 200px;
        }
        .itemlist{
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
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
        //margin: auto;
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
        .quantity{
            position: absolute;
            right: 20%;
            bottom: 5%;
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
        <li><a href = 'cart.php' id="cartNav">Cart</a></li>
        <li class="active"><a href = 'Ordered.php'>Order</a></li>
        <li><a href = 'Account.php'>Account</a></li>
        <li><a href='logout.php'>Logout</a></li>
    </ul>
</div>
<?php
include ("config.php");

session_start();
$Email=$_SESSION['un'];
if ($Email == null){
    header('Location: Home.php');
}
$sql = "SELECT * FROM orders WHERE User = '$Email'";
$result=mysql_query($sql);
echo "<form action='Ordered.php' method='post'>";
if(mysql_num_rows($result)>0){
    while($row=mysql_fetch_array($result)){
        $OrderNum=$row['OrderNum'];
        // $Date =date("Y-m-d");
        // $Date = row['Date'];
        $itemId = $row['Item'];
        $quan=$row['Quantity'];
        $total=$row['Total'];
        $getItem = "SELECT * FROM item WHERE ItemId = '$itemId'";
        $itemresult = mysql_query("$getItem");
        $itemrow = mysql_fetch_assoc($itemresult);
        $name = $itemrow["Name"];
        $price = $itemrow["Price"];
        $brand = $itemrow["Brand"];
        $color = $itemrow["Color"];
        $pic = $itemrow["Pic"];
        echo"<p><span>order number: $OrderNum</span><span><img src='$pic'></span><span>$name</span><span> $quan*$price</span><span>Total: $total</span><span><input type='checkbox' value='$OrderNum' name='checks[]'></span></p>";
    }

}
echo "<input type='submit' name = 'cancel' value='Cancel Order'>";
if (isset($_POST['cancel'])){
    $checks = $_POST['checks'];
    for ($i =0 ; $i<count($checks);$i++){
        $sql2="DELETE FROM orders WHERE OrderNum='$checks[$i]'";
        mysql_query($sql2);

    }
    header('Location: Ordered.php');
}
?>
</body>
</html>