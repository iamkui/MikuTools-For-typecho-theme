$(document).ready(function() {
    //菜单点击
    $("#menu").click(function(event) {
        $(this).toggleClass('on');
        $(".list").toggleClass('closed');
    });
    $(".index_page").click(function(event) {
        $(".on").removeClass('on');
        $(".list").addClass('closed');
    });
});
