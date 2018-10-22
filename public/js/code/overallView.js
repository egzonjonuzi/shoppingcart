var overall_view = {

    init: function () {

        overall_view.formsubmit();
    },
    formsubmit:function() {
        $("form").submit(function (e) {
            $("form").waitMe({text : 'Proccessing order. Please wait',fontSize : '25px'});
        });
    }

};

$(document).ready(function () {
    overall_view.init();

});