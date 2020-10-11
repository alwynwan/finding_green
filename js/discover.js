function handleClick(event) {
    console.log(event.currentTarget);
    $(event.currentTarget).toggleClass("selected");
}

$(".plant-images").on("click", ".plant-entry", handleClick);

var stage = 1;
$(".discover-submit").click(() => {
    if (stage == 1) {
        $(".plant-images, .info-msg, .discover-submit").fadeOut(() => {
            $(".info-msg").text("These are your favourite plants");
            $(".discover-submit").text("Restart");
            $(".plant-images").empty();
            $(".plant-images").append(`<div class="row mobile-col tablet-col full-width"><div class="col">
            <div class="plant-entry">
                <img src="img/aerial_yam/1.jpg">
            </div>
            <a class="read-more" href="#">Read more</a>
        </div>
        <div class="col">
            <div class="plant-entry">
                <img src="img/yellow_bells/1.jpg">
            </div>
            <a class="read-more" href="detail.php?id=73">Read more</a>
        </div>
        <div class="col">
            <div class="plant-entry">
                <img src="img/yucca/1.jpg">
            </div>
            <a class="read-more" href="#">Read more</a>
        </div>
        <div class="col">
            <div class="plant-entry">
                <img src="img/willows/1.jpg">
            </div>
            <a class="read-more" href="#">Read more</a>
        </div>
        <div class="col">
            <div class="plant-entry">
                <img src="img/water_mimosa/1.jpg">
            </div>
            <a class="read-more" href="#">Read more</a>
        </div></div>`);
            $(".info-msg, .plant-images, .discover-submit").fadeIn();
            stage = 2;
        });
    } else if (stage == 2) {
        $(".plant-images, .info-msg, .discover-submit").fadeOut(() => {
            $(".info-msg").text("Find your new favourite by clicking your preferable images below!");
            $(".discover-submit").text("Submit");
            $(".plant-images").empty();
            $(".plant-images").append($(`<div class="row full-width">
            <div class="col">
                <div class="plant-entry">
                    <img src="img/aerial_yam/2.jpg">
                </div>
            </div>

            <div class="col">
                <div class="plant-entry">
                    <img src="img/african_fountain_grass/1.jpg">
                </div>
            </div>

            <div class="col">
                <div class="plant-entry">
                    <img src="img/athel_pine/1.jpg">
                </div>
            </div>
            <div class="col">
                <div class="plant-entry">
                    <img src="img/awnless_barnyard/1.jpg">
                </div>
            </div>
            <div class="col">
                <div class="plant-entry">
                    <img src="img/anzac_tree_daisy/1.jpg">
                </div>
            </div>
        </div>
        <div class="row full-width">
            <div class="col">
                <div class="plant-entry">
                    <img src="img/annual_ragweed/2.jpg">
                </div>
            </div>
            <div class="col">
                <div class="plant-entry">
                    <img src="img/asthma_plant/1.jpg">
                </div>
            </div>
            <div class="col">
                <div class="plant-entry">
                    <img src="img/zig-zag_wattle/2.jpg">
                </div>
            </div>
            <div class="col">
                <div class="plant-entry">
                    <img src="img/alligator_weed/4.jpg">
                </div>
            </div>
            <div class="col">
                <div class="plant-entry">
                    <img src="img/american_rats_tail_grass/5.jpg">
                </div>
            </div>
        </div>`));
            $(".info-msg, .plant-images, .discover-submit").fadeIn();
        });
        stage = 1;
    };
});