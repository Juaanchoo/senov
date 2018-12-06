$("#file1").change(function(){

    $(this).removeClass('dangerNovedad');
    $(this).removeClass('successNovedad');

    var archivo = $(this).val();
    var extensiones = archivo.substring(archivo.lastIndexOf("."));
    
    if(extensiones != ".doc" && extensiones != ".docx"){
        $(this).addClass('dangerNovedad');
        smsError = "<b>¡Ops!</b> El archivo de tipo <b>" + extensiones + "</b> no es válido";
    }else{
        $('#inputval').text( $(this).val());
    }

    $("#smsFile").empty();
    if($(this).hasClass('dangerNovedad') && smsError != ""){

        $("#smsFile").addClass('smsDanger');
        $("#smsFile").append(smsError);

    }else{

        $("#smsFile").removeClass('smsDanger');
        $("#smsFile").empty();

    }

});