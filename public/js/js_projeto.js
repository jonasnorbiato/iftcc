
// função da tela cadastrar horario do tcc - coord
$(document).ready(function(){

    $('.data').click(function(){
        let valor = $(this).val();
        if(valor == 'dia'){
            $('#bloco1').toggle('slow');

            if($('#bloco2').css('display') == 'block')
                $('#bloco2').toggle('fast');
        }
        else if(valor == 'semana'){
            $('#bloco2').toggle('slow');
            if($('#bloco1').css('display') == 'block')
                $('#bloco1').toggle('fast');
        }
    });

});


$(document).ready(function(){
   $(".btn-apagar").click( function(event) {
      var apagar = confirm('Deseja realmente excluir este registro?');
      if (apagar){
              
      }else{
         event.preventDefault();
      } 
   });
});


$(function () {
    $('#fupload').change(function() {
         $('.nomeArquivo').html('<b>Arquivo Selecionado:</b>' + $(this).val());
    });
});



