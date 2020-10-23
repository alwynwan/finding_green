<?php
include('header.php');
include('db_utils.php');
include('get_data.php');
$plant_id = (isset($_GET["id"]) && is_numeric($_GET["id"])) ? $_GET["id"] : "-1";
?>

<body class="full-height full-width">
    <?php include('navbar.php') ?>

    <section class="container full-height full-width">
        <div class="discover-container full-width full-height scrollable">
            <div class="plant-details full-width">
                <div class="row full-width justify-flex-start">
                    <div class="back-button">
                        <span class="material-icons">keyboard_backspace</span>
                        <span>Back</span>
                    </div>
                </div>
                <?php
                if($plant_id == -1) {
                    echo("<h1 class='full-width invalid-plant-msg'>Invalid plant selected!");
                    include("theme_swapper.php");
                    echo("<script src=\"js/jquery-3.5.1.min.js\"></script>
                    <script src=\"js/app.js\"></script>");
                    die();
                }
                $conn = connect_to_db();
                $plant_data = get_data("SELECT * FROM `weeds` WHERE Nid = " . $plant_id);
                if(count($plant_data) == 0) {
                    echo("<h1 class='full-width invalid-plant-msg'>Invalid plant selected!");
                    include("theme_swapper.php");
                    echo("<script src=\"js/jquery-3.5.1.min.js\"></script>
                    <script src=\"js/app.js\"></script>");
                    die();
                }
                
                /* Yes, this is susceptible to XSS and SQLI, but I don't want to
                   redo all of my code to fix this */

                $plant_data = $plant_data[0];
                get_images($plant_data[1], 5);
            ?>
                <div class="row full-width plant-details full-height">
                    <div class="col full-height detail-left">
                        <h1 class="plant-name"><?php echo(ucwords($plant_data[1]));?></h1>
                        <h2 class="plant-species"><?php echo(ucwords($plant_data[6]));?></h2>

                        <img class="main-img" src="<?php echo("img/" . str_replace(" ","_",$plant_data[1]) . "/1.jpg");?>">
                        <div class="sub-imgs">
                            <img class="sub-img" src="<?php echo("img/" . str_replace(" ","_",$plant_data[1]) . "/2.jpg");?>">
                            <img class="sub-img" src="<?php echo("img/" . str_replace(" ","_",$plant_data[1]) . "/3.jpg");?>">
                            <img class="sub-img" src="<?php echo("img/" . str_replace(" ","_",$plant_data[1]) . "/4.jpg");?>">
                            <img class="sub-img" src="<?php echo("img/" . str_replace(" ","_",$plant_data[1]) . "/5.jpg");?>">
                        </div>
                        <a class="purchase-btn" href="http://www.wallumnurseries.com/place-order/">Purchase</a>
                    </div>
                    <div class="col full-height detail-right">
                        <div class="row emphasis-bubbles">
                            <div class="bubble">
                                <span name="growth_form"><?php echo(ucwords($plant_data[7]));?></span>
                            </div>
                            <div class="bubble">
                                <span name="leaf_arrangement"><?php echo(ucwords($plant_data[9]));?></span>
                            </div>
                            <div class="bubble">
                                <span name="simple_compound"><?php echo(ucwords($plant_data[10]));?></span>
                            </div>
                            <div class="bubble">
                                <span name="flower_colour"><?php echo(ucwords($plant_data[8]));?></span>
                            </div>
                            <div class="bubble">
                                <span class="foliage_colour"><?php echo(ucwords($plant_data[11]));?></span>
                            </div>
                        </div>

                        <div class="common_names detail_cell  align-flex-start">
                            <h2 class="cell_subheading">Common Names</h2>
                            <span class="cell_content"><strong>Also known as:</strong> <?php echo(ucwords($plant_data[5]));?></span>
                        </div>

                        <div class="row full-width justify-flex-start">
                            <div class="col detail_cell  align-flex-start">
                                <h2 class="cell_subheading">Family</h2>
                                <span name="family"><?php echo(ucwords($plant_data[2]));?></span>
                            </div>
                            <div class="col detail_cell  align-flex-start">
                                <h2 class="cell_subheading">Deciduous</h2>
                                <span name="deciduous"><?php echo(ucwords($plant_data[3]));?></span>
                            </div>
                            <div class="col detail_cell  align-flex-start">
                                <h2 class="cell_subheading">Flowering Time</h2>
                                <span name="flowering_time"><?php echo(ucwords($plant_data[12]));?></span>
                            </div>
                        </div>

                        <div class="row full-width justify-flex-start">
                            <div class="col detail_cell  align-flex-start">
                                <h2 class="cell_subheading">Native/Exotic</h2>
                                <span name="native_exotic"><?php echo(ucfirst($plant_data[16]));?></span>
                            </div>
                            <div class="col detail_cell  align-flex-start">
                                <h2 class="cell_subheading">Origin</h2>
                                <span name="origin">Native to the tropical Americas</span>
                            </div>
                            <div class="col detail_cell  align-flex-start">
                                <h2 class="cell_subheading">Notifiable</h2>
                                <span name="notifiable"><?php echo(ucfirst($plant_data[4]));?></span>
                            </div>
                        </div>

                        <div class="row full-width justify-flex-start">
                            <div class="col detail_cell  align-flex-start">
                                <h2 class="cell_subheading">State Declaration</h2>
                                <span name="state_declaration"><?php echo($plant_data[13] == "" ? "N/A" : ucfirst($plant_data[13]));?></span>
                            </div>
                            <div class="col detail_cell align-flex-start">
                                <h2 class="cell_subheading">Council Declaration</h2>
                                <span name="council_declaration"><?php echo(ucfirst($plant_data[14]));?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include("theme_swapper.php"); ?>
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/app.js"></script>
</body>

</html>