<?php
session_start();

include("connection.php");
$conn = OpenCon();
?>

<!DOCTYPE html>
<html>

<head>
    <title lang='gr'>Βιβλιοθήκη ΕΜΠ - Βάση Δεδομένων</title>
    <link rel='icon' href='prometheus.png' type='image/png' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    </meta>
    <meta name='author' content='Κωνσταντίνα Παπία, Παρασκευή Κασιούμη'>
    </meta>
    <meta charset="UTF-8">
    </meta>
    <link rel='stylesheet' href='common.css'>
    </link>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


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

    <br />
    <br />



    <div class="main-content2">


<div class='text' style='text-align: center;'>
<hr style="height:1px;color:#333;background-color:#333;">
<h3>Schools</h3>
<hr style="height:1px;color:#333;background-color:#333;">
</div>

<br /><br />


<a type="button" class="button" href="./addschool.php">
<i class="fa fa-plus"></i>
Add New School
</a>

<div class="container">
<div class="row" id="row">
    <div class="col-md-12">
        <div class="card" id="card-container">
            <div class="card-body" id="card">
                <?php

$query = "SELECT school_id, school_name, phone, email FROM schools ORDER BY school_id";


$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo '<h1 style="margin-top: 5rem;">No schools found!</h1>';
} else {

    echo '<div class="table-responsive">';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>School ID</th>';
    echo '<th>School Name</th>';
    echo '<th>Phone</th>';
    echo '<th>Email</th>';
    echo '<th></th>';
    echo '<th></th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_row($result)) {
        echo '<tr>';
        echo '<td>' . $row[0] . '</td>';
        echo '<td>' . $row[1] . '</td>';
        echo '<td>' . $row[2] . '</td>';
        echo '<td>' . $row[3] . '</td>';
        echo '<td>';
        echo '<a type="button" class="button" href="./updateschool.php?school_id=' . $row[0] . '">';
        echo '<i class="fa fa-edit"></i>';
        echo '</a>';
        echo '</td>';

        echo '<td>';
        echo '<a type="button" class="button" href="./deleteschool.php?school_id=' . $row[0] . '">';
        echo '<i class="fa fa-trash"></i>';
        echo '</a>';
        echo '</td>';

        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
} ?>
</div>
</div>
</div>
</div>
</div>

<br /><br /><br /><br /><br />

<div class='text' style='text-align: center;'>
<hr style="height:1px;color:#333;background-color:#333;">
<h3>School Addresses</h3>
<hr style="height:1px;color:#333;background-color:#333;">
</div>

<a type="button" class="button" href="./addaddress.php">
<i class="fa fa-plus"></i>
Add New Address
</a>

<div class="container">
<div class="row" id="row">
<div class="col-md-12">
<div class="card" id="card-container">
<div class="card-body" id="card">
<?php

$query = "SELECT a.school_id, s.school_name, a.street_name, a.street_number, a.postal_code, a.city
FROM addresses a
INNER JOIN schools s ON a.school_id = s.school_id
ORDER BY s.school_id";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0)
    echo '<h1 style="margin-top: 5rem;">No principals found!</h1>';
else {

    echo '<div class="table-responsive">';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>School ID</th>';
    echo '<th>School Name</th>';
    echo '<th>Street Name</th>';
    echo '<th>Street Number</th>';
    echo '<th>Postal Code</th>';
    echo '<th>City</th>';
    echo '<th>Update</th>';
    echo '<th>Delete</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_row($result)) {
        echo '<tr>';
        echo '<td>' . $row[0] . '</td>';
        echo '<td>' . $row[1] . '</td>';
        echo '<td>' . $row[2] . '</td>';
        echo '<td>' . $row[3] . '</td>';
        echo '<td>' . $row[4] . '</td>';
        echo '<td>' . $row[5] . '</td>';
        echo '<td>';

        echo '<a type="button" class="button" href="./updateaddr.php?school_id=' . $row[0] . '">';
        echo '<i class="fa fa-edit"></i>';
        echo '</a>';
        echo '</td>';

        echo '<td>';
        echo '<a type="button" class="button" href="./deleteaddr.php?school_id=' . $row[0] . '">';
        echo '<i class="fa fa-trash"></i>';
        echo '</a>';
        echo '</td>';


        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}

?>

</div>
</div>
</div>
</div>

</div>

<br /><br /><br /><br /><br />


<div class='text' style='text-align: center;'>
<hr style="height:1px;color:#333;background-color:#333;">
<h3>School Principals</h3>
<hr style="height:1px;color:#333;background-color:#333;">
</div>

<a type="button" class="button" href="./addprincipal.php">
<i class="fa fa-plus"></i>
Add New Principal
</a>

<br />

<div class="container">
<div class="row" id="row">
<div class="col-md-12">
<div class="card" id="card-container">
<div class="card-body" id="card">
<?php

$query = "SELECT p.principal_id, p.first_name, p.last_name, p.school_id, s.school_name
FROM principals p
INNER JOIN schools s ON p.school_id = s.school_id
ORDER BY p.school_id";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0)
    echo '<h1 style="margin-top: 5rem;">No principals found!</h1>';
else {

    echo '<div class="table-responsive">';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Principal ID</th>';
    echo '<th>First Name</th>';
    echo '<th>Last Name</th>';
    echo '<th>School ID</th>';
    echo '<th>School Name</th>';
    echo '<th>Update</th>';
    echo '<th>Delete</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_row($result)) {
        echo '<tr>';
        echo '<td>' . $row[0] . '</td>';
        echo '<td>' . $row[1] . '</td>';
        echo '<td>' . $row[2] . '</td>';
        echo '<td>' . $row[3] . '</td>';
        echo '<td>' . $row[4] . '</td>';
        echo '<td>';

        echo '<a type="button" class="button" href="./updateprinc.php?principal_id=' . $row[0] . '">';
        echo '<i class="fa fa-edit"></i>';
        echo '</a>';
        echo '</td>';

        echo '<td>';
        echo '<a type="button" class="button" href="./deleteprinc.php?principal_id=' . $row[0] . '">';
        echo '<i class="fa fa-trash"></i>';
        echo '</a>';
        echo '</td>';


        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}

?>

</div>
</div>
</div>
</div>

</div>

<br /><br /><br /><br /><br />

</div>


</body>

</html>