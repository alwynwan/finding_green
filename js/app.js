function home() {
    window.location.href = "index.php";
}

function toggle_sidebar() {
    var arrow = $(".expand-sidebar");
    arrow.toggleClass("opened");
    $(".sidebar-hidden").toggleClass("opened");
}

function toggle_menu() {
    var menu = $(".mobile-menu span");
    menu.toggleClass("opened");
    if (menu.hasClass("opened")) {
        menu.text("close");
    } else {
        menu.text("menu");
    }

    $(".mobile-navbar-links").toggleClass("opened");
    $(".container").toggleClass("opened");
}

function next_page(cur_page) {
    const regex = /page=(\d+)/;
    console.log(window.location.search);
    if (!regex.test(window.location.search)) {
        console.log("No page found.");

        if (window.location.search == "") {
            console.log("First GET arg");
            window.location.href += `?page=${cur_page++}`;
        } else {
            console.log("Appending GET arg");
            window.location.href += `&page=${cur_page++}`;
        }

    } else {
        console.log("Page found. Replacing");
        window.location.href = window.location.href.replace(regex, `page=${cur_page++}`);
    }

}

function swap_theme() {
    var theme = localStorage.getItem("theme");
    var theme_selector_btn = $(".theme-swapper");
    var theme_selector_icon = $(".theme-swapper span");

    theme_selector_btn.toggleClass("light").toggleClass("dark");

    if (theme == "light") {
        localStorage.setItem("theme", "dark");
        $("html").attr("data-theme", localStorage["theme"]);
        theme_selector_icon.text("brightness_5");
    } else {

        localStorage.setItem("theme", "light");
        $("html").attr("data-theme", localStorage["theme"]);
        theme_selector_icon.text("brightness_2");
    }
}

function change_category(category) {
    window.location.href = `categories.php?category=${category}`
}

$(document).ready(() => {
    if (localStorage["theme"] == null)
        localStorage.setItem("theme", "light");

    $("html").attr("data-theme", localStorage["theme"]);

    var theme_selector_btn = $(".theme-swapper");
    theme_selector_btn.addClass(localStorage["theme"]);
});

$(".back-button").click(() => {
    window.history.go(-1);
});

$(".result").click((event) => {
    if (event.currentTarget.dataset["id"] != null) {
        window.location.href = `detail.php?id=${event.currentTarget.dataset["id"]}`;
    }
});