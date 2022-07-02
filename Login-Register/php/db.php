<?php

    // Promeniti vrednosti: host name, data base username, password, database name.
$con = mysqli_connect("localhost","root","","goldtradrs_new");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>