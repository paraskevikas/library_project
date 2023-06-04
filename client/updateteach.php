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
                            $card_id = $_GET['card_id'];
                            $query = "SELECT first_name, last_name, username, passcode, birthday, phone, email FROM members WHERE card_id = $card_id";
                            $res1 = mysqli_query($conn, $query);
                            $row = mysqli_fetch_row($res1);
            
                            echo '<div class="form-group col-sm-3 mb-3">';
                                echo '<label class = "form-label"> <p>Change information for user: <br><b>' . $row[0] . ' ' . $row[1] . '</b></p></label>';
                                
                            echo '<hr></div>';
                        
                            
                            
                        ?>

                        <form class="form-horizontal" name="student-form" method="POST">

          
                        <label class = "form-label">
                           <p>Enter New First Name</p>
                        </label>
                        <input type="text", name="first_name", placeholder="First Name">

                        <label class = "form-label">
                          <p>Enter New Last Name</p>
                        </label>
                        <input type="text", name="last_name", placeholder="Last Name">

                        <label class = "form-label">
                           <p>Enter New Password</p>
                        </label>
                        <input type="text", name="passcode", placeholder="Password">

                        <label class = "form-label">
                       <p>Enter New Birthday</p>
                        </label>
                        <input type="text", name="birthday", placeholder="Birthday">

                        <label class = "form-label">
                       <p>Enter New Phone Number</p>
                        </label>
                        <input type="text", name="phone", placeholder="Phone">

                        <label class = "form-label">
                          <p>Enter New Email Address</p>
                        </label>
                        <input type="text", name="email", placeholder="Email">  
                        
                        </br></br>


                  
                        <button class="button" class = "btn btn-primary btn-submit-custom" type = "submit" name="submit_upd">Submit</button>
                        <button class="button" class = "btn btn-primary btn-submit-custom" formaction="teacher.php">Back</button>
    
                        </form>
  
                    <div class="form-group col-sm-3 mb-3">
                        <?php


                        
                            if(isset($_POST['submit_upd'])){
                                        
                                $first_name = $_POST['first_name'];
                                $last_name = $_POST['last_name'];
                                $passcode = $_POST['passcode'];
                                $birthday = $_POST['birthday'];
                                $phone = $_POST['phone'];
                                $email = $_POST['email'];
            
                                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                    echo '<hr>Invalid email format, please try again';
                                }
                                else if(empty($first_name) || empty($last_name) || empty($passcode) || !validateDate($birthday) || empty($phone)) 
                                    echo '<hr>No valid information!';
                                else {
                                    try {
                                    $query = "UPDATE members 
                                            SET first_name = '$first_name', last_name = '$last_name', passcode = '$passcode', birthday = '$birthday', phone = '$phone',email = '$email'
                                            WHERE card_id = $card_id";
                                    if (mysqli_query($conn, $query)) {
                                        echo "Record updated successfully";
                                        header("Location: teacher.php");
                                        exit();
                                    }
                                    else{
                                        echo "Error while updating record: <br>" . mysqli_error($conn) . "<br>";
                                    }
                                } catch (exception $e) {
                                    echo '<p>' . $e->getMessage() . '</p>';
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