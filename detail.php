<html>
<head>
    <link href="style.css" rel="stylesheet">
    <style>

        body {font-family: Verdana, sans-serif; margin:0}
        .mySlides {display: none}
        img {vertical-align: middle;
            width: 200px;
            height: 200px;
        margin: auto
        }


        .slideshow-container {
            padding-top: 200px;
            max-width: 500px;
            position: relative;
            margin: auto;

        }

        .prev, .next {
            cursor: pointer;
            position: relative;
            margin: auto;
            top: 50%;
            padding: 16px;
            margin-top: -22px;
            color: black;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
        }


        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }


        .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
        }

        .text {
            font-size: 40px;
            padding: 8px 12px;
            position: absolute;
            color: black;
            top: 10px;
            width: 100%;
            text-align: center;
        }

        .color {
            cursor: pointer;
            height: 20px;
            width: 50px;
            margin: 0 2px;
            background-color: #bbb;
            border: none;
            border-radius: 10%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active1, .color:hover {
            background-color: #717171;
        }


        .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.5s;
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @-webkit-keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
        }

        @keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
        }


        @media only screen and (max-width: 300px) {
            .prev, .next,.text {font-size: 11px}
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
        margin: auto;
        }
        #itemid{
            display: none;
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
<?php
        include ("config.php");
        session_start();
        $email = $_SESSION['un'];
        $itemid= $_POST['itemid'];
        if ($itemid != null) {
            $_SESSION['it'] = $itemid;

        }
        else{
            $itemid = $_SESSION['it'];
        }
        $colorList = Array();
$idArray = Array();
        $i = 0;

        ?>
<div class="header">
    <ul>
        <li class="active"><a href = 'Home.php'>Home</a></li>
        <?php

        if ($email!=null){
            echo "<li><a href = 'cart.php'  id=\"cartNav\">Cart</a></li>";
            echo "<li><a href = 'Ordered.php'>Order</a></li>";
            echo "<li><a href = 'Account.php'>Account</a></li>";
            echo "<li><a href='logout.php'>Logout</a></li>";
        }
        else{
            echo "<li><a href='Login.html'>Login</a></li>";
        }
        echo "</ul>";
        echo  "</div>";
        echo "  <div class='content'>";
        $sql1 = "SELECT * FROM item WHERE ItemId = '$itemid'";
        $result1 = mysql_query($sql1);
        $row1 = mysql_fetch_assoc($result1);
        $name1 = $row1["Name"];

        $sql = "SELECT * FROM item WHERE Name = '$name1'";
        $result = mysql_query($sql);
         echo " <div class='slideshow-container'>";
        while($row = mysql_fetch_assoc($result)){
            $idi = $row["ItemId"];
            $name = $row["Name"];
            $price = $row["Price"];
            $brand = $row["Brand"];
            $color = $row["Color"];
            $pic = $row["Pic"];
            $cap = $row["Cap"];
            $des = $row["des"];
            $colorList[$i] = $color;
            $idArray[$i] = $idi;
            $i++;

echo "
<div class='mySlides fade'>
<div class='text'>$name</div>
  <img src='$pic' style='width:50%'>
  
</div>";
 }
echo "<a class='prev' onclick='plusSlides(-1)'>&#10094;</a>
<a class='next' onclick='plusSlides(1)'>&#10095;</a>

</div>";

echo "<br>
<div style='text - align:center'>";
for ($j = 0 ; $j <count($colorList); $j++){

  echo "<button class='color' onclick='current($j+1)'>$colorList[$j]</button>";

  }
echo "</div>
 <form action=\"detail.php\" method=\"post\">
 <br>
            <input id =\"itemid\" type=\"text\" name = \"id\" value=\"\">
            Number: <input type=\"number\" name = \"num\" min=\"1\">
            <input type=\"submit\" name =\"add\" value='add to cart'>
        </form>
        
        <br>
        <h2>Description: </h2>
        <p>$des</p>"
;
        if(isset($_POST['add'])) {
            $arrayid = $_POST ["id"];
            $number = $_POST["num"];
           // $idi = count($colorList);
            if($number>0) {

                $insert = "INSERT INTO cart (Id,Email,Item,Quantity) VALUES (DEFAULT ,'$email','$idArray[$arrayid]','$number')";
                mysql_query($insert);
                header('Location:cart.php');
            }
        }
        ?>

        <p id = num> </p>
</div>
<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function current(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var colors = document.getElementsByClassName("color");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < colors.length; i++) {
            colors[i].className = colors[i].className.replace("active1", "");
        }
        slides[slideIndex-1].style.display = "block";
        colors[slideIndex-1].className += " active1";
        document.getElementById("itemid").value=slideIndex-1;
    }
</script>
<?php


?>
</body>
</html>
