$(document).ready( function() {
   /* Executa a requisição quando o campo CEP perder o foco */
   $('#candidato-cep').blur(function(){
           /* Configura a requisição AJAX */
           $.ajax({
                url : 'consultar_cep.php', /* URL que será chamada */ 
                type : 'POST', /* Tipo da requisição */ 
                data: 'cep=' + $('#candidato-cep').val(), /* dado que será enviado via POST */
                dataType: 'json', /* Tipo de transmissão */
                success: function(data){
                    if(data.sucesso == 1){
                        $('#candidato-endereco').val(data.rua);
                        $('#candidato-bairro').val(data.bairro);
                        $('#candidato-cidade').val(data.cidade);
                        $('#candidato-uf').val(data.estado);
 
                        $('#candidato-datanascimento').focus();
                    }
                },
                error: function(data){
                	console.log("Erro ao Buscar endereço");
                }
           });

   });

    $("#w0").on("beforeSubmit", function (event, messages) {
        return true;
    });

    $('#candidato-datanascimento').focusout(function (date) {
      data = $('#candidato-datanascimento').val();
      var matches = /^(\d{2})[-\/](\d{2})[-\/](\d{4})$/.exec(data);
      if (matches == null){ $('#candidato-datanascimento').val(''); return false; }
      var d = matches[2];
      var m = matches[1] - 1;
      var y = matches[3];
      var composedDate = new Date(y, m, d);
      if(composedDate.getDate() == d && composedDate.getMonth() == m && composedDate.getFullYear() == y)
        return true;
    })


    $('input[name="Candidato[historicoUpload]"]').on('switchChange.bootstrapSwitch', function(data, state) { 
        if(state){
              $('#divHistoricoFile').css('display','block');
        }else{
              $('#divHistoricoFile').css('display','none');
        }
    });

    $('input[name="Candidato[curriculumUpload]"]').on('switchChange.bootstrapSwitch', function(data, state) { 
            if(state){
                  $('#divCurriculumFile').css('display','block');
            }else{
                  $('#divCurriculumFile').css('display','none');
            }
        });

    $('input[name="Candidato[propostaUpload]"]').on('switchChange.bootstrapSwitch', function(data, state) { 
            if(state){
                  $('#divPropostaFile').css('display','block');
            }else{
                  $('#divPropostaFile').css('display','none');
            }
        });

    $('input[name="Candidato[comprovanteUpload]"]').on('switchChange.bootstrapSwitch', function(data, state) { 
            if(state){
                  $('#divComprovanteFile').css('display','block');
            }else{
                  $('#divComprovanteFile').css('display','none');
            }
        });


   $('#candidato-nacionalidade').click(function(){
   		if($( "input[name='Candidato[nacionalidade]']:checked" ).val() == 1){
   			$('#divBrasileiro').css('display', 'block');
   			$('#divEstrangeiro').css('display', 'none');

   		}else{
   			$('#divEstrangeiro').css('display', 'block');
   			$('#divBrasileiro').css('display', 'none');
   		}
   });

  /*Inicio dos campos com radiobutton com campos Ocultos da Carta de Recomendação (VIA EMAIL)*/
   $("input[name='Recomendacoes[conhece][]']" ).change(function(){
      if($("input[name='Recomendacoes[conhece][]']")[3].checked == true){
        $('#outroslugarestexto').css('display', 'block');
      }else{
        $('#outroslugarestexto').val('12');
        $('#outroslugarestexto').css('display', 'none');
      }
   });

  $("input[name='Recomendacoes[funcoesCartaArray][]']").change(function(){
      if($("input[name='Recomendacoes[funcoesCartaArray][]']" )[6].checked == true){
        $('#outrasfuncoestexto').css('display', 'block');
      }else{
        $('#outrasfuncoestexto').css('display', 'none');
      }
  });
  /*Inicio dos campos com radiobutton com campos Ocultos da Carta de Recomendação (VIA EMAIL)*/


  /*Inicio dos campos com botão liga/desliga com campos ocultos do Passo 1*/
  $('input[name="Candidato[cotas]"]').on('switchChange.bootstrapSwitch', function(data, state) { 
      if(state){
      $('#divCotas').fadeToggle('slow');
    }else{
      $('#divCotas').fadeToggle('slow');
    }
  });

  $('input[name="Candidato[deficiencia]"]').on('switchChange.bootstrapSwitch', function(data, state) { 
      if(state){
      $('#divDeficiencia').fadeToggle('slow');
    }else{
      $('#divDeficiencia').fadeToggle('slow');
    }
  });
  /*Fim dos campos com botão liga/desliga com campos ocultos do Passo 1*/

  /*Inicio da Ocultação e Exibição dos Periódios e Conferências (XML)*/
  $('#btnPeriodicos').click(function(){
    $('#divPeriodicos').fadeToggle('slow');
  });

  $('#btnConferencias').click(function() {
    $('#divConferencias').fadeToggle('slow');
  });
  /*Fim da Ocultação e Exibição dos Periódios e Conferências (XML)*/

  /*Inicio Contagem de Caracteres do textArea do Passo 3*/
  $('#txtMotivos').on("input", function () {
    var limite = 1000;
    var caracteresDigitados = $(this).val().length;
    var caracteresRestantes = limite - caracteresDigitados;

    $(".caracteres").text(caracteresRestantes);
  });
  /*Fim Contagem de Caracteres do textArea do Passo 3*/

  /*Inicio dos campos dinâmicos das experiências acadêmicas Passo 2*/
  $('#maisInstituicoes').click(function () {
    if($('#divInstituicao2').css('display') == 'none')
      $('#divInstituicao2').css('display', 'block');
    else if($('#divInstituicao3').css('display') == 'none'){
      $('#divInstituicao3').css('display', 'block');
      $('#maisInstituicoes').css('display', 'none');
  }else
    $('#maisInstituicoes').css('display', 'none');
  });

  $('#removerInstituicao2').click(function(){
    if($('#maisInstituicoes').css('display') == 'none')
      $('#maisInstituicoes').css('display', 'block');
    $('#candidato-instituicaoacademica2').val('');
    $('#candidato-atividade2').val('');
    $('#candidato-periodoacademico2').val('');
    $('#divInstituicao2').css('display', 'none');
  });

  $('#removerInstituicao3').click(function(){
    if($('#maisInstituicoes').css('display') == 'none')
      $('#maisInstituicoes').css('display', 'block');
    $('#candidato-instituicaoacademica3').val('');
    $('#candidato-atividade3').val('');
    $('#candidato-periodoacademico3').val('');
    $('#divInstituicao3').css('display', 'none');
  });
  /*Fim dos campos dinâmicos das experiências acadêmicas Passo 2*/

  /*Inicio dos campos dinâmicos das cartas de Recomendações Passo 3*/
  $('#maisCartasRecomendacoes').click(function(){
    if($('#divCartaRecomendacao0').css('display') == 'none')
      $('#divCartaRecomendacao0').fadeToggle('slow');
    else if($('#divCartaRecomendacao1').css('display') == 'none')
      $('#divCartaRecomendacao1').fadeToggle('slow');
    else if($('#divCartaRecomendacao2').css('display') == 'none'){
      $('#divCartaRecomendacao2').fadeToggle('slow');
      $('#maisCartasRecomendacoes').fadeToggle('slow');
    }else
      $('#maisCartasRecomendacoes').fadeToggle('slow');
 });

  $('#removerCartaRecomendacao0').click(function(){
    if($('#maisCartasRecomendacoes').css('display') == 'none')
      $('#maisCartasRecomendacoes').fadeToggle('slow');
    $('#candidato-cartanome-0').val('');
    $('#candidato-cartaemail-0').val('');
    $('#divCartaRecomendacao0').fadeToggle('slow');
  });

  $('#removerCartaRecomendacao1').click(function(){
    if($('#maisCartasRecomendacoes').css('display') == 'none')
      $('#maisCartasRecomendacoes').fadeToggle('slow');
    $('#candidato-cartanome-1').val('');
    $('#candidato-cartaemail-1').val('');
    $('#divCartaRecomendacao1').fadeToggle('slow');
  });

  $('#removerCartaRecomendacao2').click(function(){
    if($('#maisCartasRecomendacoes').css('display') == 'none')
      $('#maisCartasRecomendacoes').fadeToggle('slow');
    $('#candidato-cartanome-2').val('');
    $('#candidato-cartaemail-2').val('');
    $('#divCartaRecomendacao2').fadeToggle('slow');
  });
  /*Fim dos campos dinâmicos das cartas de Recomendações Passo 3*/

});

