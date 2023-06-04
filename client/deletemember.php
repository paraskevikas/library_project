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



        <form class="form-horizontal" name="student-form" method="POST">



                    <?php
                
                            include 'connection.php';
                            $conn = OpenCon();
                            $card_id = $_GET['card_id'];
                            $query = "SELECT first_name, last_name, username, passcode, birthday, phone, email FROM members WHERE card_id = $card_id";
                            $res1 = mysqli_query($conn, $query);
                            $row = mysqli_fetch_row($res1);
            
                            echo '<div class="form-group col-sm-3 mb-3">';
                                echo '<label class = "form-label"> <p>Are you sure you want to delete user: <br><b>' . $row[0] . ' ' . $row[1] . '?</b></p></label>';
                                
                            echo '<hr></div>';
                        
                            
                            
                        ?>

                       
  
                    <div class="form-group col-sm-3 mb-3">
                        <?php


if(isset($_POST['submit_del'])){
                    
    $query = "DELETE FROM members
            WHERE card_id = $card_id";
    if (mysqli_query($conn, $query)) {
        //echo "Record updated successfully";
        header("Location: ./admin.php");
        exit();
    }
    else{
        echo "Error while deleting record: <br>" . mysqli_error($conn) . "<br>";
    }
}
                        
                            
                        ?>
                    </div>

                <button class="button" class = "btn btn-primary btn-submit-custom" type = "submit" name="submit_del">Delete</button>
                <button class="button" class = "btn btn-primary btn-submit-custom" formaction="admin.php">Back</button>
</form>
                    </div>
                </div>
                </div>
            
            
                
            </body>
            
            </html>