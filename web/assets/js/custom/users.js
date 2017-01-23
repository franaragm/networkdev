$(document).ready(function () {

    var ias = jQuery.ias({
        container: '.box-users',
        item: '.user-item',
        pagination: '.pagination',
        next: '.pagination .next_link',
        triggerPageThreshold: 5
    });

    ias.extension(new IASTriggerExtension({
        text: 'Ver más personas',
        offset: 3
    }));

    ias.extension(new IASSpinnerExtension({
        src: URL+'/../assets/images/ajax-loader.gif' // modificar fuera de app_dev.php
    }));

    ias.extension(new IASNoneLeftExtension({
        text: 'No hay más personas'
    }));

    ias.on('ready', function(event) {
        followButtons();
    });

    ias.on('rendered', function(event) {
        followButtons();
    });

});