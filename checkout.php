<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Fast Food</title>
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@1,400;1,600&display=swap" rel="stylesheet">
    </head>
    <body>
    <?php include("functions.php");?>
        <div class="header">
            <div class="navbar">
                <div class="logo">
                    <img src="image/logo.png" width="420px">
                </div>
                <nav>
                    <ul>
                    <li><a href="index.php" >Home</a></li>
                        <li><a href="menu-2.PHP">Menu</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><img src = "image/bag.png" style = "height:50px; position:absolute; left:90%; top:0%"><span id="bagCounter"><?=$itemcount?><span></li>
    
                    </ul>
                </nav>
            </div>
        <div class = "container">
            <form method="post">
         

            <div class="row1">
                <div class="column-10" style="width:430px">
                    <h3 style="padding-left:10px">PICKUP OR DELIVERY OPTIONS</h3>
                    <label for="pickup">Pick-up<i class="user"></i></label>
                    <input type ="radio" name = "order_type" id = "pickup" value = "Pickup"onclick = "EnableDisableTextBox(); change(this.value)" CHECKED><br><br>
                    <p>9388 Lightwave Ave, <br>San Diego,<br> CA 92123<br><br><br>
                        
                    </p>
           
                    <label for="deliver">Delivery (additional $8.00)<i class="user"></i></label>
                    <input type ="radio" name = "order_type" id = "deliver" value="Deliver" onclick = "EnableDisableTextBox(); change(this.value)"><br><br>

                    <label for="street">Street Name and No.(e.g. House No., Apt. No.)<i class="user"></i></label>
                    <input type = "text" id="street" name="street"  disabled = "true"><br>

                    <label for="city">City<i class="user"></i></label>
                    <input type = "text" id="city" name="city" disabled = "true"><br>

                    <label for="zipcode">Zip Code<i class="user"></i></label>
                    <input type = "text" id="zip" name="zipcode"  disabled = "true"><br>

                </div>


            </div>
        
            <div class="row2">
                <div class="column-10">
                    <h3>CONTACT INFO </h3>
                    <label for="fname"><i class="user">First Name (Required*)</i></label>
                    <input type = "text" id="fname" name="fname"><br>

                    <label for="lname">Last Name (Required*)<i class="user"></i></label>
                    <input type = "text" id="lname" name="lname"><br>

                    <label for="email">Email Address (Optional)<i class="user"></i></label>
                    <input type = "text" id="email" name="email"><br>

                    <label for="phone">Phone Number (Required*)<i class="user"></i></label>
                    <input type = "text" id="phone" name="phone"><br>

                </div>


            </div>
            <div class="row2">
                <div class="column-10">
                    <h3>PAYMENT</h3>
                    <label for="nameOnCard"><i class="user">Name on Card (Required*)</i></label>
                    <input type = "text" id="nameOnCard" name="nameoncard"><br>

                    <label for="cardNumber">Card Number (Required*)<i class="user"></i></label>
                    <input type = "text" id="cardNumber" name="cardnumber"><br>

                    <label for="exp">Expiration Date (Required*)<i class="user"></i></label>
                    <input type = "text" id="exp" name="expdate"><br>

                    <label for="cvv">CVV (Required*)<i class="user"></i></label>
                    <input type = "text" id="cvv" name="cvv"><br>

                    <label for="zipCode">Billing Zip Code (Required*)<i class="user"></i></label>
                    <input type = "text" id="zipCode" name="zip"><br>

                </div>


            </div>
            <div class="row3" style="right:5%">
                <div class="column-11">
                    <h3>YOUR BAG</h3>
                    <hr class="divider"></hr>
            
                    <details>
                   
                 
                     <summary><?=$itemcount?> items</summary>
                     <?php
                     echo '<div class="baglist" style="overflow:scroll; overflow-x:hidden; max-height:200px;"><p id="ilist" style = "; ">';
                       for ( $i = 1; $i <= count($item); $i++){ 
                           echo '<p style="border:solid rgba(255, 151, 60, 0.5); border-width:1px; background: rgba(255, 151, 60, 0.1); margin:1px; ">'; 
                           echo'<a href="checkout.php?rem='.$ids[$i].'" style=" position:relative;color:#4e598c; "title = "Remove this item" >&#9746; </a>';
                            echo  $item[$i];
                            echo '<span style="float:right; color:#4e598c">$'.$priceList[$i].'</span></p> ';
                       }
                       echo'  </p>';?>
                        </div>
                    </details>
                    <hr class="divider"></hr>
                    <h4>Sub Total<span id="subspan">$<?=number_format( $bagPrice,2)?></span></h4>
                    <h4>Tax<span id="taxspan">$<?=number_format( $bagtax ,2)?></span></h4>
                    <h4>Delivery: <span id ="delspan">$0</span></h4>
                    <h4>Total<span id="totalspan">$<?=number_format($bagTotal,2)?></span></h4>
                    <hr class="divider"></hr>
                    <button type = "submit" value="submit" class="btnPO" style="text-align:center">Place Order<span id="butspan">$<?=number_format($bagTotal,2)?></span></a>

                </div>


            </div>

        
        
        
        </form>
    
            


        </div>


    
   



    </body>

    <footer>
        <div class="address">
            <h2>&#169; FAST-FOOD 2021 USA INC.</h2>
            <img src="image/follow.png"></img>
              
              
          </div>
    </footer>




    <script type="text/javascript">
        function change(y){
     
     var tax = document.getElementById("taxspan").innerHTML;
     var sub = document.getElementById("subspan").innerHTML;
     var regex = /[+-]?\d+(\.\d+)?/g;
     var n1 = parseFloat(tax.match(regex));
     var n2 =  parseFloat(sub.match(regex));

     var total = n1+n2;
     if (y == 'Deliver') {
         var val = total+8;
         document.getElementById("totalspan").innerHTML = "$"+val;
         document.getElementById("butspan").innerHTML = "$"+val;
         document.getElementById("delspan").innerHTML = "$"+8;
     }
     else if (y == 'Pickup') {
         document.getElementById("totalspan").innerHTML = "$"+total;
         document.getElementById("butspan").innerHTML = "$"+total;
         document.getElementById("delspan").innerHTML = "$"+0;
     }
 }
                function EnableDisableTextBox() {
                var chkYes = document.getElementById("deliver");
                
                 street.disabled = chkYes.checked ? false : true;
                 city.disabled = chkYes.checked ? false : true;
                 zip.disabled = chkYes.checked ? false : true;
                 
                }</script>
</html>