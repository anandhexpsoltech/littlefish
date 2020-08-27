jQuery(document).ready(function ($) {
    $(document).delegate('.wpdiscuz-option-smile', 'click', function () {
        if (!$(this).hasClass('no-click')) {
            var smile = $(this);
            $('.wpdiscuz-option-smile').addClass('no-click');
            var key = smile.data('emoticon-code');
            var status;
            if (smile.hasClass('disabled')) {
                status = 'enable';
            } else {
                status = 'disable';
            }
            disableOrEnableSmile(key, status).done(function (response) {
                if (response == 1) {
                    smile.toggleClass('disabled');
                }
                $('.wpdiscuz-option-smile').removeClass('no-click');
            });
        }
    });

    $(document).delegate('#custom-smile-button', 'click', function () {
        var code = $('#custom-smile-code').val();
        var url = $('#custom-smile-url').val();
        if (code.length && url.length) {
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    code: code,
                    iconurl: url,
                    action: 'add_custom_smile'
                }
            }).done(function (response) {
                $('.add-custom-smile').before(response);
                $('#custom-smile-code').val('');
                $('#custom-smile-url').val('');
            });
        } else {
            alert(wpdiscuz_smile_obj.wpdiscuz_smile_options.fill_required);
        }
    });

    $(document).delegate('.delete-custom-smile', 'click', function () {
        var id = $(this).attr('id');
        var code = $('#smile_' + id).data('emoticon-code');
        if (code.length) {
            $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                    code: code,
                    action: 'delete_custom_smile'
                }
            }).done(function (response) {
                if (response == 1) {
                    $('#custom_smile_container_' + id).remove();
                }
            });
        }
    });

    $('.show-smile-instruction').click(function(){
        $('#custom-smile-instruction').toggle("slow");
        $(this).hide();
    });
    
     $('.hide-smile-instruction').click(function(){
        $('#custom-smile-instruction').toggle("slow");
        $('.show-smile-instruction').show();
    });

    function disableOrEnableSmile(key, status) {
        return  $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                key: key,
                status: status,
                action: 'enable_or_disable_smile'
            }
        });
    }
});
