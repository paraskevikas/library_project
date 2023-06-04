<!DOCTYPE html>
<html>
    <head>
	       <title lang='gr'>Βιβλιοθήκη ΕΜΠ - Βάση Δεδομένων</title>
           <link rel='icon' href='prometheus.png' type='image/png'/>
           <meta name='viewport' content='width=device-width, initial-scale=1.0'></meta>
           <meta name='author' content='Κωνσταντίνα Παπία, Παρασκευή Κασιούμη'></meta>
           <meta charset="UTF-8"></meta>
           <link rel='stylesheet' href='common.css'></link>
       </head>
       <body>
        

           <div class="navbar">
            <a class="navbar-brand" href="home.php">
                <div class="logo-image">
                      <img src="prometheus.png" class="img-fluid" alt="Βιβλιοθήκη ΕΜΠ" style="width:35px;height:35px;">
                </div>
            </a>
            <a href="home.php">Αρχική Σελίδα</a>
            <a href="about.html">Σχετικά Με</a>
            <div class="login-container">
                <form method= "post">
                  <input type="text" placeholder="Username" name="username">
                  <input type="password" placeholder="Password" name="password">
                  <button type="submit" name="submit">Login</button>
                </form>
              </div>
          </div>
       
           <br/>
           <br/>


<!--login-->
<?php

session_start();
include("connection.php");
$conn = OpenCon();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
  //something was posted
  $username = $_POST['username'];


  // echo "$username";

  $password = $_POST['password'];

  //echo $username, 00000000;


  if (!empty($username) && !empty($password)) {

    //read from database
    //members
    $query = "select * from members where username = '$username'";
    $result = mysqli_query($conn, $query);
    //echo $username, 1111111;


    if ($result) {

      if ($result && mysqli_num_rows($result) > 0) {

        //echo $username, 22222222;

        $user_data = mysqli_fetch_assoc($result);

        if ($user_data['active'] == 0)
          echo 'your account has been deactivated!';

        else {

          //  echo " password $password";

          if ($user_data['passcode'] == $password) {

            $_SESSION['card_id'] = $user_data['card_id'];
            $_SESSION['username'] = $user_data['username'];
            $_SESSION['teacher'] = $user_data['teacher'];
            $_SESSION['school_id'] = $user_data['school_id'];


            if ($user_data['teacher'] == 0) {
              header("Location: student.php");
            } else {
              header("Location: teacher.php");
            }
            die;
          } else echo "wrong password!";
        }
      } // end members


      else {

        //echo $username, 333333;


        $query = "select * from administrators where username = '$username'";
        $result = mysqli_query($conn, $query);

        if ($result) {
          if ($result && mysqli_num_rows($result) > 0) {
            //echo $username, 4444444;


            $user_data = mysqli_fetch_assoc($result);

            if ($user_data['passcode'] === $password) {

              $_SESSION['admin_id'] = $user_data['admin_id'];
              $_SESSION['school_id'] = $user_data['school_id'];
              header("Location: admin.php");
              die;
            } else echo "wrong password!";
          } // end admins


          else {
            $query = "select * from super_admin where username = '$username'";
            $result = mysqli_query($conn, $query);

            if ($result) {
              if ($result && mysqli_num_rows($result) > 0) {

                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['passcode'] === $password) {

                  $_SESSION['super_admin_id'] = $user_data['super_admin_id'];
                  header("Location: sadmin.php");
                  die;
                } else echo "wrong password!";
              } else echo "wrong username!";
            }
          } // end superadmin

        }
      }
    }
  }
}

?>

           <div class="main-content">
               <div id='welcome'>
                   <h1 style="text-align: center;">Καλώς Ήρθατε στις Βιβλιοθήκες των Δημόσιων Σχολείων</h1>
               </div>

              <br/>
              <br/><br/><br/><br/><br/><br/>
              <br/><br/><br/>

                <div class="container">
                <div class="centered">
                <h2  style="text-align: center;" >Για να κάνετε αίτηση εγγραφής, πατήστε εδώ </h2>
                <a href="CreateUser.php" class="button" onclick="window.location.replace('connect.php');">Start</a>
                <h2  style="text-align: center;" >Για να κάνετε αίτηση εγγραφής ως Υπεύθυνος Χειριστής Σχολικής Μονάδας, πατήστε εδώ </h2>
                <a href="CreateAdmin.php" class="button" onclick="window.location.replace('connect.php');">Start</a>
            </div>
              </div>
            
              <br/><br/><br/><br/><br/>
              <br/><br/><br/><br/><br/><br/>
              <br/><br/><br/>

            <div style="text-align: right;" class='text'>ΗΜΜΥ ΕΜΠ, Εαρινό Εξάμηνο 2023</div>
			   <div style="text-align: right;" class='text'>Βάση Δεδομένων, σχεδιασμένη ως εργασία για το μάθημα Βάσεων Δεδομένων της σχολής ΗΜΜΥ</div>
           </div>
       </body>
</html>













