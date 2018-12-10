$(document).ready(function(){
    $('#jas').hide();
    $('#select').on('change',function(){
  
        var selectValor = '#'+$(this).val();
  
         //alert(selectValor);
        $('#jas').show();
        $('#jas').children('div').hide();
  
        $('#jas').children(selectValor).show();
    });
  });