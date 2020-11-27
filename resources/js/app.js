require('./bootstrap');

import Echo from "laravel-echo"

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

window.Echo.join(`online`)
    .here((users) => {
        users.forEach( function(user) {
           $('.status-user-'+user.id).removeClass('offline')
        }) 
    })
    .joining((user) => {
         $('.status-user-'+user.id).removeClass('offline')
    })
    .leaving((user) => {
         $('.status-user-'+user.id).addClass('offline')
    });


$('#btn-send-msg').click(function () {
        var msg=$('#text-msg').val();
        var url=$('#text-msg').data('url');
        var name = $('meta[name=user-name]').attr('content');
         $('#boxMessage').append(`
            <div class="d-flex justify-content-end mb-4">
                <div class="msg_cotainer_send">
                <div class="font-weight-bold">Me</div>
                    ${msg}
                </div>
                <div class="img_cont_msg">
                    <img src="https://ui-avatars.com/api/?name=Me" class="rounded-circle user_img_msg">
                </div>
            </div>
            `)
        var data={
            _token:$('meta[name=csrf-token]').attr('content'),
            msg
        }
        $.ajax({
            url:url,
            method:'post',
            data,

        })

        $('#text-msg').val(null);
})


    window.Echo.channel('laravel_database_chat-group')
    .listen('MessageSend', (e) => {
        $('#boxMessage').append(`
            <div class="d-flex justify-content-start mb-4">
                <div class="img_cont_msg">
                    <img src="https://ui-avatars.com/api/?name=${e.message.user.name}" class="rounded-circle user_img_msg">
                </div>
                <div class="msg_cotainer">
                    <div class="font-weight-bold">${e.message.user.name}</div>
                    ${e.message.body}
                </div>
            </div>
            `)
    });
