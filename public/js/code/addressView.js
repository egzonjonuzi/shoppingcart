var address_view = {

    init: function () {
        address_view.events();
        address_view.formsubmit();
    },
    events: function () {
        $("#delivery_enabled").change(function () {
            if ($(this).is(":checked")) {
                $(".delivery_panel").find("input[type='text']").each(function () {
                    $(this).val('');
                    $(this).attr('required', '');
                });
                $(".delivery_panel").show();
            } else {
                $(".delivery_panel").hide();
                $(".delivery_panel").find("input[type='text']").each(function () {
                    $(this).removeAttr('required');
                });
            }
        })
    },
    formsubmit: function () {
        $("form").submit(function (event) {

            if (!$('#delivery_enabled').is(":checked")) {
                $(".contact_panel").find("input[type='text']").each(function () {
                    var self = this;
                    $(".delivery_panel").find("input[type='text']").each(function () {
                        if ($(self).attr('name') === $(this).attr('name')) {
                            $(this).val($(self).val());

                            return true;
                        }
                    });
                });
            }

            //event.preventDefault();
            console.log($('form').serializeArray());
        });
    }
};


$(document).ready(function () {
    address_view.init();
});