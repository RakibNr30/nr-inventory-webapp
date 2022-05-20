<div style="width: 100px">
    <input type="checkbox" name="is_shipped_out" id="is_shipped_out_{{ $data->id }}"
           {{ $data->is_shipped_out ? 'checked' : '' }}
           data-bootstrap-switch
           data-on-text="YES"
           data-off-text="NO"
    >
</div>

<script>
    $("input[data-bootstrap-switch]").each(function(){
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

    $("input[id=is_shipped_out_{{ $data->id }}]").on('switchChange.bootstrapSwitch',function (e, data) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token()}}'
            }
        });
        $.ajax({
            url: '{{ route('backend.cms.logistic.shipping-status.update', [$data->id]) }}',
            method: 'POST',
            data: {
                is_shipped_out: data ? 1 : 0
            },
            success: function(){}
        })
    });
</script>

<style>
    .bootstrap-switch .bootstrap-switch-handle-off, .bootstrap-switch .bootstrap-switch-handle-on, .bootstrap-switch .bootstrap-switch-label {
        font-size: 12px !important;
    }
</style>
