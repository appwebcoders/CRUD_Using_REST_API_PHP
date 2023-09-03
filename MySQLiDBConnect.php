<?php
include 'Configurations.php';
$con = mysqli_connect(
                    $DATABASE_SERVER_IP, 
                    $DATABASE_USER_NAME, 
                    $DATABASE_USER_PASSWORD,
                    $DATABASE_NAME
                );
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
