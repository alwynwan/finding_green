<?php
include_once('header.php');
include_once("get_data.php");
include_once('templates.php');
$category = isset($_GET['category']) ? $_GET['category'] : "";
$cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
?>

<body class="full-height full-width">

    <?php include_once('navbar.php') ?>
    <div class="container">
        <div class="sidebar">
            <h2>Categories</h2>
            <div class="categories">
                <ul>
                    <li <?php echo ($category == 'Aquatic' ? 'class="active"' : ''); ?> onclick="change_category('Aquatic')">Aquatic</li>
                    <li <?php echo ($category == 'Grass' ? 'class="active"' : ''); ?> onclick="change_category('Grass')">Grass</li>
                    <li <?php echo ($category == 'Herb' ? 'class="active"' : ''); ?> onclick="change_category('Herb')">Herb</li>
                    <li <?php echo ($category == 'Shrub' ? 'class="active"' : ''); ?> onclick="change_category('Shrub')">Shrub</li>
                    <li <?php echo ($category == 'Succulent' ? 'class="active"' : ''); ?> onclick="change_category('Succulent')">Succulent</li>
                    <li <?php echo ($category == 'Tree' ? 'class="active"' : ''); ?> onclick="change_category('Tree')">Tree</li>
                    <li <?php echo ($category == 'Vine' ? 'class="active"' : ''); ?> onclick="change_category('Vine')">Vine</li>
                </ul>
            </div>
        </div>

        <div class="mobile-sidebar full-width">
            <div class="sidebar-content">
                <div class="heading">
                    <h2>Categories</h2>
                    <span class="material-icons expand-sidebar" onclick="toggle_sidebar()">expand_more</span>
                </div>

                <div class="categories sidebar-hidden">
                    <ul>
                        <li <?php echo ($category == 'Aquatic' ? 'class="active"' : ''); ?> onclick="change_category('Aquatic')">Aquatic</li>
                        <li <?php echo ($category == 'Grass' ? 'class="active"' : ''); ?> onclick="change_category('Grass')">Grass</li>
                        <li <?php echo ($category == 'Herb' ? 'class="active"' : ''); ?> onclick="change_category('Herb')">Herb</li>
                        <li <?php echo ($category == 'Shrub' ? 'class="active"' : ''); ?> onclick="change_category('Shrub')">Shrub</li>
                        <li <?php echo ($category == 'Succulent' ? 'class="active"' : ''); ?> onclick="change_category('Succulent')">Succulent</li>
                        <li <?php echo ($category == 'Tree' ? 'class="active"' : ''); ?> onclick="change_category('Tree')">Tree</li>
                        <li <?php echo ($category == 'Vine' ? 'class="active"' : ''); ?> onclick="change_category('Vine')">Vine</li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="right-content full-height full-width scrollable">
            <h1>Results</h1>
            <?php
            $sql = "";
            if (isset($_GET["category"])) {
                $sql = "SELECT * FROM `weeds` WHERE Growth_form LIKE '%" . $_GET["category"] . "%' ORDER BY Name ASC";
            }
            ?>
            <div class="page-select">
                <?php draw_page_buttons($cur_page, $sql); ?>
            </div>

            <div class="results">
                <?php
                $regex = "/([0-9a-z]+)\?itok/";

                $page_data = get_items(10 * ($cur_page - 1), 10, $sql);
                foreach ($page_data as $entry => $value) {
                    $img_url = null;
                    $plant_name = str_replace("&#039;", "", str_replace(" ", "_", strtolower($value["1"])));
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
                            "{{control_methods}}"
                        ),
                        array(
                            intval($value[0]),
                            ucwords($value[1]),
                            ucwords($value[6]),
                            $imgs[0],
                            ucwords($value[5]),
                            $value[15] == " " ? "N/A" : ucfirst($value[15]), $common_names_str
                        ),
                        $result_template
                    );

                    echo ($full_str);
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