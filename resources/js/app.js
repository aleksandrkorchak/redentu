require('./bootstrap');

$(function () {
    $('.custom-file-input').on('change',function(){
        var fileName = document.getElementById("customFile").files[0].name;
        $(this).next('.form-control-file').addClass("selected").html(fileName)
    })
})

