<?php
$conn = mysqli_connect("localhost", "root", "", 'laundry');

if (!$conn) {
    echo mysqli_connect_error();
}
