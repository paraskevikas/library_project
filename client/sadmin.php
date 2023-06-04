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
        <div class='text'>
            <a href="sadmin1.php">3.1.1 Παρουσίαση λίστας με συνολικό αριθμό δανεισμών ανά σχολείο (Κριτήρια αναζήτησης: έτος, ημερολογιακός μήνας πχ Ιανουάριος).</a>
        </div>
        <div class='text'>
            <a href="sadmin2.php">3.1.2 Για δεδομένη κατηγορία βιβλίων (επιλέγει ο χρήστης), ποιοι συγγραφείς ανήκουν σε αυτήν και ποιοι εκπαιδευτικοί έχουν δανειστεί βιβλία αυτής της κατηγορίας το τελευταίο έτος;</a>
        </div>
        <div class='text'>
            <a href="sadmin3.php">3.1.3 Βρείτε τους νέους εκπαιδευτικούς (ηλικία < 40 ετών) που έχουν δανειστεί τα περισσότερα βιβλία και των αριθμό των βιβλίων.</a>
        </div>
        <div class='text'>
            <a href="sadmin4.php">3.1.4 Βρείτε τους συγγραφείς των οποίων κανένα βιβλίο δεν έχει τύχει δανεισμού.</a>
        </div>
        <div class='text'>
            <a href="sadmin5.php">3.1.5 Ποιοι χειριστές έχουν δανείσει τον ίδιο αριθμό βιβλίων σε διάστημα ενός έτους με περισσότερους από 20 δανεισμούς;</a>
        </div>
        <div class='text'>
            <a href="sadmin6.php">3.1.6 Πολλά βιβλία καλύπτουν περισσότερες από μια κατηγορίες. Ανάμεσα σε ζεύγη πεδίων (π.χ. ιστορία και ποίηση) που είναι κοινά στα βιβλία, βρείτε τα 3 κορυφαία (top-3) ζεύγη που εμφανίστηκαν σε δανεισμούς.</a>
        </div>
        <div class='text'>
            <a href="sadmin7.php">3.1.7 Βρείτε όλους τους συγγραφείς που έχουν γράψει τουλάχιστον 5 βιβλία λιγότερα από τον συγγραφέα με τα περισσότερα βιβλία.</a>
        </div>



        <br />
        <br />

        <div class='text'>
            <a href="sadmin_schools.php"> - Εμφάνιση/Καταχώριση/Επεξεργασία στοιχείων Σχολικών Μονάδων</a>
        </div>
        <div class='text'>
            <a href="sadmin_admins.php"> - Εμφάνιση/Επεξεργασία Χειριστών, έγκριση αιτήσεων</a>
        </div>

        <br />
        <br />

        <div type="text" style="text-align: center;">

            <a href="back_up-restore.php" class="button button3">Back up and restore database</a>

        </div>

        <br />
        <br /><br /><br /><br />

       

                        </div>


</body>

</html>