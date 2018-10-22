var payment_admin = {

    init: function () {
        payment_admin.events();
    },
    events: function () {
        $(".btn_payment_method_add").click(function (e) {

            $(".payment_method_panel").css('display','block');
        });

        $(".btn_add_payment_method_submit").click(function(e) {
            e.preventDefault();
            console.log({payment_method_name:$("#payment_method_name").val(),payment_method_description:$("#payment_method_description").val(),_token:$("input[name='_token']").val()});
            $.ajax({
                type: "POST",
                url: '/admin/payment_method_add',
                data: {payment_method_name:$("#payment_method_name").val(),payment_method_description:$("#payment_method_description").val(),_token:$("input[name='_token']").val()},
                success: function(data){
                    if(data[0]==200) {
                        $("#payment_method_id").html("");
                        $.each(data[2],function(key,value) {
                            $("#payment_method_id").append('<option value="'+value.payment_method_id+'">'+value.payment_method_name+'</option>');
                        });
                        $("#payment_method_id option:last").attr("selected", "selected");
                        $("#payment_method_name").val("");
                        $("#payment_method_description").val("");

                        $(".payment_method_panel").css('display','none');

                    }
                },
                dataType: 'JSON'
            });
        });
    }
}


$(document).ready(function () {
    payment_admin.init();

});
