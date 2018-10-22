var products_view = {

    init: function () {
        products_view.events();
    },
    events: function () {
      if($(".quantity_input").val()=='') $(".quantity_input").val(1);

      $('form').submit(function() {

      });

      $(".btn-space").click(function(e) {
          e.preventDefault();
          $("input[name='customer_type_id[]']").val($(this).attr('data-id'));
          $('form').submit();
      })
    },
    product_quantity_change: function (object) {
           var parent = $(object).closest("tr");
           var prod_qty = parseInt($(parent).find("input[name='product_quantity[]']").val());
           var prod_price = parseFloat($(parent).find("input[name='product_price[]']").val());
           console.log($(parent).find("input[name='product_quantity[]']").val());
           var total = prod_qty*prod_price;
           $(parent).find(".price_total").text(total.toFixed(2));
           $(parent).find("input[name='product_total[]']").val(total);
    }
};


$(document).ready(function () {
   products_view.init();
});