$( window ).load(function() {

    if($('#txtMotivos').length && $('#txtMotivos').val().length > 0){
      var limite = 1000;
      var caracteresDigitados = $('#txtMotivos').val().length;
      var caracteresRestantes = limite - caracteresDigitados;

      $(".caracteres").text(caracteresRestantes);
    }

    if($("input[name='Recomendacoes[conhece][]']").length && $("input[name='Recomendacoes[conhece][]']")[3].checked == true){
      $('#outroslugarestexto').css('display', 'block');
    }else{
      $('#outroslugarestexto').css('display', 'none');
    }

    if($("input[name='Recomendacoes[funcoesCartaArray][]']" ).length && $("input[name='Recomendacoes[funcoesCartaArray][]']" )[6].checked == true){
        $('#outrasfuncoestexto').css('display', 'block');
    }else{
      $('#outrasfuncoestexto').css('display', 'none');
    }

    if($( "input[name='Candidato[vinculoemprego]']:checked" ).val() == "SIM"){
        $('#divVinculo').css('display', 'block');
    }

    if($("input[name='Candidato[nacionalidade]']:checked" ).val() == 1){
        $('#divBrasileiro').css('display', 'block');
        $('#divEstrangeiro').css('display', 'none');

    }else if($( "input[name='Candidato[nacionalidade]']:checked" ).val() == 2){
        $('#divEstrangeiro').css('display', 'block');
        $('#divBrasileiro').css('display', 'none');
    }

});

