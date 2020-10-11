
<?php
include_once('db_utils.php');
include('templates.php');
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);

function cmp_name($a, $b)
{
    return strcmp(trim(strtolower($a[1])), trim(strtolower($b[1])));
}

function str_cleanup($str) {
    $str = trim($str);
    $str = strtolower($str);
    $str = str_replace("&#039;", "", $str);
    return $str;
}

function load_data($force = 0)
{
    if ($force || !file_exists('cachetime') || time() - intval(file_get_contents('cachetime')) > 432000 /*5 days */) {
        $apiUrl = 'https://weeds.brisbane.qld.gov.au/api/weeds';
        $data = file_get_contents($apiUrl);

        file_put_contents('cachetime', time());

        $data = json_decode($data, true);
        usort($data, "cmp_name");

        insert_to_db($data);
    } else {
        $data = get_data();
        usort($data, "cmp_name");
    }
}

function get_data($sql="SELECT * FROM `weeds` ORDER BY `Name` ASC") {
    $conn = connect_to_db();

    if($conn === null) {
        return;
    }

    $result = $conn->query($sql);
    $data = $result->fetch_all();
    disconnect_from_db($conn);
    return $data;
}

function arrstr_to_str($arrstr) {
    if(!is_array($arrstr)) {
        return str_cleanup($arrstr);
    }
    
    if($arrstr[0] === "") {
        return "";
    }
    else {
        return str_cleanup(implode(", ", $arrstr));
    }
}

function insert_to_db($new_data)
{
    $conn = connect_to_db();

    if($conn === null) {
        return;
    }

    foreach ($new_data as $entry => $value) {
        $value["Name"] = arrstr_to_str($value["Name"]);
        $value["Family"] = arrstr_to_str($value["Family"]);
        $value["Deciduous"] = arrstr_to_str($value["Deciduous"]);
        $value["Notifiable"] = arrstr_to_str($value["Notifiable"]);
        $value["Common names"] = arrstr_to_str($value["Common names"]);
        $value["Species name"] = arrstr_to_str($value["Species name"]);
        $value["Growth form"] = arrstr_to_str($value["Growth form"]);
        $value["Flower colour"] = arrstr_to_str($value["Flower colour"]);
        $value["Leaf arrangement"] = arrstr_to_str($value["Leaf arrangement"]);
        $value["Simple/Compound"] = arrstr_to_str($value["Simple/Compound"]);
        $value["Foliage Colour"] = arrstr_to_str($value["Foliage Colour"]);
        $value["Flowering time"] = arrstr_to_str($value["Flowering time"]);
        $value["State declaration"] = arrstr_to_str($value["State declaration"]);
        $value["Council declaration"] = arrstr_to_str($value["Council declaration"]);
        $value["Control methods"] = arrstr_to_str($value["Control methods"]);
        $value["Native/Exotic"] = arrstr_to_str($value["Native/Exotic"]);
        $value["Replacement species"] = arrstr_to_str($value["Replacement species"]);

        $sql = "INSERT INTO weeds VALUES (" . $value["Nid"] . ", '" . $value["Name"] . "', '" . $value["Family"] . "', '" . $value["Deciduous"] . "', '" . $value["Notifiable"] . "', '" . $value["Common names"] . "', '" . $value["Species name"] . "', '" . $value["Growth form"] . "', '" . $value["Flower colour"] . "', '" . $value["Leaf arrangement"] . "', '" . $value["Simple/Compound"] . "', '" . $value["Foliage Colour"] . "', '" . $value["Flowering time"] . "', '" . $value["State declaration"] . "', '" . $value["Council declaration"] . "', '" . $value["Control methods"] . "', '" . $value["Native/Exotic"] . "', '" . $value["Replacement species"] . "')";

        if(!$conn->query($sql) === TRUE) {
            echo($conn->error);
        }
    }

    disconnect_from_db($conn);
}

// Returns items from dataset from $start to $end, both inclusive
function get_items($start, $num, $sql = "")
{
    if($sql == ""){
        $data = get_data();
    }
    else {
        $data = get_data($sql);
    }
    return array_slice($data, $start, $num, true);
}

function draw_page_buttons($cur_page, $sql = "")
{
    global $page_indicator_template;
    global $active_page_indicator_template;
    $data = null;

    if($sql == "") {
        $data = get_data();
    }
    else {
        $data = get_data($sql);
    }

    $num_pages = ceil(sizeof($data) / 10);

    // Show page 1 if (cur_page - 2) > 1
    if ($cur_page - 2 > 1) {
        echo (str_replace("{{pagenum}}", 1, $page_indicator_template));
        echo ('<span class="separator">...</span>');
    }

    // Show 2 pages either side of the current page
    for ($num = max(1, $cur_page - 2); $num <= $cur_page + 2 && $num <= $num_pages; $num++) {
        echo (str_replace("{{pagenum}}", $num, $num == $cur_page ? $active_page_indicator_template : $page_indicator_template));
    }

    // Show last page if (num_pages - cur_page) > 2
    if ($num_pages - $cur_page > 2) {
        echo ('<span class="separator">...</span>');
        echo (str_replace("{{pagenum}}", $num_pages, $page_indicator_template));
    }
}
?>