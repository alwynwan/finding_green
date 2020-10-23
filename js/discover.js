function handleClick(event) {
    console.log(event.currentTarget);
    $(event.currentTarget).toggleClass("selected");

    $(".discover-submit").text($(".plant-entry.selected").length != 0 ? "Submit" : "Restart");
}

$(".plant-images").on("click", ".plant-entry", handleClick);

function handleSubmit(stage) {
    var stage_regex = /[&?]?stage=(\d+)[&?]?/
    var ids_regex = /[&?]?ids=(.*)[&?]?/;

    var selected = $(".plant-entry.selected");

    if (selected.length == 0) {
        alert("Please select some weeds!");
        return;
    }

    var ids_match = window.location.href.match(ids_regex);
    var ids = "";

    var stage_match = window.location.href.match(stage_regex);
    var stage = 0;

    if (ids_match !== null) {
        ids = ids_match[1] + ",";
    }

    if (stage_match !== null) {
        stage = parseInt(stage_match[1]);
    }

    if (stage == 0) {
        return;
    }

    for (var i = 0; i < selected.length - 1; i++) {
        ids += `${selected[i].dataset["id"]},`;
    }

    ids += `${selected[selected.length - 1].dataset["id"]}`;

    window.location.href = `discover.php?stage=${++stage}&ids=${ids}`;
}