<?php

  function submit(){
    // error_reporting(0);
    //   echo "Function called";
      $data = array(
         "username" => $username = $_POST['username'],
        "password" =>  $password = $_POST['password']
      );
      
    //   echo "Welcome $username";
    //   echo $password;
  
          $jsonobj = json_encode($data);
        //   echo $jsonobj;
  $url = 'http://ec2-54-175-10-42.compute-1.amazonaws.com:3000/participant/login';
//   echo "API CALLED";
  $ch = curl_init($url);

  # Form data string
//   $postString = http_build_query($jsonobj, 'json', '&');
  # Setting our options

//   curl_setopt($ch, CURLOPT_POST, 1);
  
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonobj);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FAILONERROR, true);
  

 
  # Get the response
  $response = curl_exec($ch);

  if(curl_exec($ch) === false)
  {
      echo 'Curl error: ' . curl_error($ch);
  }
  else
  {
      echo 'Operation completed without any errors';
  }
//   if (curl_exec($ch) === false) {
//     echo "ok";
// } else {
//     echo "error";
// }
  
  $result = json_decode($response);
//   print_r($result);
//   ($result->Name);
  $name = $result->data[0]->Name;
//   echo $name;

// if(isset($_POST['username']))
// {
//  $text=$_POST['username'];

//  echo "<img alt='testing' src='barcode.php?codetype=Code39&size=&text=".$text."&print=true'/>";
 
//   }

if($result->result == 'true')
{
  echo "<h3 class = 'h3-responsive mt-5 pt-5 white-text text-center'> Welcome $name </h3>";
 



  echo"<div class = 'container'>";
  echo "<div class = 'row'>";
      echo "<div class = 'col-md-4'>";
echo"</div>";
               echo" <div class = 'col-md-4'>";
               echo "<div class = 'ticket text-center mt-3'>";
               echo "<h4 class = 'h4-responsive text-center mt-3 pt-3' style = 'font-family : batmanforeveralternate;'> Vishwapreneur'20</h3>";
               echo "<h5 class style = 'font-family : batmanforeveralternate; font-size:0.95rem;'> Explore the Unexplored!</h4>";
               echo" <div class = 'row mt-5'>";
               
              
               echo" <div class = 'col-xs-6 mt-4 text-center ml-4'>";
                $amountpaid = $result->data[0]->Paid_Amt;
                echo"<p class = 'space'>Amount paid : <span>&#8377;</span>$amountpaid</p>";
                $amountrem = $result->data[0]->Rem_Amt;
                if($amountrem == '0')
                echo"<p class = 'space'>Amount Rem : <span>&#8377;</span>$amountrem</p>";
                else
                echo"<p class = 'space style'>Amount Rem : <span>&#8377;</span>$amountrem</p>";
                echo "</div>";
                echo" <div class = 'col-xs-6  text-center ml-4'>";
                $passtype =  $result->data[0]->Pass_Type;
            if($passtype=="VIP")
            {
                echo"<img src= img/VIP.png text-center regular' alt=''>";
            }  
            else
            {
            echo"<img src= img/regular.png text-center regular' alt=''>";         
            }
               echo "</div>";
echo"</div>";
$statusD1 =  $result->data[0]->D1_Visited;

$statusD2 =  $result->data[0]->D2_Visited;
echo "<div class = 'row'>";
echo "<div class = 'col-sm-12  mt-4 text-center'>";
if($statusD1 == '1'||$statusD2 == '1' )
echo "<p class = 'mt-2'> Status:Reported</p>";
else
echo "<p class = 'mt-2'> Status: NOT Reported</p>";
echo "</div>";



echo "</div>";

echo "<div class = 'container'>";
echo "<div class = 'row'>";

echo "<div class = 'col-sm-12 text-center'>";
echo"<div class = 'barcode  text-center'>";
              
                $text = $result->data[0]->Username;
           
                echo "<img alt='barcode' class = 'barcodec pt-3 text-center' src='barcode.php?codetype=Code128&size=50&orientation=horizontal&sizefactor=1.5&text=$text&print=true'/>";
                
                 
                 echo "</div>";
        }
        else 
        {
            echo "
            <br>
            <br>
            <br>";
            $error = $result->message;
            echo "<h2 class = 'text-center white-text'> $error</h2>";
        }
echo "</div>";

echo"</div>";
echo "</div>";

        curl_close($ch); 
}
submit();
      
        ?>
</div>
<div class = "col-md-4">
</div>
                </div>
         
            </div>
      

          
               
            </div>
            
           
            </div>
            <!-- Add Pagination -->
 
        <!--Carousal Script-->
      
    </div>
</body>

</html>
