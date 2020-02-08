<?php
$dbservername = 'localhost';
$dbpassword = '12itm035d94693ef271c';
$dbusername = '12itm03';
$dbname = '12itm03_dbforms'; 
$conn= mysqli_connect($dbservername,$dbusername,$dbpassword,$dbname);
if (mysqli_connect_errno()) {
    echo 'Failed to make connection to database: ' . mysqli_connect_error();
}

?>