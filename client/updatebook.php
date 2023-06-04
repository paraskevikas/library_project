<?php 
session_start();
?>

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
                            $user_data['school_id']=$_SESSION['school_id'] ;                                          
                            $school_id = $user_data['school_id'];
                            $ISBN = $_GET['ISBN'];
                            $query = "SELECT ISBN, title, lang, page_number, publisher FROM books WHERE ISBN = $ISBN";
                            $res1 = mysqli_query($conn, $query);
                            $row = mysqli_fetch_row($res1);
            
                            echo '<div class="form-group col-sm-3 mb-3">';
                                echo '<label class = "form-label"> <p>Change information for book: <br><b>' . $row[0] . ' ' . $row[1] . '</b></p></label>';
                                
                            echo '<hr></div>';
                        
                            
                            
                        ?>

                        <form class="form-horizontal" name="student-form" method="POST">

          
                        <label class = "form-label">
                           <p>Enter New ISBN</p>
                        </label>
                        <input type="text", name="ISBN", placeholder="ISBN">

                        <label class = "form-label">
                          <p>Enter New Title</p>
                        </label>
                        <input type="text", name="title", placeholder="Title">

                        <label class = "form-label">
                          <p>Enter New Language</p>
                        </label>
                        <input type="text", name="lang", placeholder="Language">

                        <label class = "form-label">
                           <p>Enter New Number of Pages</p>
                        </label>
                        <input type="text", name="page_number", placeholder="Number of Pages">

                        <label class = "form-label">
                       <p>Enter New Publisher</p>
                        </label>
                        <input type="text", name="publisher", placeholder="Publisher">





                        <!--
                        <label class = "form-label">
                          <p>Enter New Author First Name</p>
                        </label>
                        <input type="text", name="first_name", placeholder="First Name">

                        <label class = "form-label">
                          <p>Enter New Author Last Name</p>
                        </label>
                        <input type="text", name="last_name", placeholder="Last Name">

                        <label class = "form-label">
                           <p>Enter New Number of Available Copies</p>
                        </label>
                        <input type="text", name="available_copies", placeholder="Number of Available Copies">

                        <label class = "form-label">
                       <p>Enter New  Category</p>
                        </label>
                        <select id="category" name="category">
                        <option value="">Select New Category</option>
                        <option value="Art">Art</option>
                        <option value="Biography">Biography</option>
                        <option value="Cooking">Cooking</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Fiction">Fiction</option>
                        <option value="History">History</option>
                        <option value="Humor">Humor</option>
                        <option value="Mystery">Mystery</option>
                        <option value="Non-fiction">Non-fiction</option>
                        <option value="Religion">Religion</option>
                        <option value="Romance">Romance</option>
                        <option value="Science fiction">Science fiction</option>
                        <option value="Self-help">Self-help</option>
                        <option value="Travel">Travel</option>
                        <option value="Young adult">Young adult</option>
                        </select>

-->
                        </br></br>


                  
                        <button class="button" class = "btn btn-primary btn-submit-custom" type = "submit" name="submit_upd">Submit</button>
                        <button class="button" class = "btn btn-primary btn-submit-custom" formaction="admin.php">Back</button>
    
                        </form>
  
                    <div class="form-group col-sm-3 mb-3">
                        <?php
                        
                            if(isset($_POST['submit_upd'])){
                                        
                                $ISBN_new = $_POST['ISBN'];
                                $title = $_POST['title'];
                                $lang = $_POST['lang'];
                                $page_number = $_POST['page_number'];
                                $publisher = $_POST['publisher'];



                                /*
                                $first_name = $_POST['first_name'];
                                $last_name = $_POST['last_name'];
                                $category_name = $_POST['category_name'];*/
            /*
                                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                                    echo '<hr>Invalid email format, please try again';
                                }
                                else{

                                    */

                                    $query = "UPDATE books 
                                            SET ISBN = '$ISBN_new', title = '$title', lang = '$lang', page_number = '$page_number', publisher = '$publisher'
                                            WHERE ISBN = $ISBN";
                                    if (mysqli_query($conn, $query)) {
                                        echo "Record updated successfully";
                                        header("Location: ./admin.php");
                                        exit();
                                    }
                                    else{
                                        echo "Error while updating record: <br>" . mysqli_error($conn) . "<br>";
                                    }
                                }
                                
                            //}
                            
                        ?>
                    </div>

                    </div>
                </div>
                </div>
            
            
                
            </body>
            
            </html>