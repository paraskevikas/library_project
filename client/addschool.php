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
                
</div>
       
<br/>
<br/>


          <div class="main-content2">
          <form class="form-horizontal" name="form" method="POST">
            <label class = "form-label">
            <p> School Name </p>
            </label>   
          <input type="text", placeholder="Enter School Name", name="school_name">

          <label class = "form-label">
            <p> Phone </p>
            </label>   
          <input type="text", placeholder="Enter Phone", name="phone">
                
          <label class = "form-label">
            <p> Email </p>
            </label>   
           <input type="text", placeholder="e.g. school@mail.com", name="email">
                
         
  <br/>
  <br/>
           
  <button class="button button3" type="submit" name="submit_creds">Submit</button>
  <!--<button class="button button3" formaction="home.php">Back</button>-->

            </form>
        </div>
        <div class="container1">
            <?php
                include 'connection.php';
                $conn = OpenCon();
                if(isset($_POST['submit_creds'])){
                    $school_name = $_POST['school_name'];
                    $phone = $_POST['phone'];
                    $email = $_POST['email'];
                
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        echo '<hr>Invalid email format, please try again';
                    }
                    else{
                        $query = "INSERT INTO schools (school_name, phone, email)
                                VALUES ('$school_name', '$phone', '$email')";
                        if (mysqli_query($conn, $query)) {
                            echo "New record created successfully";
                            header("Location: ./sadmin.php");
                            exit();
                        }
                        else{
                            echo "Error while creating record: <br>" . mysqli_error($conn) . "<br>";
                        }
                    }
                }
                
            ?>
        </div>
    </div>
    </div>

            </div>
</body>

</html>