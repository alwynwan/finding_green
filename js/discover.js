$(".plant-entry").click((event) => {
    console.log(event);
    $(event.currentTarget).toggleClass("selected");
})