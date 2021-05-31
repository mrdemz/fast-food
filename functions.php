<?php


session_start();
if (empty($_SESSION['code']) || time() - $_SESSION['code_time'] > 3600){
    regenerate();
}



$deliveramount = 0;
$itemcount = 0;
$bagPrice = 0;
$fbagPrice = 0;
$bagtax = 0;
$bagTotal = 0 ;
$item = array();
$priceList = array();
$ids = array();
$selected = "";
$delivery = 0; 

$res_name = array();
$res_address = array();
$res_contact = array();

$menu =  array(
    'image' => array (),
    'name'=>array(),
    'price' => array(),
    'description' => array(),
    'id'=>array()
);
$item_id;
$img;
$desc; 
$price;
$name; 


$server_name = 'localhost';
$db_name = 'fast_food';
$user_name = 'root';
$password = 'NUcomsci';

$mysqli = new mysqli($server_name, $user_name, $password, $db_name);
$all_users = $mysqli->query("SELECT*FROM item");
$i = 1;
while($row = $all_users->fetch_assoc()){
    $item_id[$i] = $row['itemId'];
    $img[$i] = $row['image'];
    $desc[$i] = $row['item_desc'];
    $price[$i] = $row['price'];
    $name[$i] = $row['item_name'];
    $i++;
}

$k = 1;
$fastfood = $mysqli->query("SELECT*FROM restaurant");
while($row = $fastfood->fetch_assoc()){
    $res_name[$k] = $row['rest_name'];
    $res_address[$k] = $row['address'];
    $res_contact[$k] = $row['contact'];
    $k++;
}





$_SESSION['bagitem'] = " ";
$temp_users = $mysqli->query("SELECT*FROM temp_table where sessionid = '$_SESSION[code]'");
$y = 1;
while($baglist = $temp_users->fetch_assoc()){
    $item[$y] = $baglist['temp_name'];
    $bagPrice += $price[$baglist['temp_id']];
    $priceList[$y] = $baglist['temp_price'];
    $ids[$y] = $baglist['temp_id'];
    $itemcount++;
     $y++;
    }
    $bagtax = $bagPrice*0.0725;
    $bagTotal = $bagtax + $bagPrice;
  
    $sel  = $mysqli->query("SELECT*FROM fast_food.temp ");
    $fsel  =$sel->fetch_assoc();
    $selected = $name[$fsel['id_temp']];
   
   


    
  
    $sqldel ="CREATE EVENT IF NOT EXISTS $_SESSION[code]  ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 1 HOUR DO DELETE FROM fast_food.temp_table WHERE sessionid = '$_SESSION[code]'";
    if ($mysqli->query($sqldel) === TRUE) {
        
      } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
      }
      $sqldel2 ="CREATE EVENT IF NOT EXISTS temp$_SESSION[code]  ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 1 HOUR DO DELETE FROM fast_food.temp WHERE id_session = '$_SESSION[code]'";
      if ($mysqli->query($sqldel2) === TRUE) {
          
        } else {
          echo "Error: " . $sql . "<br>" . $mysqli->error;
        }

 

    

    




$test = array();
   

    if (isset($_GET['id'])){
      
      
       if($_GET['id']!= 100){
        $sql1 ="DELETE FROM fast_food.temp WHERE id_session = '$_SESSION[code]'";
        if ($mysqli->query($sql1) === TRUE) {
   
          } else {
            echo "Error: " . $sql1 . "<br>" . $mysqli->error;
          }
        $sql = 'INSERT INTO fast_food.temp (id_temp, id_session) VALUE ("'.$_GET['id'].'","'.$_SESSION['code'].'")';
        if ($mysqli->query($sql) === TRUE) {
          
          } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
          }

          $sel  = $mysqli->query("SELECT * FROM fast_food.temp WHERE id_session = '$_SESSION[code]'");
          $fsel  =$sel->fetch_assoc();
          $selected = $name[$fsel['id_temp']];
        }
          if($_GET['id']==100){

            $xval  = $mysqli->query("SELECT*FROM fast_food.temp WHERE id_session = '$_SESSION[code]'");
            $tempval  =$xval->fetch_assoc();
            $val = $tempval['id_temp'];


 
         
            $sql = 'INSERT INTO fast_food.temp_table (temp_id, temp_name, temp_price, sessionid) VALUE ("'.$val.'", "'.$name[$val].'", "'.$price[$val].'", "'.$_SESSION['code'].'")';
            if ($mysqli->query($sql) === TRUE) {
              
              } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
              }
    
              $temp_users = $mysqli->query("SELECT*FROM temp_table");
              goback1();
                $y = 0;
            }
               


          }




          if (isset($_GET['del'])){
            $sql1 ="DELETE FROM fast_food.temp_table where temp_id = '$_GET[del]' limit 1";
            if ($mysqli->query($sql1) === TRUE) {
           
            } else {
              echo "Error: " . $sql . "<br>" . $mysqli->error;
           }
           goback1();
   
          }
          if (isset($_GET['clear'])){
            $sql1 ="DELETE FROM fast_food.temp_table";
            if ($mysqli->query($sql1) === TRUE) {
           
            } else {
              echo "Error: " . $sql . "<br>" . $mysqli->error;
           }
           goback1();
   
          }

       
