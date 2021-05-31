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
                        <li><img src = "image/bag.png" style = "height:50px; position:absolute; left:90%; top:0%" onclick="show()"><span id="bagCounter" onclick="show()"><?=$itemcount?><span></img></li>
                   
    
                    </ul>
                </nav>
            </div>
        <div class = "container">
            
    
        <div class = "aboutrow">
            <div class="aboutcolumn-2">




            
  
                <div class="aboutcontainer">
                    <div class="info" style="background-color:#6b4519; width:40%; position:absolute; left:1%; top:1%; padding-left:24px; height:535px; border-radius:3%; border: solid #563434">
                        <ul style="color:white">
                            <li>Name: <?=$res_name[1]?></li><br>
                            <li>Contact: <?=$res_contact[1]?></li><br>
                            <li>Address: <?=$res_address[1]?></li><br>
                            <li>Email-Address: fast@food.com</li><br>
                        </ul>
                    </div>
                 
                    <div class = "aboutimage">
                
                        <div class = "aboutimage"><img src="image/res.jpg"  style="border-radius:3%"></div>
                        
                    </div>
                    




                    
                  
    
                </div>
              
            </div>

            
        </div>

        </div>
        
    </div>


    <script type = "text/javascript">
 
    </script>
   

 



    </body>

    <footer >
        <div class="address" >
            <h2>&#169; FAST-FOOD 2021 USA INC.</h2>
            <img src="image/follow.png"></img>
            
              
              
          </div>
          <?php echo '<div class="row5" id ="bag" >
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
                            </div>
                            </div>
    </footer>
</html>