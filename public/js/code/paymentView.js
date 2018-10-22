var payment_view = {
    init: function () {
        payment_view.events();
    },
    events: function () {
        $("input[name='payment_method_id']").change(function () {
            if ($(".price_total_product").length > 0) {
                var total = 0;
                var total_product = parseFloat($('.price_total_product').attr('data-price'));
                var total_shipping = parseFloat($(".shipping_total").attr('data-price'))
                var total_payment = parseFloat($("input[name='payment_method_id']:checked").attr('data-price'));
                var discount_percentage = parseFloat($("input[name='product_warranty_id']:checked").attr('data-price'));
                if (typeof discount_percentage !== 'undefined') {
                    var total_discount = total_product - (total_product/ (1 + (discount_percentage/100)));
                    $('.warranty_total').text(total_discount.toFixed(2)+ " €");
                    total= (total_product -total_discount);
                    total+=total_payment;
                    total+=total_shipping;
                    $(".grand_total").text(total.toFixed(2)+ " €");
                }
            }
        });
        var found_selected = false;
        $("input[name='payment_method_id']").each(function () {
            if ($(this).is(":checked")) {
                found_selected = true;
                return true;
            }
        });
        if (!found_selected) {
            $("input[name='payment_method_id']").eq(0).prop('checked', true);
            $("input[name='payment_method_id']").change();
        }

        $("input[name='product_warranty_id']").change(function () {
            $("input[name='payment_method_id']").change();
        });
    }
};
$(document).ready(function () {
    payment_view.init();
});