<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Fast Food</title>
        <script src="index.js"></script>
        <link rel="stylesheet" href="style-1.css">
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
                        <li><img src = "image/bag.png" style = "height:50px; position:absolute; left:90%; top:0%" onclick="show()"><span id="bagCounter" onclick="show()"><?=$itemcount?><span></li>
                   
    
                    </ul>
                </nav>
            </div>
        <div class = "container">
            
    
        <div class = "row">
            <div class="column-2">




            
  
                <div class="slider">
                 
                    <a href="menu-2.php" class="btn"  style="padding-bottom:20px">Order Now! &#8594;</a>
                    <div class = "slides">
                        <input type ="radio" name = "radiobutton" id = "radio1">
                        <input type ="radio" name = "radiobutton" id = "radio2">
                        <input type ="radio" name = "radiobutton" id = "radio3">
                        <input type ="radio" name = "radiobutton" id = "radio4">
                        <div class = "slide first"><img src="image/image.jpg"></div>
                        <div class = "slide"><img src="image/cat1.jpg"></div>
                        <div class = "slide"><img src="image/cat2.jpg"></div>
                        <div class = "slide"><img src="image/cat3.jpg"></div>
                        <div class = "navigation-auto">
                            <div class="auto-btn1"></div>
                            <div class="auto-btn2"></div>
                            <div class="auto-btn3"></div>
                            <div class="auto-btn4"></div>
                        </div>
                        <h1 style="position:absolute; top:15%">
                        Good Food <br>For Good <br>Mood?
                        </h1>
                        <p style="position:absolute; top:38%">Order Here at Fast Food!</p>
                        
                        
                    </div>
                    




                    <div class="navigation-manual">
                        <label for="radio1" class="manual-btn"></label>
                        <label for="radio2" class="manual-btn"></label>
                        <label for="radio3" class="manual-btn"></label>
                        <label for="radio4" class="manual-btn"></label>
                    </div>
                    
                  
    
                </div>
              
            </div>

            
        </div>

        </div>
        
   

    
   

    <!--products-
    <div class="small-container">
        <h2>Featured products</h2>
        <div class = "row">
            <div class="column-4">
                <img src="image/product1.jpg">
                <h4>Lumpia</h4>
                <p>$7.00</p>
            </div>
        </div>
    </div>-->

    <script type = "text/javascript">
    var counter = 1;
    setInterval(function(){
        document.getElementById('radio' + counter).checked = true;
        counter++;
        if(counter > 4){
            counter = 1;
        }
    },5000);
    </script>


    </body>

    <footer >
        <div class="address" >
            <h2>&#169; FAST-FOOD 2021 USA INC.</h2>
            <img src="image/follow.png"></img>
            
              
              
          </div>
          <?php echo '<div class="row5" id ="bag">
                        <div class="column-12">
                            <button class="return" onclick="hide()">Hide this &#8594;</button>
                            <h3>YOUR BAG<a href = "?clear=" style="float:right"; title="Clear all items in the bag">&#128465;</a></h3>
                            <hr class="divider"></hr>
                    
                            <details>
                              <summary id="itemcount">'.$itemcount.'</summary>  
                              <div class="baglist" style="overflow:scroll; overflow-x:hidden; max-height:200px;"><p id="ilist" style = "; ">';
                              for ( $i = 1; $i <= count($item); $i++){ 
                                  echo '<p style="border:solid rgba(255, 151, 60, 0.5); border-width:1px; background: rgba(255, 151, 60, 0.1); margin:1px; ">'; 
                                  echo'<a href="menu.php?del='.$ids[$i].'" style=" position:relative;color:#4e598c; "title = "Remove this item" >&#9746; </a>';
                                   echo  $item[$i];
                                   echo '<span style="float:right; color:#4e598c">$'.$priceList[$i].'</span></p> ';
                              }
                              echo'  </p>
                                </div>
                            </details>
                            <hr class="divider"></hr>
                            <h4 >Sub Total<span id="bagsubtotal" style = "position:absolute; left:80%; color:#ff7720">$'.number_format( $bagPrice,2).'</span></h4>
                            <h4 >Tax<span id="bagtax"  style = "position:absolute; left:80%; color:#ff7720">$'.number_format( $bagtax ,2).'</span></h4>
                            <h4>Total<span id="bagtotal"  style = "position:absolute; left:80%; color:#ff7720">$'.number_format($bagTotal,2).'</span></h4>
                            <hr class="divider"></hr>
                            <a href="checkout.php?checkout" class="btnPO" )">Check Out</a>';?>
    </footer>
</html>