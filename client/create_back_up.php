<?php


$output = exec('C:\xampp\mysql\bin\mysqldump --databases library --host=localhost --user=root --password= --result-file="C:/back_up/library.sql"');

header('Location: back_up-restore.php');



?>