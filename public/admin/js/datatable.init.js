$(document).ready(function () {
    // datatable initialization event
    $(document).on('draw.dt', function () {
        // activating delete popover
        $(".btn-delete").popover({
            html : true,
            trigger: 'focus',
            placement: 'bottom',
            content: function() {
                var content = $(this).attr("data-popover-content");
                return $(content).children(".popover-body").html();
            }
        });
        // delete button action
        $('#data_table tbody').on('click', '.btn-delete', function (e) {
            $(".btn-delete").popover().on('shown.bs.popover', function(e) {
                $('.delete_submit').click(function () {
                    let id = $(this).attr('class').split(' ').pop();
                    $('#delete_form' + id).submit();
                });
            });
        });
    });
});