/* EVERYTHING WITH DELIVERY */

     if (isset($_POST['order_type'], $_POST['street'], $_POST['city'], $_POST['zipcode'],$_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['phone'] )){

            if(empty($_POST['street'])||empty($_POST['city'])||empty($_POST['zipcode'])||empty($_POST['fname'])||empty($_POST['lname'])||empty($_POST['phone'])||empty($_POST['nameoncard'])||empty($_POST['cardnumber'])||empty($_POST['expdate'])||empty($_POST['cvv'])||empty($_POST['zip'])||empty($item)){
              if(empty($item)){
                echo '<script>alert("You cannot place an order with an empty bag")</script>';
              }else{
            echo '<script>alert("Please fill in all the required field")</script>';
              }
            }
            else{



          $finallist =" ";
          $delivery_address=" ";
          $finalprice = $bagTotal;
          for($i = 1; $i <= count($item);$i++){
            $finallist .= " ".$item[$i].",";
          }
            $finalprice += 8;
    
          date_default_timezone_set('America/Los_Angeles');
          $date = date('Y-m-d H:i:s');
        
        
          $delivery_address .= $_POST['street'].", ".$_POST['city'].", ".$_POST['zipcode'];
          $sql = 'INSERT INTO fast_food.order (total, order_type, date_order , itemlist) VALUE ("'.$finalprice.'", "'.$_POST['order_type'].'", "'.$date.'", "'.$finallist.'")';
          $order_id;
          if ($mysqli->query($sql) === TRUE) {
            $order_id = $mysqli->insert_id;
            $sql = 'INSERT INTO fast_food.customer (order_Id, delivery_address, email, phone, fname, lname) VALUE ("'.$order_id.'","'.$delivery_address.'", "'.$_POST['email'].'", "'.$_POST['phone'].'", "'.$_POST['fname'].'", "'.$_POST['lname'].'")';
            if ($mysqli->query($sql) === TRUE) {
              $_SESSION['final_order_id'] = $order_id;
              header("Location: orderplaced.php");
              exit();
              } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
              }
              
            } else {
              echo "Error: " . $sql . "<br>" . $mysqli->error;
            }

          }
        }


          
       




    /* EVERYTHING PICKUP */
   else if (isset($_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['phone'] )){
      if(empty($_POST['fname'])||empty($_POST['lname'])||empty($_POST['phone'])||empty($_POST['nameoncard'])||empty($_POST['cardnumber'])||empty($_POST['expdate'])||empty($_POST['cvv'])||empty($_POST['zip'])||empty($item) ){
        if(empty($item)){
          echo '<script>alert("You cannot place an order with an empty bag")</script>';
        }else{
      echo '<script>alert("Please fill in all the required field")</script>';
        }
      }
      else{


      $finallist =" ";
      $delivery_address=" ";
      $finalprice = $bagTotal;
      for($i = 1; $i <= count($item);$i++){
        $finallist .= " ".$item[$i].",";
      }
   
      date_default_timezone_set('America/Los_Angeles');
      $date = date('Y-m-d H:i:s');
    
    
      
      $sql = 'INSERT INTO fast_food.order (total, order_type, date_order , itemlist) VALUE ("'.$finalprice.'", "'.$_POST['order_type'].'", "'.$date.'", "'.$finallist.'")';
      $order_id;
      if ($mysqli->query($sql) === TRUE) {
        $order_id = $mysqli->insert_id;
        $sql = 'INSERT INTO fast_food.customer (order_Id, phone, fname, lname) VALUE ("'.$order_id.'","'.$_POST['phone'].'", "'.$_POST['fname'].'", "'.$_POST['lname'].'")';
        if ($mysqli->query($sql) === TRUE) {
          $_SESSION['final_order_id'] = $order_id;
            header("Location: orderplaced-1.php");
            exit();
          } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
          }
          
        } else {
          echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
      
      }
    }
 

          
          
        
        

         
            
         




          if (isset($_GET['rem'])){
            $sql1 ="DELETE FROM fast_food.temp_table where temp_id = '$_GET[rem]' limit 1";
            if ($mysqli->query($sql1) === TRUE) {
            echo "New record created successfully";
            } else {
              echo "Error: " . $sql . "<br>" . $mysqli->error;
           }
           goback2();
   
          }


          function goback1(){
            header("Location: menu.php");
            exit();
        
           }
           function goback2(){
            header("Location: checkout.php");
            exit();
        
           }

           function delivery(&$deliveramount){
             $deliveramount = 8.00;

           }
      
   

    

    $menu['id'] = $item_id;
    $menu['image'] = $img;
    $menu['description'] = $desc;
    $menu['price'] = $price;
    $menu['name'] = $name;
    function regenerate() {
      $_SESSION['code'] = uniqid();
      $_SESSION['code_time'] = time();
  }

    $mysqli->close();

