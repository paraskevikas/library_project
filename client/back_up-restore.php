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

        <br /><br /><br />

        <div class='text' style='text-align: center;'>
            <hr style="height:1px;color:#333;background-color:#333;">
            <h3>Δημιουργία Αντίγραφου Ασφαλείας (back up αρχείου)</h3>
            <hr style="height:1px;color:#333;background-color:#333;">
        </div>

        <br />
        <div class='text' style='text-align: justify; text-justify: inter-word;'>
            <p>
                Το αντίγραφο ασφαλείας (back up αρχείο) που θα δημιουργηθεί θα αποθηκευτεί στο path 'C:/back_up' και θα έχει όνομα 'library.sql'. Πριν προχωρήσετε
                στη δημιουργία του αντιγράφου ασφαλείας, βεβαιωθείτε ότι έχετε δημιουργήσει το φάκελο όπως δόθηκε στο path παραπάνω, αλλιώς η διαδικασία δημιουργίας
                του αντιγράφου ασφαλείας θα αποτύχει.
            </p>

            <p>
                <b><u>Σημαντική Παρατήρηση</u>: </b>Η δημιουργία του αντιγράφου ασφαλείας γίνεται με την εκτέλεση της εντολής mysqldump. Βεβαιωθείτε ότι η εντολή αυτή λειτουργεί
                κανονικά στον υπολογιστή σας.
            </p>
        </div>

        <br />

        <div type="text" style="text-align: center;">
            <a href="create_back_up.php" class="button button3">Create back up file</a>
        </div>

        <br /><br /><br />

        <div class='text' style='text-align: center;'>
            <hr style="height:1px;color:#333;background-color:#333;">
            <h3>Επαναφορά Συστήματος από το Αντίγραφο Ασφαλείας</h3>
            <hr style="height:1px;color:#333;background-color:#333;">
        </div>

        <br />
        <div class='text' style='text-align: justify; text-justify: inter-word;'>
            <p>
                Πριν προχωρήσετε στην επαναφορά του συστήματος, πρέπει πρώτα να έχετε δημιουργήσει ένα αντίγραφο ασφαλείας με την παραπάνω μέθοδο. Το αντίγραφο ασφαλείας
                βάσει του οποίου θα γίνει η επαναφορά πρέπει να βρίσκεται στο path 'C:/back_up' και να έχει όνομα 'library.sql', αλλιώς θα αποτύχει η διαδικασία επαναφοράς 
                του συστήματος.
            </p>
        </div>

        <br />

        <div type="text" style="text-align: center;">
            <a href="restore.php" class="button button3">Restore database</a>
        </div>


    </div>

</body>

</html>