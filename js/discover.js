function handleClick(event) {
    console.log(event);
    $(event.currentTarget).toggleClass("selected");
}

$(".plant-images").on("click", ".plant-entry", handleClick);

var stage = 1;
$(".discover-submit").click(() => {
    if (stage == 1) {
        $(".plant-images").fadeOut(() => {
            $(".plant-images").empty();
            $(".plant-images").append($(`<div class="row full-width">
            <div class="plant-entry">
                <img src="img/aerial_yam/2.jpg">
            </div>
            <div class="plant-entry">
                <img src="img/yellow_bells/1.jpg">
            </div>
            <div class="plant-entry">
                <img src="img/yucca/1.jpg">
            </div>
            <div class="plant-entry">
                <img src="img/willows/1.jpg">
            </div>
            <div class="plant-entry">
                <img src="img/water_mimosa/1.jpg">
            </div>
        </div>`));
            $(".plant-images").fadeIn();
            stage = 2;
        });
    } else if (stage == 2) {

    };
});