$(function(){
            
  $.jTimeout({
    'flashingTitleText': 'Fim da Sessão',
    'secondsPrior': 100,
    'timeoutAfter': $('#timesession').val(),
    'onClickExtend': function(jTimeout)
    {
      $('.jAlert').closeAlert();
      window.localStorage.timeoutCountdown = $('#timesession').val()
      $('#curTime').val( $('#timesession').val() );
    },
    'extendOnMouseMove': false,
    'loginUrl': 'index.php',
    'logoutUrl': 'index.php',
  });

  var timer,
  setTimer = function(){
    timer = window.setInterval(function(){
      $('#curTime').text( window.localStorage.timeoutCountdown );
    }, 1000);
  };

  setTimer();
});


        function aparecerInputHistorico(){


            if (($('#candidato-historicoupload').is(":checked")).val() == "1"){
                $('#divHistoricoFile').css('display','block');
            }
            else if (($('#candidato-historicoupload').is(":checked")).val() == "0"){
                $('#divHistoricoFile').css('display','none');
              }
        }

        function aparecerInputCurriculum(){

            if ($("input:radio[name='curriculumUpload']:checked").val() == "1"){
                $('#divCurriculumFile').css('display','block');
            }
            else if($("input:radio[name='curriculumUpload']:checked").val() == "0"){
                $('#divCurriculumFile').css('display','none');
              }
        }

        function aparecerInputProposta(){

            if ($("input:radio[name='propostaUpload']:checked").val() == "1"){
                $('#divPropostaFile').css('display','block');
            }
            else if($("input:radio[name='propostaUpload']:checked").val() == "0"){
                $('#divPropostaFile').css('display','none');
              }
        }

        function aparecerInputComprovante(){

            if ($("input:radio[name='comprovanteUpload']:checked").val() == "1"){
                $('#divComprovanteFile').css('display','block');
            }
            else if($("input:radio[name='comprovanteUpload']:checked").val() == "0"){
                $('#divComprovanteFile').css('display','none');
              }
        }