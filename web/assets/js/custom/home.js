$(document).ready(function () {

    var ias = jQuery.ias({
        container: '#timeline .box-content',
        item: '.publication-item',
        pagination: '#timeline .pagination',
        next: '#timeline .pagination .next_link',
        triggerPageThreshold: 5
    });

    ias.extension(new IASTriggerExtension({
        text: 'Ver más publicaciones',
        offset: 3
    }));

    ias.extension(new IASSpinnerExtension({
        src: URL+'/../assets/images/ajax-loader.gif' // modificar fuera de app_dev.php
    }));

    ias.extension(new IASNoneLeftExtension({
        text: 'No hay más publicaciones'
    }));

    ias.on('ready', function(event) {
        buttons();
    });

    ias.on('rendered', function(event) {
        buttons();
    });

});


function buttons() {

    $(".btn-img").unbind("click").click(function () {
       $(this).parent().find('.pub-image').fadeToggle();
    });

    $(".btn-delete-pub").unbind("click").click(function () {
       $(this).parent().parent().addClass('hidden');

        $.ajax({
            url: URL+'/publication/remove/'+$(this).attr("data-id"),
            type: 'GET',
            success: function (response) {
                console.log(response);
            }
        });
    });
}