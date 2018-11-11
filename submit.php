
<html>
 <head>
  <title>Receipt</title>
  <link rel="stylesheet" href="style.css">
 </head>
 <body>
   <div class="receipt">
     <div class="receiptHeader">
       <a id="storeName">Beverly's Fruit Store</a><br>
       <a>Receipt</a><br>
       <a>Customer:</a>
       <a>
         <!-- get and print customer's name -->
         <?php
         echo $_GET["name_input"];
         ?>
       </a>
     </div>

     <div class="receiptBody">
       <!-- uses table element to display orders and costs -->
       <table>
         <tr>
           <th class="firstCol">Item</th>
           <th class="secondCol">Quantity</th>
           <th class="thirdCol">Cost</th>
         </tr>
         <?php
         // gets order quantities
          $numApples = $_GET["apple_input"];
          $numOranges = $_GET["orange_input"];
          $numBananas = $_GET["banana_input"];

          if ($numApples > 0) {
            $costApples = $numApples * 0.69;
            // creates row if apples have been ordered
            echo "<tr>
                    <td>Apples</th>
                    <td>$numApples</th>
                    <td>$$costApples</th>
                  </tr>";
          } else {
            // if field is empty, take it as no apples ordered
            $costApples = 0;
            $numApples = 0;
          }
          if ($numOranges > 0) {
            $costOranges = $numOranges * 0.59;
            // creates row if oranges have been ordered
            echo "<tr>
                    <td>Oranges</th>
                    <td>$numOranges</th>
                    <td>$$costOranges</th>
                  </tr>";
          } else {
            // if field is empty, take it as no oranges ordered
            $costOranges = 0;
            $numOranges = 0;
          }
          if ($numBananas > 0) {
            $costBananas = $numBananas * 0.39;
            // creates row if bananas have been ordered
            echo "<tr>
                    <td>Bananas</th>
                    <td>$numBananas</th>
                    <td>$$costBananas</th>
                  </tr>";
          } else {
            // if field is empty, take it as no apples ordered
            $costBananas = 0;
            $numBananas = 0;
          }
          // calculates total cost of whole order
          $totalCost = $costApples + $costOranges + $costBananas;
          // store user's order, array used to facilitate for loop later
          $total_orders = array($numApples,$numOranges,$numBananas);

          // if file exists (ie. if there have been previous orders),
          // read file and add quantities to those in the "total_orders" array
          if (file_exists("order.txt")){
            // file to read
            $readfile = fopen("order.txt", "r") or die ("Unable to open!");
            for ($i = 0; $i < 3; $i++){
              // read line by line, get only the digits, add to user's order
              $total_orders[$i] += (int)preg_replace("/[^0-9]/",'',fgets($readfile));
            }
            fclose($readfile);
          }

          // file to write
          $writefile = fopen("order.txt", "w");
          $lines = array("Total number of apples: ", "Total number of oranges: ", "Total number of bananas: ");
          for ($i = 0; $i < 3; $i++){
            // write new file with updated quantities, concatenate with newline "\n"
            fwrite($writefile, ($lines[$i] . $total_orders[$i] . "\n"));
          }
          fclose($writefile);

         ?>
         <tr>
           <td></td>
         </tr>
         <tr>
           <th class="firstCol" id="totalLabel">Total</th>
           <td class="secondCol"></th>
           <th class="thirdCol" id="totalPrice">$<?php echo number_format($totalCost,2); ?>
           </th>
         </tr>
       </table>

       <br>
       <br>
       <a>Payment Method: </a>
       <a id="paymentMethod">
         <?php
         echo $_GET["payment_choice"];
         ?>
       </a>
       <br><br><br>
       <a class="footer">Thanks for buying our fruits!</a>
     </div>


   </div>
 </body>
</html>
