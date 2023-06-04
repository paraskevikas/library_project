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

<body>




<div class="main-content2">
    <form class="form-horizontal" name="form" method="POST">
    <label class = "form-label">
    <p> Enter Year and Select Month </p>
    </label>    
   
  <input type="text", placeholder="Enter Year", name="year">

  <select id="month" name="month">
  <option value="0">Select Month</option>
  <option value="1">January</option>
  <option value="2">February</option>
  <option value="3">March</option>
  <option value="4">April</option>
  <option value="5">May</option>
  <option value="6">June</option>
  <option value="7">July</option>
  <option value="8">August</option>
  <option value="9">September</option>
  <option value="10">October</option>
  <option value="11">November</option>
  <option value="12">December</option>
  </select>

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

                        if(isset($_POST['submit_creds'])){
                            $year = $_POST['year'];
                            $month = $_POST['month'];
 
                        if(empty($_POST['year']) && !empty($_POST['month'])){ 
                        $query =  "SELECT school_name, COUNT(*)
                        FROM borrows as a, members as b, schools as c
                        WHERE a.card_id=b.card_id AND c.school_id=b.school_id AND  month(b_date)='$month'
                        GROUP BY school_name";
                        }
                        else if(empty($_POST['month']) && !empty($_POST['year'])){ 
                            $query =  "SELECT school_name, COUNT(*)
                            FROM borrows as a, members as b, schools as c
                            WHERE a.card_id=b.card_id AND c.school_id=b.school_id AND year(b_date)='$year'
                            GROUP BY school_name";
                            }
                            else if(!empty($_POST['month']) && !empty($_POST['year'])){

                                $query =  "SELECT school_name, COUNT(*)
                                FROM borrows as a, members as b, schools as c
                                WHERE a.card_id=b.card_id AND c.school_id=b.school_id AND year(b_date)='$year'AND  month(b_date)='$month'
                                GROUP BY school_name";

                            }

                            else {
                                $query =  "SELECT school_name, COUNT(*)
                                FROM borrows as a, members as b, schools as c
                                WHERE a.card_id=b.card_id AND c.school_id=b.school_id 
                                GROUP BY school_name";

                          }

                        


                        $result = mysqli_query($conn, $query);
                    
                        if(mysqli_num_rows($result) == 0){
                            echo '<h1 style="margin-top: 5rem;">No results found!</h1>';
                        }
                        else{

                            echo '<div class="table-responsive">';
                                echo '<table class="table">';
                                    echo '<thead>';
                                        echo '<tr>';
                                            echo '<th>School Name</th>';
                                            echo '<th>Count</th>';
                                        echo '</tr>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    while($row = mysqli_fetch_row($result)){
                                        echo '<tr>';
                                            echo '<td>' . $row[0] . '</td>';
                                            echo '<td>' . $row[1] . '</td>';
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