function info(title, content, color, icon) {
    $.confirm({
        theme: 'material',
        title: title,
        content: content,
        type: color,
        icon: icon,
        typeAnimated: true,
        draggable: true,
        buttons: {
            Info: {
                text: 'Ok',
                btnClass: 'btn-blue'
            }
        }
    });
}
