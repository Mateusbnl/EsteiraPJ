
$('.Operação').empty();
$.ajax({
  type:'POST',
  url:'consultaproprios.php',
  data: {action:'consultar'}
}).done(function(data){
  data.forEach(function(op){
    adicionaOpNaTabela(op);
  });
}).fail(function(jqXHR, textStatus){
  console.log("Algo deu errado: " + textStatus);
});
  
  
  function adicionaOpNaTabela(op){
    var tabela = document.querySelector("#corpo");
    var opTr = montaTr(op);
    tabela.appendChild(opTr);
  }
  
  
  function montaTr(op){
    var operacaoTr = document.createElement("tr");
    var coluna = document.createElement("th");
    coluna.setAttribute("scope","row");
    coluna.textContent = op.id;
  
    operacaoTr.classList.add("Operação");

    operacaoTr.appendChild(coluna);
    operacaoTr.appendChild(montaTd(op.SR,"info-sr"));
    operacaoTr.appendChild(montaTd(op.UNO,"info-unidade"));
    operacaoTr.appendChild(montaTd(op.Contrato,"info-contrato"));
    operacaoTr.appendChild(montaTd(op.Nome,"info-nome"));
    operacaoTr.appendChild(montaTd(op.Produto,"info-produto"));
    operacaoTr.appendChild(montaTd(op.CNPJ,"info-cnpj"));
    operacaoTr.appendChild(montaTd(op.VALOR_CA,"info-valorca"));
    operacaoTr.appendChild(montaTd(op.entrada,"info-entrada"));
    operacaoTr.appendChild(montaTd(op.cpd_pgto_mensal,"info-cpdpgto"));
    operacaoTr.appendChild(montaTd(op.email,"info-email"));
    operacaoTr.appendChild(montaTd(op.telefone,"info-telefone"));
    operacaoTr.appendChild(montaTd(op.acionado,"info-acionamento"));

  
    var botao = document.createElement("a");
    var icon = document.createElement("span");
    icon.className = "glyphicon glyphicon-download-alt";
    botao.className = "btn btn-default";
    botao.setAttribute('href',op.caminho);

    var botaoac = document.createElement("button");
    var icon1 = document.createElement("span");
    icon1.className = "glyphicon glyphicon-ok";
    botaoac.className = "btn btn-default";
    botaoac.setAttribute('href',op.caminho);

    var botaoex = document.createElement("a");
    var icon2 = document.createElement("span");
    icon2.className = "glyphicon glyphicon-remove";
    botaoex.className = "btn btn-default";
    botaoex.setAttribute('id',op.id)
    botaoex.addEventListener("click", function(event){
      $.ajax({
        url: "consultaproprios.php",
        type: "post",
        data: {"id":  op.id, action: 'deletar' },
        success: location.reload()
      });
    });

  
    botao.appendChild(icon);
    botaoac.appendChild(icon1);
    botaoex.appendChild(icon2);

    operacaoTr.appendChild(botao);
    operacaoTr.appendChild(botaoac);
    operacaoTr.appendChild(botaoex);
  
    return operacaoTr;
  }
  
  function montaTd(dado,classe){
    var td = document.createElement("td");
    td.classList.add(classe);
    td.textContent=dado;
  
    return td;
  }
