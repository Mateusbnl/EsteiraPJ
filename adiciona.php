<?php


$serverName = "DESKTOP-GKMDHDU";
$connectionInfo = array( "Database"=>"EsteiraPJ", "UID"=>"", "PWD"=>"");

$conn = sqlsrv_connect($serverName,$connectionInfo);

if($conn){
  $contrato = $_POST["idcontrato"];
  printf ($contrato);
  $entrada = (float)$_POST["entrada"];
  $cpd_pgto = (float)$_POST["cpd_pgto"];
  $email = $_POST["email"];
  $telefone = $_POST["telefone"];
  $data = date('Y-m-d');
  $acionamento = 0;

  $sql ="INSERT INTO Renegociacao VALUES ('$contrato','$entrada','$cpd_pgto','$email','$telefone','$data','$acionamento')";
  $stmt = sqlsrv_query($conn, $sql);


  if( $stmt === false ) {
        if( ($errors = sqlsrv_errors() ) != null) {
            foreach( $errors as $error ) {
                echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
                echo "code: ".$error[ 'code']."<br />";
                echo "message: ".$error[ 'message']."<br />";
            }
        }
    }
}else{
  Echo"Não conectou :( <br>";
  die(print_r(sqlsrv_errors(),true));
sqlsrv_free_stmt( $stmt);
}

?>
