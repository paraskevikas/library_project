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
                    <?php

                            include 'connection.php';
                            $conn = OpenCon();
                            $school_id = $_GET['school_id'];
                            $query = "SELECT school_id, school_name, phone, email FROM schools WHERE school_id = $school_id";
                            $res1 = mysqli_query($conn, $query);
                            $row = mysqli_fetch_row($res1);
            
                            echo '<div class="form-group col-sm-3 mb-3">';
                                echo '<label class = "form-label"> <p>Change information for school: <br><b>' . $row[0] . ' ' . $row[1] . '</b></p></label>';
                                
                            echo '<hr></div>';
                        
                            
                            
                        ?>

                        <form class="form-horizontal" name="school-form" method="POST">

          
                        <label class = "form-label">
                           <p>Enter New School Name</p>
                        </label>
                        <input type="text", name="school_name", placeholder="School Name">

                        <label class = "form-label">
                          <p>Enter New Phone</p>
                        </label>
                        <input type="text", name="phone", placeholder="Phone">

                        <label class = "form-label">
                          <p>Enter New Email</p>
                        </label>
                        <input type="text", name="email", placeholder="Email">

                        
                        </br></br>


                  
                        <button class="button" class = "btn btn-primary btn-submit-custom" type = "submit" name="submit_upd">Submit</button>
                        <button class="button" class = "btn btn-primary btn-submit-custom" formaction="sadmin.php">Back</button>
    
                        </form>
  
                    <div class="form-group col-sm-3 mb-3">
                        <?php
                        
                            if(isset($_POST['submit_upd'])){
                                        
                                $school_name = $_POST['school_name'];
                                $phone = $_POST['phone'];
                                $email = $_POST['email'];
            
                                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                    echo '<hr>Invalid email format, please try again';
                                }
                                else{
                                    $query = "UPDATE schools 
                                            SET school_name = '$school_name', phone = '$phone', email = '$email'
                                            WHERE school_id = $school_id";
                                    if (mysqli_query($conn, $query)) {
                                        echo "Record updated successfully";
                                        header("Location: ./sadmin.php");
                                        exit();
                                    }
                                    else{
                                        echo "Error while updating record: <br>" . mysqli_error($conn) . "<br>";
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