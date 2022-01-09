<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <title>Esteira Renegociação PJ</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
  </head>
<body>
  <div class="page-header" id="header">
    <h1 id="texto-header"><span id="SR">CIGAD/RE</span> <small id="titulo">Esteira Renegociação PJ</small></h1>
  </div>

  <ul class="nav nav-pills">
    <li role="presentation" class="active"><a href="index.php">Pesquisar Contratos</a></li>
    <li role="presentation"><a href="listaproprios.php">Listagem</a></li>
  </ul>

<div class="container">
  <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Contratos PJ</h3>
      </div>

    <div class="panel-body">
        <div class="form-group">
          <label for="cnpj">CNPJ</label>  
          <input type="text" maxlength=14 class="form-control" id="cnpj" placeholder="CNPJ" name="cnpj" required/>
        </div>
          <h1></h1>
          <button class="btn btn-default" id="btn-pesquisar">Pesquisar</button>
    </div>
  </div>
</div>

<div class="container">
  <table class="table" id="contratos">
    <thead>
      <tr>
        <th scope="col">SR</th>
        <th scope="col">UNO</th>
        <th scope="col">CONTRATO</th>
        <th scope="col">NOME</th>
        <th scope="col">PRODUTO</th>
        <th scope="col">CNPJ</th>
        <th scope="col">VALOR CA</th>
      </tr>
    </thead>
    <tbody id="corpo">
    </tbody>
  </table>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirma Atendimento para Renegociação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method='post' action='' id="data" enctype="multipart/form-data">
          <fieldset>  
            <input type="hidden" name="idcontrato" id="idcontrato" value=""/>
            <label for="entrada">Estimativa de Entrada</label>
            <input type="number" min="0" name="entrada" step="any" class="form-control" id="entrada">
            <label for="capacidade">Estimativa de Capacidade de Pagamento Mensal</label>
            <input type="number" min="0" name="cpd_pgto" step="any" class="form-control" id="cpd_pgto">
            <label for="email">E-mail</label>
            <input type="email" name="email1" class="form-control" id="email1">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" class="form-control telefone" id="telefone">
            <label for="file">Selecionar MO de Capacidade de Pagamento< (Somente aceito em .PDF) </label>
            <input type='file' name='file' id='file' class='form-control'><br>
          </fieldset>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary" id="btn-salvar">Enviar MO de Análise de Capacidade de Pagamento</button>
        </div>
        <div id='preview'></div>
      </form>
    </div>
  </div>
</div>

</body>

<script src="js\jquery.js"></script>
<script src="js\bootstrap.min.js"></script>
<script src="js\consulta.js"></script>
<script src="js\jquery.validate.min.js"></script>
<script src="js\jquery.mask.min.js"></script>

</html>
