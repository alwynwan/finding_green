<?php include('header.php');
include('get_data.php');
include_once('templates.php');
load_data();

$cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
?>

<body class="full-height full-width">
    <?php include('navbar.php') ?>

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

                <label for="leaf_form">Leaf Form</label>
                <input id="leaf_form" type="text" name="leaf_form">

                <label for="foliage_colour">Foliage Colour</label>
                <input id="foliage_colour" type="text" name="foliage_colour">

                <label for="flower_colour">Flower Colour</label>
                <input id="flower_colour" type="text" name="flower_colour">

                <div class="row space-between">
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

                    <label for="leaf_form">Leaf Form</label>
                    <input id="growleaf_formth_form" type="text" name="leaf_form">

                    <label for="foliage_colour">Foliage Colour</label>
                    <input id="foliage_colour" type="text" name="foliage_colour">

                    <label for="flower_colour">Flower Colour</label>
                    <input id="flower_colour" type="text" name="flower_colour">

                    <div class="row">
                        <button type="reset" class="filter-btn">Clear</button>
                        <button type="submit" class="filter-btn">Apply</button>
                    </div>
                </form>
            </div>

        </div>

        <div class="right-content full-height full-width scrollable">
            <h1>Results</h1>

            <div class="page-select">
                <?php draw_page_buttons($cur_page); ?>
            </div>

            <div class="results">
                <?php
                $regex = "/([0-9a-z]+)\?itok/";
                $page_data = get_items(10 * ($cur_page - 1), 10 * ($cur_page - 1) + 9);
                foreach ($page_data as $entry => $value) {
                    $img_url = null;
                    $plant_name = str_replace("&#039;", "", str_replace(" ", "_", strtolower($value["1"])));
                    $matching_imgs = glob("img/" . $plant_name . "/*");

                    // See if we have 5 images already downloaded
                    if (count($matching_imgs) < 5) {
                        if (!is_dir("img/" . $plant_name)) {
                            mkdir("img/" . $plant_name);
                        }
                        $img_data = file_get_contents("https://www.googleapis.com/customsearch/v1?q=" . urlencode($plant_name) . "&num=10&cx=d12d8f6715d83526f&key=AIzaSyDN-yuivb0I1o1bRgjxKP-vfuW9Z6vAMYQ&searchType=image");
                        $img_data = json_decode($img_data, true);

                        $img_count = 0;

                        for ($idx = 0; $img_count < 5; $idx++) {
                            $matches = null;
                            $url = $img_data["items"][$idx]['link'];
                            $path_info = pathinfo($url);
                            preg_match($regex, $path_info["extension"], $matches);
                            if (count($matches) == 0) {
                                continue;
                            }

                            file_put_contents("img/" . $plant_name . "/" . ($img_count + 1) . "." . $matches[1], file_get_contents($url));
                            $img_count++;
                        }
                    }

                    $imgs = glob("img/" . $plant_name . "/*");

                    $name_str = str_replace("{{weedname}}", ucwords($value[1]), $result_template);
                    $species_name_str = str_replace("{{weeddesc}}", ucwords($value[6]), $name_str);
                    $full_str = str_replace("{{weedimg}}", $imgs[0], $species_name_str);

                    echo ($full_str);
                }
                ?>
            </div>
        </div>
    </div>
    <?php include("theme_swapper.php"); ?>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/app.js"></script>
</body>

</html>