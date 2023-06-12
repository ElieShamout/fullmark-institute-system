$(document).ready(function() {
    var button_sidebar_state = 1;
    $('.sidebar-btn').html('<i class="bi bi-list"></i>');
    $('.sidebar-btn').click(() => {
        if (button_sidebar_state == 0) {
            button_sidebar_state = 1;
            $('.sidebar-content').animate({
                width: '60px'
            }, 1000);

            $('.sidebar-title').animate({
                marginLeft: '-240px',
            }, 1000);

            $('.sidebar-btn').hide();

            $('.sidebar-btn').html('<i class="bi bi-list"></i>').fadeIn(500);
        } else {
            button_sidebar_state = 0;
            $('.sidebar-content').animate({
                width: '300px'
            }, 1000);

            $('.sidebar-title').animate({
                marginLeft: '0px',
            }, 1000);

            $('.sidebar-btn').hide();

            $('.sidebar-btn').html('<i class="bi bi-x"></i>').fadeIn(500);
        }
    });
});