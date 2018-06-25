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
        <style>
            /** {box-sizing: border-box}
            body {font-family: Verdana, sans-serif; margin:0}*/
        .slideshowimg {vertical-align: middle;height: 500px;width: 500px;}

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /*each slide*/
        .mySlides{
            text-align: center;
            display: none;
        }
        /* Next & previous buttons */
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: black;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /*Position the "pre button" to the left*/
        .prev{
            left: 0;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
        }

        /* Caption text */
        .text {
            color: black;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: black;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
            text-align: center;
            width: 100%;
        }

        /* The dots/bullets/indicators */
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active1, .dot:hover {
            background-color: #717171;
        }

        /* Fading animation */
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

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {
            .prev, .next,.text {font-size: 11px}
        }
        </style>

        <style>
            /*search styling*/
            .search-container form{
                display: block;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }
        </style>
    </head>

    <body>

        <?php
        include ("config.php");
        $itemList = Array();
        session_start();
        //$_SESSION["itemList"] = $itemList;
        $email = $_SESSION['un'];
        ?>
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
                <li class="active"><a href = 'Home.php'>Home</a></li>
                <?php
                if ($email!=null){
                    echo "<li><a href = 'cart.php' id='cartNav'>Cart($numrow)</a></li>";
                    echo "<li><a href = 'Ordered.php'>Order</a></li>";
                    echo "<li><a href = 'Account.php'>Account</a></li>";
                    echo "<li><a href='logout.php'>Logout</a></li>";
                }
                else{
                    echo "<li><a href='Login.html'>Login</a></li>";
                }
                ?>
                <li class="search-container">
                    <form action="">
                        <input id="search" type="text" placeholder="Search.." name="search" onkeyup="searchItem()">
                    </form>
                </li>
            </ul>
            <script>
                function searchItem() {
                    var string = document.getElementById("search");
                    var itemlist=document.getElementsByClassName("itemlist")[0].getElementsByTagName("li");
                    for(var i=0;i<itemlist.length;i++){
                        var x=itemlist[i].childNodes[0].childNodes[1].innerText;
                        var name=x.split("---")[0];
                        //alert(name);
                        if(name.toLowerCase().search(string.value.toLowerCase())===-1){
                            itemlist[i].style.display="none";
                        }
                        else{
                            itemlist[i].style.display="block";
                        }
                    }
                }
            </script>
        </div>
        <div class="content">
            <div class="slideshow-container">

                <div class="mySlides fade">
                    <div class="numbertext">1 / 3</div>
                    <img src="Iphonex.jpg" class="slideshowimg">
                    <div class="text">iPhone X</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">2 / 3</div>
                    <img src="Iphone8.jpg" class="slideshowimg">
                    <div class="text">iPhone 8</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">3 / 3</div>
                    <img src="Iphone8p.jpg" class="slideshowimg">
                    <div class="text">iPhone 8 plus</div>
                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>

            </div>
            <br>

            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>

            <script>
                var slideIndex = 1;
                showSlides(slideIndex);

                function plusSlides(n) {
                    showSlides(slideIndex += n);
                }

                function currentSlide(n) {
                    showSlides(slideIndex = n);
                }

                function showSlides(n) {
                    var i;
                    var slides = document.getElementsByClassName("mySlides");
                    var dots = document.getElementsByClassName("dot");
                    if (n > slides.length) {slideIndex = 1}
                    if (n < 1) {slideIndex = slides.length}
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active1", "");
                    }
                    slides[slideIndex-1].style.display = "block";
                    dots[slideIndex-1].className += " active1";
                }
            </script>
            <?php
            $sql = "SELECT * FROM item GROUP BY Name";
            $result = mysql_query($sql);
            $i = 0;

            echo "<form action='Home.php' method='post'>";
            echo "<ul class='itemlist'>";
            while($row = mysql_fetch_assoc($result)){
                $itemid = $row["ItemId"];
                $name = $row["Name"];
                $price = $row["Price"];
                $brand = $row["Brand"];
                $color = $row["Color"];
                $pic = $row["Pic"];
                $cap = $row["Cap"];

                $itemList[$i] = $itemid;
                // session_start();
                // $_SESSION["itemList"] = $itemList;
                $i++;
                echo "<li><div class='item'><img src='$pic' class='img' type='button' onclick='showDetail($itemid)'><div class='name'>$name---$cap---$color</div><div class='price'>Price: $$price</div><div class='quantity'>Quantity: <input type='number' name ='$itemid' min='0'></div></div></li>";

                
            }

            echo "</ul>";
            echo "<input type='submit' name='addcart' value='Add to cart'>";
            echo "</form>";
            /*$size= count($itemList);
            echo "$size";*/
            if (isset($_POST['addcart'])){
                for ($i=0; $i<count($itemList); $i++) {
                    $idi = $itemList[$i];
                    $num = $_POST["$idi"];
                    // echo "$num";
                    if($num>0) {
                       /* $sql1 ="SELECT * FROM cart";
                        $answer = mysql_query($sql1);
                        $numrow = mysql_num_rows($answer);
                        $sql2 = "SELECT * FROM cart WHERE "*/
                        $insert = "INSERT INTO cart (Id,Email,Item,Quantity) VALUES (DEFAULT ,'$email','$idi','$num')";
                        mysql_query($insert);
                        //header("Refresh: 0;");
                    }
                }
            }
            ?>
            <script>

                function  showDetail(x) {

                    localStorage.setItem("detail", x);

                   location.replace("temp.html");
                }
            </script>
        </div>

    </body>
</html>
