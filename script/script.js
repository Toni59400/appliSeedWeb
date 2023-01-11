function alert_para(text){
    $(".alert-div").append(`<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${text}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>')
}