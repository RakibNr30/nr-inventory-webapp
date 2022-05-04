// ckeditor
$(document).ready(function() {
    if (document.getElementById('description')) {
        if(CKEDITOR.instances.description) {
            CKEDITOR.instances.description.destroy();
        }
        CKEDITOR.replace( 'description' );
    }
});

// select2
$('.select2').select2().on('change', function() {
    //$(this).valid();
});

// datepicker
$('.datepicker').datepicker({
    todayHighlight: true,
    format: 'yyyy-mm-dd',
    //startDate: new Date(),
    changeMonth: true,
    changeYear: true,
    autoclose: true
});

// custom file input
$(function () {
    bsCustomFileInput.init();
});
