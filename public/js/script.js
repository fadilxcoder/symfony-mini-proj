// Newsletter
/*

function callFooterAjax(event, path, $this)
{
    $this.attr('disabled', true);
    event.preventDefault()
    var $newsletter = $('#footer-newsletter');

    $.ajax({
        type        : 'POST',
        data        : $newsletter.serializeArray(),
        url         : path,
        dataType    : 'json',
        beforeSend  : function(){
            $('#footer-newsletter .newsletter-btn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');
        },
        success     : function (data) {
            successHandler(data, $this);
        },
        error       : function(error) {
            console.log(error);
        },
        complete    : function() {
            $('#footer-newsletter .newsletter-btn').html('<i class="fa fa-send"></i>')
        }
    });
}

function successHandler(data, $this)
{
    console.log(data.response);
    $('#modal-newsletter').modal({
        show: true,
    });
    $this.attr('disabled', false);
    $('#modal-newsletter .modal-body').html(data.response.msg)
}

*/
