/**
 * Created by serhi on 30-Mar-16.
 */
$(document).ready(function(){
    setInterval(function(){
        $.ajax({
            type: 'GET',
            url: '/application/check.php',
            data: {action: 'checktime'},
            success: function (data) {
                if (data.length > 0 && data == 0){
                    window.alert('Your session is over!');
                    window.location.href="/application/logout.php";
                }
            }
        });
    },3*1000);
});