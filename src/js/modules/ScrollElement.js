var scrollToElement = function (el, ms, height) {
    var speed = ms ? ms : 2000;
    let scrollHeight = $(el).offset().top - height;
    $("html,body").animate(
        {
            scrollTop: scrollHeight,
        },
        speed
    );
};

export default scrollToElement