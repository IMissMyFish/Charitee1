<?php
$connection = mysqli_connect("localhost", "landorfh_charity", "L4;g=1%T78Y;", "landorfh_charitee_charities");
#$connection = mysqli_connect("localhost", "root", "mysql", "landorfh_charitee_charities");  Diego Localhost
#$connection = mysqli_connect("localhost", "root", "", "landorfh_charitee_charities"); Landon Localhost
if (!$connection) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

?>
