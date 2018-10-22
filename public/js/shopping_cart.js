$(document).ready(function () {
    $('.quantity_input').prop('readonly', true);
    $('.plus-btn').click(function () {
        $(this).parent("div").parent("div").find('.quantity_input').val(parseInt($(this).parent("div").parent("div").find('.quantity_input').val()) + 1);
        products_view.product_quantity_change($(this));
    });
    $('.minus-btn').click(function () {
        $(this).parent("div").parent("div").find('.quantity_input').val(parseInt($(this).parent("div").parent("div").find('.quantity_input').val()) - 1);
        if ($(this).parent("div").parent("div").find('.quantity_input').val() == 0) {
            $(this).parent("div").parent("div").find('.quantity_input').val(1);
        }

        products_view.product_quantity_change($(this));

    });
});

$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();

    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);

        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.nav-tabs li>a.active');
        $active.parent().next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.nav-tabs li>a.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).parent().next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).parent().prev().find('a[data-toggle="tab"]').click();
}