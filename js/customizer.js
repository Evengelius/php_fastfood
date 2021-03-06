$("*[data-skin-color]").on("click", function (e) {
    e.preventDefault(), console.log("change skin color"), document.body.className = document.body.className.replace(/(?:(\w+)-?)(\w+)-(skin)/g, ""), $("body").addClass($(this).attr("data-skin-color"));

    /*
     * Get User ID
     * If the current user connected, and defined and exist,
     * It will change the skin color for this current user.
     */
    if (current_user_id != '' && typeof current_user_id != undefined && current_user_id != null) {
        Cookies.set('data-skin-color-' + current_user_id, $(this).attr("data-skin-color"));
        console.log("change skin color")
    }


    // Change the theme for the selected color on change.

}), $('*[name="group1"]').on("change", function () {
    switch (console.log("change skin type"), "background" == $(this).val() ? $("#bg-option").show() : $("#bg-option").hide(), $(this).val()) {
        case"flat":
            $("#slide-out").removeClass("gradient"), document.getElementById("slide-out").className = document.getElementById("slide-out").className.replace(/(sn-bg)-(\w+)/g, ""), $(".sidenav-bg").hide();
            break;
        case"background":
            console.log("background"), $("#slide-out").removeClass("gradient").addClass("sn-bg-" + $('input[name="group2"]:checked').val()), $(".sidenav-bg").show();
            break;
        case"gradient":
            console.log("gradient"), document.getElementById("slide-out").className = document.getElementById("slide-out").className.replace(/(sn-bg)-(\w+)/g, ""), $("#slide-out").addClass("gradient"), $(".sidenav-bg").hide()
    }
}), $('*[name="group2"]').on("change", function () {
    console.log("change bg");
    var e = $('input[name="group2"]:checked').val();
    document.getElementById("slide-out").className = document.getElementById("slide-out").className.replace(/(sn-bg)-(\w+)/g, "sn-bg-" + e)
}), $('*[name="group3"]').on("change", function () {
    console.log("change mask type");
    var e = $('input[name="group3"]:checked').val();
    document.getElementsByClassName("sidenav-bg")[0].className = document.getElementsByClassName("sidenav-bg")[0].className.replace(/(mask)-(\w+)/g, "mask-" + e)
}), $('.switch input[type="checkbox"]').on("change", function (e) {
    console.log("change"), $(this).is(":checked") ? ($("body").addClass("fixed-sn"), $("body").addClass("hidden-sn"), $("ul#slide-out").addClass("fixed"), $(".button-collapse").hide()) : ($("body").removeClass("fixed-sn"), $("body").addClass("hidden-sn"), $("ul#slide-out").removeClass("fixed"), $("ul#slide-out").removeAttr("style"), $(".button-collapse").show())
}), $("#toggle").click(function (e) {
    e.preventDefault(), $("#customizer").toggleClass("visible")
}), $("a[data-skin]").on("click", function (e) {
    e.preventDefault(), document.body.className = document.body.className.replace(/(?:(\w+)-?)(\w+)-(skin)/g, ""), $("body").addClass($(this).attr("data-skin") + "-skin"), $("#toggle").trigger("click")
});