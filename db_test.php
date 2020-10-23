<?php 
include_once("get_data.php");
load_data();

$conn = connect_to_db();

if($conn == null) {
    die("db connect failed");
}

function fix_control_methods($str) {
    $str_split = explode(" ", $str);
    $actual_string = $str_split[0] . " ";
    for($idx = 1; $idx < count($str_split); $idx++) {
        if($str_split[$idx] != $str_split[0]) {
            $actual_string = $actual_string . $str_split[$idx] . " ";
        }
        else {
            break;
        }
    }

    return $actual_string;
}

$data = get_data("SELECT * FROM weeds");

foreach ($data as $entry => $value) {
    $actual_string = fix_control_methods($value[15]);

    $sql = "UPDATE `weeds` SET `Control_methods` = '" . $actual_string . "' WHERE `Nid` = " . $value[0];
    $conn->query($sql);
}

disconnect_from_db($conn);

