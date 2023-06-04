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
                            $request_id = $_GET['request_id'];
                            $query = "SELECT first_name, last_name, username, passcode, birthday, phone, email, stat FROM membership_applicant WHERE request_id = $request_id";
                            $res1 = mysqli_query($conn, $query);
                            $row = mysqli_fetch_row($res1);
            
                            echo '<div class="form-group col-sm-3 mb-3">';
                                echo '<label class = "form-label"> <p>Change status for user: <br><b>' . $row[0] . ' ' . $row[1] .  '</b></p></label>';
                                
                            echo '<hr></div>';
                        
                            
                            
                        ?>

                        <form class="form-horizontal" name="status-form" method="POST">

                        <label class = "form-label">
                           <p>Select New Status</p>
                        </label>
            <select id="status" name="stat">
            <option value="">Status</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
            </select>
                        </br></br>


                  
                        <button class="button" class = "btn btn-primary btn-submit-custom" type = "submit" name="submit_upd">Submit</button>
                        <button class="button" class = "btn btn-primary btn-submit-custom" formaction="admin.php">Back</button>
    
                        </form>
  
                    <div class="form-group col-sm-3 mb-3">
                        <?php
                        
                            if(isset($_POST['submit_upd'])){
                                        
                                
                                $stat = $_POST['stat'];
                                
                                    $query = "UPDATE membership_applicant 
                                            SET stat = '$stat'
                                            WHERE request_id = $request_id";
                                    if (mysqli_query($conn, $query)) {
                                        echo "Record updated successfully";
                                        header("Location: ./admin.php");
                                        exit();
                                    }
                                    else{
                                        echo "Error while updating record: <br>" . mysqli_error($conn) . "<br>";
                                    }
                                
                                
                            }
                            
                        ?>
                    </div>

                    </div>
                </div>
                </div>
            
            
                
            </body>
            
            </html>