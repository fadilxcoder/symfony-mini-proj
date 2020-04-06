
// Checking JQuery
console.log(jQuery('#footer-area .widget-body a').text());

// Newsletter
function callFooterAjax(event, path)
{
    event.preventDefault()
    var $newsletter = $('#footer-newsletter');

    $.ajax({
        type    : 'POST',
        data    : $newsletter.serializeArray(),
        url     : path,
        dataType: 'json',
        success : function (data) {
            successHandler(data);
        }
    });
}

function successHandler(data)
{
    console.log(data);
    $('#modal-newsletter').modal({
        show: true,
    });
}

// module.exports = {
//     callFooterAjax
// }
