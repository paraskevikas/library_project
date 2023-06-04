<?php

exec('C:\xampp\mysql\bin\mysql --user=root --password= < "C:/back_up/library.sql"');

header('Location: back_up-restore.php');

?>
