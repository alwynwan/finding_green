<?php 

function connect_to_db() {
    $mysqli = new mysqli("localhost","fg_user","findinggreen","deco7180");

    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }

    return $mysqli;
}

function disconnect_from_db($mysqli) {
    if($mysqli->ping()) {
        $mysqli->close();
    }
}
