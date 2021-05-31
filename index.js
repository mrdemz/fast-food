

 
      function show(){
          
          var x = document.getElementById("bag");
          x.classList.remove("hide");
          x.classList.add("show");   
      }


    
      function hide(){
          var x = document.getElementById("bag");
              x.classList.remove("show");
              x.classList.add("hide");
       
      }
      function change(y){
     
        var tax = document.getElementById("taxspan").innerHTML;
        var sub = document.getElementById("subspan").innerHTML;
        if (y == 'Deliver') {
            document.getElementById("totalspan").innerHTML = "$";
            document.getElementById("butspan").innerHTML = "$";
            document.getElementById("delspan").innerHTML = "$";
        }
        else if (y == 'Pickup') {
            document.getElementById("content").innerHTML = "$";
            document.getElementById("delspan").innerHTML = "$";
        }
    }
      

     
    