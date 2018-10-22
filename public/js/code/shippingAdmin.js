var shipping_admin = {

    init: function () {
        shipping_admin.events();
    },
    events: function () {
        $(".btn_shipping_method_add").click(function (e) {

            $(".shipping_method_panel").css('display','block');
        });

        $(".btn_add_shipping_method_submit").click(function(e) {
           e.preventDefault();
           console.log({shipping_method_name:$("#shipping_method_name").val(),shipping_method_description:$("#shipping_method_description").val(),_token:$("input[name='_token']").val()});
            $.ajax({
                type: "POST",
                url: '/admin/shipping_method_add',
                data: {shipping_method_name:$("#shipping_method_name").val(),shipping_method_description:$("#shipping_method_description").val(),_token:$("input[name='_token']").val()},
                success: function(data){
                    if(data[0]==200) {
                        $("#shipping_method_id").html("");
                        $.each(data[2],function(key,value) {
                            $("#shipping_method_id").append('<option value="'+value.shipping_method_id+'">'+value.shipping_method_name+'</option>');
                        });
                        $("#shipping_method_id option:last").attr("selected", "selected");
                        $("#shipping_method_name").val("");
                        $("#shipping_method_description").val("");

                        $(".shipping_method_panel").css('display','none');

                    }
                },
                dataType: 'JSON'
            });
        });
    }
}


$(document).ready(function () {
    shipping_admin.init();

});
