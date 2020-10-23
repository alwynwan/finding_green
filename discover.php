<?php
include_once('header.php');
include_once('templates.php');
include_once('db_utils.php');
include_once('get_data.php');

$stage = isset($_GET["stage"]) ? $_GET["stage"] : 1;
$ids = isset($_GET["ids"]) ? $_GET["ids"] : "";

function create_plant_image_row($stage = 1, $num_in_row = 5)
{
    global $discover_plant_entry_template_stage1;
    global $discover_plant_entry_template_stage2;

    $conn = connect_to_db();

    if ($conn == null) {
        return;
    }

    $data = get_data();

    disconnect_from_db($conn);

    $num_plants = count($data);
    $plant_entries = "";
    for ($idx = 0; $idx < $num_in_row; $idx++) {
        $rand = rand(0, $num_plants);
        $plant = $data[$rand];
        $plant_name = $plant[1];

        get_images($plant_name, 1);

        $plant_name_dir = str_replace(" ", "_", $plant[1]);

        $plant_imgs = glob("img/" . $plant_name_dir . "/*.{jpg,png}", GLOB_BRACE);

        $plant_entry = str_replace(
            array(
                "{{plant_img}}",
                "{{weedid}}"
            ),
            array(
                $plant_imgs[0],
                $plant[0]
            ),
            $stage == 1 ? $discover_plant_entry_template_stage1 : $discover_plant_entry_template_stage2
        );

        echo ($plant_entry);
        ob_flush();
        flush();
    }
}
?>

<body class="full-height full-width">
    <?php include_once('navbar.php') ?>

    <div class="container full-height full-width">
        <div class="discover-container full-width full-height scrollable">
            <span class="info-msg">
                <?php
                echo (nl2br($stage == 1 ?
                    'Find your new favourite by clicking your preferable images below!' :
                    'These are your favourite weeds.
                Keep choosing more to narrow down the search, or go back a page to change your choices!')); ?></span>
            <div class="plant-images full-width">
                <div class="row mobile-col tablet-col full-width">
                    <?php create_plant_image_row($stage, 5); ?>
                </div>

                <div class="row mobile-col tablet-col full-width">
                    <?php create_plant_image_row($stage, 5); ?>
                </div>
            </div>

            <div class="row full-width bottom-item">
                <button class="discover-submit" type="submit" onclick="handleSubmit(<?php echo ($stage); ?>)"><?php echo ($stage == 1 ? 'Submit' : 'Restart'); ?></button>
            </div>

            <?php include_once("theme_swapper.php"); ?>
            <script src="js/jquery-3.5.1.min.js"></script>
            <script src="js/app.js"></script>
            <script src="js/discover.js"></script>
</body>

</html>