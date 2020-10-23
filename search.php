<?php
// Turn off output buffering
ini_set('output_buffering', 'off');


header('Cache-Control: no-cache'); // recommended to prevent caching of event data.
include_once('header.php');
include_once('get_data.php');
include_once('templates.php');
load_data();

$cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
$get_keywords = isset($_GET['keywords']) ? $_GET['keywords'] : "";
$get_growth_form = isset($_GET['growth_form']) ? $_GET['growth_form'] : "";
$get_leaf_arrangement = isset($_GET['leaf_arrangement']) ? $_GET['leaf_arrangement'] : "";
$get_family = isset($_GET['family']) ? $_GET['family'] : "";
$get_foliage_colour = isset($_GET['foliage_colour']) ? $_GET['foliage_colour'] : "";
$get_flower_colour = isset($_GET['flower_colour']) ? $_GET['growth_form'] : "";
?>

<body class="full-height full-width">
    <?php include_once('navbar.php') ?>

    <div class="container">
        <div class="sidebar">
            <h2>Filters</h2>
            <form class="filters" method="get" action="search.php">
                <label for="keywords">Keywords</label>
                <input id="keywords" name="keywords" type="text">

                <label for="growth_form">Growth Form</label>
                <input id="growth_form" type="text" name="growth_form">

                <label for="leaf_arrangement">Leaf Arrangement</label>
                <input id="leaf_arrangement" type="text" name="leaf_arrangement">

                <label for="family">Family</label>
                <input id="family" type="text" name="family">

                <label for="foliage_colour">Foliage Colour</label>
                <input id="foliage_colour" type="text" name="foliage_colour">

                <label for="flower_colour">Flower Colour</label>
                <input id="flower_colour" type="text" name="flower_colour">

                <div class="row space-between full-width">
                    <button type="reset" class="filter-btn">Clear</button>
                    <button type="submit" class="filter-btn">Apply</button>
                </div>
            </form>
        </div>

        <div class="mobile-sidebar full-width">
            <div class="sidebar-content">
                <div class="heading">
                    <h2>Filters</h2>
                    <span class="material-icons expand-sidebar" onclick="toggle_sidebar()">expand_more</span>
                </div>

                <form class="filters sidebar-hidden" method="get" action="search.php">
                    <label for="keywords">Keywords</label>
                    <input id="keywords" name="keywords" type="text">

                    <label for="growth_form">Growth Form</label>
                    <input id="growth_form" type="text" name="growth_form">

                    <label for="leaf_arrangement">Leaf Arrangement</label>
                    <input id="leaf_arrangement" type="text" name="leaf_arrangement">

                    <label for="family">Family</label>
                    <input id="family" type="text" name="family">

                    <label for="foliage_colour">Foliage Colour</label>
                    <input id="foliage_colour" type="text" name="foliage_colour">

                    <label for="flower_colour">Flower Colour</label>
                    <input id="flower_colour" type="text" name="flower_colour">

                    <div class="row full-width space-between">
                        <button type="reset" class="filter-btn">Clear</button>
                        <button type="submit" class="filter-btn">Apply</button>
                    </div>
                </form>
            </div>

        </div>

        <div class="right-content full-height full-width scrollable">
            <h1>Results</h1>

            <?php
            $sql = "";
            // Check if any filters are populated
            if ($get_keywords != "" || $get_growth_form != "" || $get_leaf_arrangement != "" || $get_family != "" || $get_foliage_colour != "" || $get_flower_colour != "") {
                $sql = "SELECT * FROM weeds where ";

                if ($get_keywords != "") {
                    $sql = $sql . "Name like '%" . $get_keywords . "%' or Common_names like '%" . $get_keywords . "%' ";
                }

                if ($get_growth_form != "") {
                    if ($get_keywords != "") {
                        $sql = $sql . "and ";
                    }
                    $sql = $sql . "Growth_form LIKE '%" . $get_growth_form . "%' ";
                }

                if ($get_leaf_arrangement != "") {
                    if ($get_keywords != "" || $get_growth_form != "") {
                        $sql = $sql . "and ";
                    }
                    $sql = $sql . "Leaf_arrangement LIKE '%" . $get_leaf_arrangement . "%' ";
                }

                if ($get_family != "") {
                    if ($get_keywords != "" || $get_growth_form != "" || $get_leaf_arrangement != "") {
                        $sql = $sql . "and ";
                    }
                    $sql = $sql . "Family LIKE '%" . $get_family . "%' ";
                }

                if ($get_foliage_colour != "") {
                    if ($get_keywords != "" || $get_growth_form != "" || $get_leaf_arrangement != "" || $get_family != "") {
                        $sql = $sql . "and ";
                    }
                    $sql = $sql . "Foliage_Colour LIKE '%" . $get_foliage_colour . "%' ";
                }

                if ($get_flower_colour != "") {
                    if ($get_keywords != "" || $get_growth_form != "" || $get_leaf_arrangement != "" || $get_family != "" || $get_foliage_colour) {
                        $sql = $sql . "and ";
                    }
                    $sql = $sql . "Flower_colour LIKE '%" . $get_flower_colour . "%' ";
                }

                $sql = $sql . "ORDER BY Name ASC";
            }

            ?>

            <div class="page-select">
                <?php draw_page_buttons($cur_page, $sql); ?>
            </div>

            <div class="results">
                <?php
                $page_data = get_items(10 * ($cur_page - 1), 10, $sql);

                foreach ($page_data as $entry => $value) {
                    $plant_name = str_replace("&#039;", "", $value["1"]);
                    get_images($plant_name);
                    $plant_name = str_replace(" ", "_", $plant_name);
                    $imgs = glob("img/" . $plant_name . "/*.{jpg,png,gif}", GLOB_BRACE);

                    $full_str = str_replace(
                        array(
                            "{{weedid}}", 
                            "{{weedname}}", 
                            "{{weeddesc}}", 
                            "{{weedimg}}", 
                            "{{common_names}}",
                            "{{control_methods}}"),
                        array(
                            intval($value[0]), 
                            ucwords($value[1]), 
                            ucwords($value[6]),
                            $imgs[0], 
                            ucwords($value[5]), 
                            $value[15] == " " ? "N/A" : ucfirst($value[15])), $result_template);

                    echo ($full_str);
                    ob_flush();
                    flush();
                }
                ?>
                <div class="page-select">
                    <?php draw_page_buttons($cur_page, $sql); ?>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("theme_swapper.php"); ?>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>