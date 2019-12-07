$("#login-form").submit(function(e) {
    e.preventDefault();

    $.ajax({
        type : 'POST', 
        url  : base_url() + '/auth/login', 
        data : $("#login-form").serializeArray(),
        success: function(data){
            if (data === '1') {
                window.location = base_url();
            } else if (data === '0') {
                alerts("orange", "fa fa-warning", "Sorry! ", "<b>Your email or password is wrong!");
            } else if (data === '2') {
                alerts("red", "fa fa-warning", "Sorry! ", "<b>Your email not found!</b>");
            } else if (data === '3') {
                alerts("red", "fa fa-warning", "Sorry! ", "<b>Your password is not setting up!<br><br> Note: </b> Please login with your google account and setting up your password to use manual login or contact the Administrator.");
            } else {
                alerts("red", "fa fa-warning", "Sorry! ", data);
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            toast(0 , "Error :", errorThrown);
        }
    });
});

function alerts($color, $icon, $title, $msg) {
    $.alert({
        theme: 'material',
        title: $title,
        content: $msg,
        type: $color,
        icon: $icon,
        typeAnimated: true,
        draggable: true,
    });
}
