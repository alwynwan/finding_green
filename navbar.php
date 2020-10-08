<nav class="navbar full-width">
        <div class="row space-between">
            <div class="left" onclick="home()">
                <img class="logo" src="img/icon-small.png">
                <h1 class="title">Finding Green</h1>
            </div>

            <div class="center mobile-menu">
                <h1 class="title">Finding Green</h1>
            </div>

            <div class="right">
                <div class="row space-between">
                    <ul class="navbar-links">
                        <?php include('pages.php') ?>
                    </ul>

                    <ul class="mobile-menu">
                        <span class="material-icons" onclick="toggle_menu()">menu</span>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row mobile-menu">
            <ul class="mobile-navbar-links">
                <?php include('pages.php') ?>
            </ul>
        </div>
    </nav>