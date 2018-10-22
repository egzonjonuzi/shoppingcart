var shipping_view = {

    init: function () {
        shipping_view.events();

    },
    events: function () {
        $("input[name='shipping_method_id']").change(function () {
            if ($(".shipping_total").length > 0) {
                $(".shipping_total").text($(this).attr('data-price').replace(/[^0-9.]/g, "")+" €");
               var total = 0;
                $(".basket_price").each(function() {
                    total+=parseFloat($(this).text().replace(/[^0-9.]/g, ""));
                });

                $(".final_price").text(total.toFixed(2)+ " €")
            }
        });
        var found_selected = false;
        $("input[name='shipping_method_id']").each(function() {
            if($(this).is(":checked")) {
                found_selected=true;
                return true;
            }
        });
        if(!found_selected) {
            $("input[name='shipping_method_id']").eq(0).prop('checked',true);
            $("input[name='shipping_method_id']").change();
        }
    }
};
$(document).ready(function () {
    shipping_view.init();
});