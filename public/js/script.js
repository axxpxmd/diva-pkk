function reload(){
    $.confirm({
        title: 'Oops...',
        content: 'Terdapat kesalahan saat pengiriman data, Segarkan halaman ini?',
        icon: 'bi bi-arrow-clockwise',
        theme: 'supervan',
        closeIcon: true,
        animation: 'scale',
        type: 'orange',
        autoClose: 'ok|10000',
        escapeKey: 'cancelAction',
        buttons: {   
            ok: {
                text: "ok!",
                btnClass: 'btn-primary',
                keys: ['enter'],
                action: function(){
                    document.location.reload();
                }
            },
            cancel: function(){
                console.log('the user clicked cancel');
            }
        }
    });
}

function success(message) {
    $.confirm({
        title: 'Sukses',
        content: message,
        icon: 'bi bi-check',
        theme: 'modern',
        closeIcon: true,
        animation: 'scale',
        autoClose: 'ok|3000',
        type: 'green',
        buttons: {
            ok: {
                text: "ok!",
                btnClass: 'btn-primary',
                keys: ['enter']
            }
        }
    });
}

$(document).ready(function() {
    $('.select2').select2();
});