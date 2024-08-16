$(document).ready(function () {
    var usid = $("#id").val();
    readNotification(usid);
    
});

function readNotification(id) {
    $.ajax({
        url: "./ajax/notifications.php",
        method: "POST",
        data: {
            'noti': 1,
            'uid': id
        },
        success: function (data) {
            $("#noti").html(data);
        }
    });
}
function changeNotification(id){
    $.ajax({
        url: "./ajax/notifications.php",
        method: "POST",
        data: {
            'chngnoti': 1,
            'uid': id
        },
        success: function (data) {
            // readNotification(id);
        }
    });
}
