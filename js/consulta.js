function validarCNPJ(cnpj) {
 
  cnpj = cnpj.replace(/[^\d]+/g,'');

  if(cnpj == '') return false;
   
  if (cnpj.length != 14)
      return false;

  // Elimina CNPJs invalidos conhecidos
  if (cnpj == "00000000000000" || 
      cnpj == "11111111111111" || 
      cnpj == "22222222222222" || 
      cnpj == "33333333333333" || 
      cnpj == "44444444444444" || 
      cnpj == "55555555555555" || 
      cnpj == "66666666666666" || 
      cnpj == "77777777777777" || 
      cnpj == "88888888888888" || 
      cnpj == "99999999999999")
      return false;
       
  // Valida DVs
  tamanho = cnpj.length - 2
  numeros = cnpj.substring(0,tamanho);
  digitos = cnpj.substring(tamanho);
  soma = 0;
  pos = tamanho - 7;
  for (i = tamanho; i >= 1; i--) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2)
          pos = 9;
  }
  resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
  if (resultado != digitos.charAt(0))
      return false;
       
  tamanho = tamanho + 1;
  numeros = cnpj.substring(0,tamanho);
  soma = 0;
  pos = tamanho - 7;
  for (i = tamanho; i >= 1; i--) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2)
          pos = 9;
  }
  resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
  if (resultado != digitos.charAt(1))
        return false;
         
  return true;
  
}


$("#btn-pesquisar").click(function(){
    if(validarCNPJ($("#cnpj").val())){
    consulta();
    }else{
      alert("CNPJ Inválido");
    }
});



$(document).ready(function(){

  jQuery("input.telefone")
  .mask("(99) 9999-99999")
  .focusout(function (event) {  
      var target, phone, element;  
      target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
      phone = target.value.replace(/\D/g, '');
      element = $(target);  
      element.unmask();  
      if(phone.length > 10) {  
          element.mask("(99) 99999-9999");  
      } else {  
          element.mask("(99) 9999-99999");  
      }  
  });

$("#data").validate(
  {
    rules: {
      entrada: {
        required: true
      },
      cpd_pgto: {
        required: true
      },
      email1: {
        required: true,
        email: true
      },
      telefone:{
        required: true
      },
      file:{
        required: true
      }
    }, 
    messages: {
      entrada: {
        required: "Informar um valor estimado para entrada",
        number:"Informar valor válido"
      },
      cpd_pgto: {
        required: "Informar um valor estimado de pagamento mensal",
        number:"Informar valor válido"
      },
      email1: {
        required: "Informar um email para contato com o cliente"
      },
      telefone:{
        required: "Informar um telefone para contato com o cliente"
      },
      file:{
        required: "Obrigatório anexar MO de capacidade de pagamento para análise"
      }
    },
      highlight: function(element) {
      $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
      },
      success: function(element) {
          $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
      },
      errorClass: 'help-block'
})

$('#btn-salvar').click(function(){
  if($("#data").valid()){
    var fd = new FormData();
    var files = $('#file')[0].files[0];

    if(files.size > 1048576){
      alert('Arquivo tem que ser menor que 1mb')
    }else{

    fd.append('file',files)
    fd.append('idcontrato', $("#idcontrato").val());
    fd.append('entrada', $("#entrada").val());
    fd.append('cpd_pgto', $("#cpd_pgto").val());
    fd.append('email', $("#email1").val());
    fd.append('telefone', $("#telefone").val());

    $.ajax({
      url: 'ajaxfile.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      sucess: function(response){
        if(response !=0){
          $('#preview').append("<img src='"+response+"' width='100' height='100' style='display:inline-block;'>");
          alert("Cadastrado com Sucesso");
        }else{
          alert("Erro na transmissão do arquivo");
        }
      },
    });
  }
  }
  });
});

$(document).on("click",".addContrato", function(){
  var idcontrato = $(this).data('id');
  $(".modal-body #idcontrato").val(idcontrato);
});

function consulta(){
  $('.Operação').empty();
    $.ajax({
      type:'POST',
      url:'consulta.php',
      data: { cnpj: $("#cnpj").val() },
    }).done(function(data){
      data.forEach(function(op){
        adicionaOpNaTabela(op);
      });
    }).fail(function(jqXHR, textStatus){
      console.log("Algo deu errado: " + textStatus);
    });
  }

function adicionaOpNaTabela(op){
  var tabela = document.querySelector("#contratos");
  var opTr = montaTr(op);
  tabela.appendChild(opTr);
}


function montaTr(op){
  var operacaoTr = document.createElement("tr");

  operacaoTr.classList.add("Operação");

  operacaoTr.appendChild(montaTd(op.SR,"info-sr"));
  operacaoTr.appendChild(montaTd(op.UNO,"info-unidade"));
  operacaoTr.appendChild(montaTd(op.Contrato,"info-contrato"));
  operacaoTr.appendChild(montaTd(op.Nome,"info-nome"));
  operacaoTr.appendChild(montaTd(op.Produto,"info-produto"));
  operacaoTr.appendChild(montaTd(op.CNPJ,"info-cnpj"));
  operacaoTr.appendChild(montaTd(op.VALOR_CA,"info-valorca"));


  var botao = document.createElement("button");

  var icon = document.createElement("span");
  icon.className = "glyphicon glyphicon-open";

  botao.type = "button";
  botao.className = "addContrato btn btn-default";
  botao.setAttribute('data-toggle','modal');
  botao.setAttribute('data-target','#exampleModal');
  botao.setAttribute('data-id',op.Contrato);

  botao.appendChild(icon);
  // remove(botao);
  operacaoTr.appendChild(botao);

  return operacaoTr;
}

function montaTd(dado,classe){
  var td = document.createElement("td");
  td.classList.add(classe);
  td.textContent=dado;

  return td;
}

// function atualizaTab(){
//       $.get({
//         dataType:"json",
//         url: "consulta.php",
//         success: function(retorno){
//                 retorno.forEach(function(op){
//                 adicionaOpNaTabela(op);
//                 })
//           }
//       });
// }

// function remove(btn){
//   btn.addEventListener("click", function(event){
//       $.ajax({
//         async: true,
//         url: "remove.php",
//         type: "post",
//         data: {"id":  event.target.value },
//         sucess: location.reload(),
//       });
//     });
// }
