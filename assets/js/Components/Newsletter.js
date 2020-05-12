import {init} from '../app';

class Newsletter {

    constructor()
    {
        this.proccessFooterData();
        init();
    }

    proccessFooterData()
    {
        var thisObject = this;

        $(document).on('click', '#footer-newsletter button', function (e) {
            thisObject._callFooterAjax(e, Routing.generate('newsletterSubscribe'), $(this), thisObject);
        });
    }

    /**
     *
     * @param event
     * @param path
     * @param $this
     * @param thisObj
     * @private
     */
    _callFooterAjax(event, path, $this, thisObj)
    {
        $this.attr('disabled', true);
        event.preventDefault()
        var $newsletter = $('#footer-newsletter');

        $.ajax({
            type        : 'POST',
            data        : $newsletter.serializeArray(),
            url         : path,
            dataType    : 'json',
            beforeSend  : function () {
                $('#footer-newsletter .newsletter-btn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');
            },
            success     : function (data) {
                thisObj._successHandler(data, $this);
            },
            error       : function (error) {
                console.log(error);
            },
            complete    : function () {
                $('#footer-newsletter .newsletter-btn').html('<i class="fa fa-send"></i>')
            }
        });
    }

    /**
     *
     * @param data
     * @param $this
     * @private
     */
    _successHandler(data, $this)
    {
        // console.log(data.response);
        $('#modal-newsletter').modal({
            show: true,
        });
        $this.attr('disabled', false);
        $('#modal-newsletter .modal-body').html(data.response.msg)
    }
}

export default Newsletter;