
function toast(req,title,msg) {
    let stat = req;

    switch(parseInt(req)) {
        case 1:
            stat = 'success';
            break;
        case 2:
            stat = 'warning';
            break;
        case 3:
            stat = 'info';
            break;
        case 0:
            stat = 'error';
            break;
    }

    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "800",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    
    toastr[stat](msg, title); 
}