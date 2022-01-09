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
    <li role="presentation"><a href="index.php">Pesquisar Contratos</a></li>
    <li role="presentation"  class="active"><a href="listaproprios.php">Listagem</a></li>
  </ul>

<div class="container">
  <table class="table table-bordered" id="contratos">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">SR</th>
        <th scope="col">UNO</th>
        <th scope="col">CONTRATO</th>
        <th scope="col">NOME</th>
        <th scope="col">PRODUTO</th>
        <th scope="col">CNPJ</th>
        <th scope="col">VALOR CA</th>
        <th scope="col">Entrada Estimada</th>
        <th scope="col">Capacidade Mensal Estimada</th>
        <th scope="col">Email</th>
        <th scope="col">Telefone</th>
        <th scope="col">Acionamento</th>
      </tr>
    </thead>
    <tbody id="corpo">
    </tbody>
  </table>
</div>


</body>

<script src="js\jquery.js"></script>
<script src="js\bootstrap.min.js"></script>
<script src="js\listagem.js"></script>

</html>