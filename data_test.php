
<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL ^ E_NOTICE);
print_r(glob("img/aerial_yam/" . "*.{jpg,png,gif}",GLOB_BRACE));
// function cmp_name($a, $b) {
//     return strcmp(strtolower($a["Name"]), strtolower($b["Name"]));
// }

// if(!file_exists('cache.json') || !file_exists('cachetime') || time() - intval(file_get_contents('cachetime')) > 432000 /*5 days */){
//     echo("Loaded from API");
//     $apiUrl = 'https://weeds.brisbane.qld.gov.au/api/weeds';
//     $data = file_get_contents($apiUrl);

//     file_put_contents('cache.json', $data);
//     file_put_contents('cachetime', time());

//     $data = json_decode($data,true);
//     usort($data, "cmp_name");
// }
// else {
//     echo("Loaded from cache");
//     $data = json_decode(file_get_contents('cache.json'), true);
//     usort($data, "cmp_name");
// }
// echo("<br>");
// echo nl2br(print_r($data));

?>