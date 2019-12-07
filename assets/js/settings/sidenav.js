function verify_menu(token) {
    $.ajax({
        type: "GET",
        url: base_url() + '/ajax/menu',  
        beforeSend: function (xhr) {
            xhr.setRequestHeader ("Authorization", token);
        }
    }).done(function (res) {
        $.each(JSON.parse(res), function(i, data) {
            if ( data.allowed ) {
                $.each(data.allowed, function(i, item) {
                    // alert(JSON.stringify(item));
                    $('#'+item).css("display","block")
                });
                
            } 
            if (data.denied) {
                $.each(data.denied, function(i, item) {
                    $('#'+item).remove();
                });
            }
        });
        // alert(JSON.stringify(JSON.parse(res).denied));
    }).fail(function (err)  {
        console.log('Not Authorized!');
    });
}

function active(val, token) {
    // var token = token;

    $("#home").removeClass('active');
    $("#profile").removeClass('active');
    $("#approval").removeClass('active');
    $("#summary").removeClass('active');
    $("#today").removeClass('active');
    $("#lresearch").removeClass('active');
    $("#lgeneral").removeClass('active');
    $("#overtime").removeClass('active');
    $("#leave").removeClass('active');
    $("#la").removeClass('active');
    $("#employees").removeClass('active');

    switch (val) {
        case "profile" :
            $("#profile").addClass('active');

            var html = '<li><i class="fa fa-user-md"></i> My Profile</li><li class="active">Profile</li>';
            $("#breadcrumb").html(html);

            $.ajax({
                type: "GET",
                url: base_url() + '/ajax/view/profile/',  
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                }
            }).done(function (res) {
                $("#content").html(res);
            }).fail(function (err)  {
                toast(2 , "Warning :", "Sorry, it looks like you are not authorized to access the data!");
            });

            break;
        case "approval" :
            $("#approval").addClass('active');

            var html = '<li><i class="fa fa-thumbs-o-up"></i> Approval</li><li class="active">Approval</li>';
            $("#breadcrumb").html(html);

            $.ajax({
                type: "GET",
                url: base_url() + '/ajax/view/approval/',  
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                }
            }).done(function (res) {
                $("#content").html(res);
            }).fail(function (err)  {
                toast(2 , "Warning :", "Sorry, it looks like you are not authorized to access the data!");
            });

            break;
        case "summary" :
            $("#summary").addClass('active');

            var html = '<li><i class="fa fa-info-circle text-green"></i> Summary</li><li class="active">Summary</li>';
            $("#breadcrumb").html(html);

            $.ajax({
                type: "GET",
                url: base_url() + '/ajax/view/summary/',  
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                }
            }).done(function (res) {
                $("#content").html(res);
            }).fail(function (err)  {
                toast(2 , "Warning :", "Sorry, it looks like you are not authorized to access the data!");
            });

            break;
        case "today" :
            $("#today").addClass('active');

            var html = '<li><i class="fa fa-info-circle text-yellow"></i> RECFON Info</li><li class="active">Summary</li>';
            $("#breadcrumb").html(html);

            $.ajax({
                type: "GET",
                url: base_url() + '/ajax/view/recfontoday/',  
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                }
            }).done(function (res) {
                $("#content").html(res);
            }).fail(function (err)  {
                toast(2 , "Warning :", "Sorry, it looks like you are not authorized to access the data!");
            });

            break;
        case "lresearch" :
            $("#lresearch").addClass('active');
            $("#la").addClass('active');

            var html = '<li><i class="fa fa-send"></i> Leave Application</li><li class="active">Research</li>';
            $("#breadcrumb").html(html);

            $.ajax({
                type: "GET",
                url: base_url() + '/ajax/view/research/',  
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                }
            }).done(function (res) {
                $("#content").html(res);
            }).fail(function (err)  {
                toast(2 , "Warning :", "Sorry, it looks like you are not authorized to access the data!");
            });

            break;
        case "lgeneral" :
            $("#lgeneral").addClass('active');
            $("#la").addClass('active');

            var html = '<li><i class="fa fa-send"></i> Leave Application</li><li class="active">General</li>';
            $("#breadcrumb").html(html);

            $.ajax({
                type: "GET",
                url: base_url() + '/ajax/view/general/',  
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                }
            }).done(function (res) {
                $("#content").html(res);
            }).fail(function (err)  {
                toast(2 , "Warning :", "Sorry, it looks like you are not authorized to access the data!");
            });

            break;
        case "overtime" :
            $("#overtime").addClass('active');
            $("#la").addClass('active');

            var html = '<li><i class="fa fa-send"></i> Leave Application</li><li class="active">Overtime</li>';
            $("#breadcrumb").html(html);

            $.ajax({
                type: "GET",
                url: base_url() + '/ajax/view/overtime/',  
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                }
            }).done(function (res) {
                $("#content").html(res);
            }).fail(function (err)  {
                toast(2 , "Warning :", "Sorry, it looks like you are not authorized to access the data!");
            });

            break;
        case "leave" :
            $("#leave").addClass('active');
            $("#la").addClass('active');

            var html = '<li><i class="fa fa-send"></i> Leave Application</li><li class="active">Leave</li>';
            $("#breadcrumb").html(html);

            $.ajax({
                type: "GET",
                url: base_url() + '/ajax/view/leave/',  
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                }
            }).done(function (res) {
                $("#content").html(res);
            }).fail(function (err)  {
                toast(2 , "Warning :", "Sorry, it looks like you are not authorized to access the data!");
            });

            break;
        case "employees" :
            $("#employees").addClass('active');
            
            var html = '<li><i class="mdi mdi-business"></i> Employees</li><li class="active">Data Employees</li>';
            $("#breadcrumb").html(html);

            $.ajax({
                type: "GET",
                url: base_url() + '/ajax/view/employees/',  
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                }
            }).done(function (res) {
                $("#content").html(res);
            }).fail(function (err)  {
                toast(2 , "Warning :", "Sorry, it looks like you are not authorized to access the data!");
            });

            break;
        default:
            
            $("#home").addClass('active');
            
            var html = '<li><i class="fa fa-home"></i> Home</li><li class="active">Dashboard</li>';
            $("#breadcrumb").html(html);

            $.ajax({
                type: "GET",
                url: base_url() + '/ajax/view/home/',  
                beforeSend: function (xhr) {
                    xhr.setRequestHeader ("Authorization", token);
                }
            }).done(function (res) {
                $("#content").html(res);
            }).fail(function (err)  {
                toast(2 , "Warning :", "Sorry, it looks like you are not authorized to access the data!");
            });
    }
}