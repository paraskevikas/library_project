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
<header>
          
            </header>

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
    <p> Complete the following form</p>
    </label>    

  <input type="text", placeholder="Enter First Name", name="first_name">
  <input type="text", placeholder="Enter Last Name", name="last_name">
  <input type="text", placeholder="Enter Days", name="days">

  <br/>
  <br/>
 
  <button class="button button3" type="submit" name="submit_creds">Search</button>


   </form>

<br/>
<br/>
       
    <div class="container">
        <div class="row" id="row">
            <div class="col-md-12">
                <div class="card" id="card-container">
                    <div class="card-body" id="card">
                        <?php
                        include 'connection.php';
                        $conn = OpenCon();                   

                        $user_data['school_id']=$_SESSION['school_id'];
                        $school_id=$user_data['school_id'];

                        if(isset($_POST['submit_creds'])){
                            $first_name = $_POST['first_name'];
                            $last_name = $_POST['last_name'];
                            $days = $_POST['days'];
                            
                            /* new code */
                        if(empty($_POST['days'])){ 
                        $query =  "SELECT  a.card_id, first_name, last_name, ISBN, b_date, r_date, DATEDIFF(CURRENT_DATE, r_date), COUNT(a.card_id)
                        FROM borrows a, members b
                        WHERE returned=0 AND a.card_id=b.card_id AND CURRENT_DATE>r_date AND (first_name like '%$first_name%' and last_name like '%$last_name%') and school_id='$school_id' 
                        GROUP BY a.card_id, ISBN
                        HAVING COUNT(a.card_id)>0
                        ORDER BY last_name";
                        }
                        else{

                            $query =  "SELECT  a.card_id, first_name, last_name, ISBN, b_date, r_date, DATEDIFF(CURRENT_DATE, r_date), COUNT(a.card_id)
                            FROM borrows a, members b
                            WHERE returned=0 AND a.card_id=b.card_id AND CURRENT_DATE-b_date>7 AND (first_name like '%$first_name%' and last_name like '%$last_name%' and DATEDIFF(CURRENT_DATE, r_date)='$days') and school_id='$school_id' 
                            GROUP BY a.card_id, ISBN
                            HAVING COUNT(a.card_id)>0
                            ORDER BY last_name";

                        }   
                        
                        /* end of new code */

                        $result = mysqli_query($conn, $query);
                    
                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No results found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>Card_id</th>';
                                            echo '<th>First Name</th>';
                                            echo '<th>Last Name</th>';
                                            echo '<th>ISBN</th>';
                                            /* new code*/
                                            echo '<th>Borrowed on</th>';
                                            echo '<th>Should be returned on</th>';
                                            echo '<th>Days delayed</th>';
                                            /*end of new code*/
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while($row = mysqli_fetch_row($result)){
                                        echo '<tr>';
                                            echo '<td>' . $row[0] . '</td>';
                                            echo '<td>' . $row[1] . '</td>';
                                            echo '<td>' . $row[2] . '</td>';
                                            echo '<td>' . $row[3] . '</td>';
                                            echo '<td>' . $row[4] . '</td>';
                                            /* new code*/
                                            echo '<td>' . $row[5] . '</td>';
                                            echo '<td>' . $row[6] . '</td>';
                                            /*end of new code*/
                                        echo '</tr>';
                                    }
                                    echo '</tbody>';
                                echo '</table>';
                            echo '</div>';
                        }
                        
                    }
                        ?>          
                    </div>
                </div>
            </div>
        </div>
    </div>

    
                    </div>
</body>

</html>