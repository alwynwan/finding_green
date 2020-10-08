<?php 
include("get_data.php");
load_data();

function str_cleanup($str) {
    $str = strtolower($str);
    $str = str_replace("&#039;", "", $str);
    return $str;
}

$mysqli = new mysqli("localhost","fg_user","findinggreen","deco7180");

if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
    }

    foreach ($data as $entry => $value) {
        $state_declaration = is_array($value["State declaration"]) && $value["State declaration"][0] === "" ? "" : $value["State declaration"];
        $replacement_species = is_array($value["Replacement species"]) && $value["Replacement species"][0] === "" ? "" : $value["Replacement species"];
        $sql = "INSERT INTO weeds VALUES (" . $value["Nid"] . ", '" . str_cleanup($value["Name"]) . "', '" . $value["Family"] . "', '" . $value["Deciduous"] . "', '" . $value["Notifiable"] . "', '" . str_cleanup(implode(", ", $value["Common names"])) . "', '" . $value["Species name"] . "', '" . $value["Growth form"] . "', '" . implode("', '", $value["Flower colour"]) . "', '" . $value["Leaf arrangement"] . "', '" . $value["Simple/Compound"] . "', '" . implode(", ", $value["Foliage Colour"]) . "', '" . $value["Flowering time"] . "', '" . $state_declaration . "', '" . $value["Council declaration"] . "', '" . $value["Control methods"] . "', '" . $value["Native/Exotic"] . "', '" . str_cleanup($replacement_species) . "')";

        echo(nl2br("Running SQL query: " . $sql . "\r\n"));
        if($mysqli->query($sql) === TRUE) {
            echo("Success");
        }
        else {
            echo($mysqli->error);
        }
    }

    $mysqli->close();
?>