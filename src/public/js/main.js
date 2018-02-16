
// Animate from 0 to xxx the count in 1.5 sec
$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).data('number')
    }, {
        duration: 1500,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
