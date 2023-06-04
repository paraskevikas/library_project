 <?php

function OpenCon(){
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, "library") or die("Connect failed: %s\n". $conn -> error);
      
//echo "Connected successfully";
return $conn;


}


//echo "Connected";

function CloseCon($conn){
    $conn -> close();
 }  

 function validateDate($date)
{
  return strtotime($date) !== false;
}

?> 