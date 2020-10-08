<?php
include('header.php');
?>

<body class="full-height full-width">
    <div class="hero-image">
        <div class="center-modal">
            <div class="row">
                <div class="col">
                    <img class="icon" src="img/icon.png">
                    <h1 class="home-title">Finding Green</h1>
                </div>
            </div>

            <div class="row modal-buttons">
                <div class="big-btn">
                    <a href="discover.php">discover</a>
                </div>

                <div class="big-btn">
                    <a href="search.php">search</a>
                </div>
            </div>
        </div>
    </div>

    <?php include("theme_swapper.php"); ?>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/home.js"></script>
    <script src="js/app.js"></script>
</body>

</html>