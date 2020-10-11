<?php include('header.php') ?>

<body class="full-height full-width">
    <?php include('navbar.php') ?>

    <div class="container full-height full-width">
        <div class="discover-container full-width full-height scrollable">
            <div class="plant-details full-width">
                <div class="row full-width justify-flex-start">
                    <div class="back-button">
                        <span class="material-icons">keyboard_backspace</span>
                        <span>Back</span>
                    </div>
                </div>
                <div class="row full-width plant-details full-height">
                    <div class="col full-height detail-left">
                        <h1 class="plant-name">Yellow Bells</h1>
                        <h2 class="plant-species">Tecoma Stans</h2>

                        <img class="main-img" src="img/yellow_bells/1.jpg">
                        <div class="sub-imgs">
                            <img class="sub-img" src="img/yellow_bells/2.jpg">
                            <img class="sub-img" src="img/yellow_bells/3.jpg">
                            <img class="sub-img" src="img/yellow_bells/4.jpg">
                            <img class="sub-img" src="img/yellow_bells/5.jpg">
                        </div>
                        <a class="purchase-btn" href="http://www.wallumnurseries.com/place-order/">Purchase</a>
                    </div>
                    <div class="col full-height detail-right">
                        <div class="row emphasis-bubbles">
                            <div class="bubble">
                                <span name="growth_form">Tree</span>
                            </div>
                            <div class="bubble">
                                <span name="leaf_arrangement">Opposite</span>
                            </div>
                            <div class="bubble">
                                <span name="simple_compound">Compound</span>
                            </div>
                            <div class="bubble">
                                <span name="flower_colour">Yellow</span>
                            </div>
                            <div class="bubble">
                                <span class="foliage_colour">Green</span>
                            </div>
                        </div>

                        <div class="plant_desc full-width">
                            <span>A shrub or small tree with once-compound paired leaves. Its leaves have several elongated leaflets with sharply toothed margins. It produces small clusters of showy, yellow, tubular flowers (30-50 mm long) with five rounded lobes and several faint reddish lines in their throats. Its fruit are large elongated capsules (10-30 cm long and 5-20 mm wide) that split open to release numerous papery seeds. Its seeds (7-8 mm long and about 4 mm wide) have a transparent wing at each end.</span>
                        </div>

                        <div class="common_names detail_cell  align-flex-start">
                            <h2 class="cell_subheading">Common Names</h2>
                            <span class="cell_content">Also known as: yellow bells, tecoma</span>
                        </div>

                        <div class="row full-width justify-flex-start">
                            <div class="col detail_cell  align-flex-start">
                                <h2 class="cell_subheading">Family</h2>
                                <span name="family">Bignoniaceae</span>
                            </div>
                            <div class="col detail_cell  align-flex-start">
                                <h2 class="cell_subheading">Deciduous</h2>
                                <span name="deciduous">No</span>
                            </div>
                            <div class="col detail_cell  align-flex-start">
                                <h2 class="cell_subheading">Flowering Time</h2>
                                <span name="flowering_time">Spring-Summer</span>
                            </div>
                        </div>

                        <div class="row full-width justify-flex-start">
                            <div class="col detail_cell  align-flex-start">
                                <h2 class="cell_subheading">Native/Exotic</h2>
                                <span name="native_exotic">Exotic</span>
                            </div>
                            <div class="col detail_cell  align-flex-start">
                                <h2 class="cell_subheading">Origin</h2>
                                <span name="origin">Native to the tropical Americas</span>
                            </div>
                            <div class="col detail_cell  align-flex-start">
                                <h2 class="cell_subheading">Notifiable</h2>
                                <span name="notifiable">No</span>
                            </div>
                        </div>

                        <div class="row full-width justify-flex-start">
                            <div class="col detail_cell  align-flex-start">
                                <h2 class="cell_subheading">State Declaration</h2>
                                <span name="state_declaration">Category 3 - must not be distributed or disposed. this means it must not be released into the environment unless the distribution or disposal is authorised in a regulation or under a permit.</span>
                            </div>
                            <div class="col detail_cell align-flex-start">
                                <h2 class="cell_subheading">Council Declaration</h2>
                                <span name="council_declaration">As per State Declaration</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include("theme_swapper.php"); ?>
        <script src="js/jquery-3.5.1.min.js"></script>
        <script src="js/app.js"></script>
</body>

</html>