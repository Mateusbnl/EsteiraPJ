<?php

$serverName = "DESKTOP-GKMDHDU";
$connectionInfo = array( "Database"=>"EsteiraPJ", "UID"=>"sa", "PWD"=>"706288");
$conn = sqlsrv_connect($serverName,$connectionInfo);

if($conn){

switch($_POST['action']){

  case 'consultar':

      $sql = "SELECT * from BasePJ RIGHT JOIN Renegociacao ON BasePJ.contrato = Renegociacao.contrato;";
      $stmt = sqlsrv_query($conn, $sql);
      $dados= array();
  
      while($resultado = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
        $dados[] = $resultado;
      }

      header('Content-type: application/json');
      $data = convert_to_utf8_recursively($dados);
      $encodedJSON = json_encode($data); if ($encodedJSON === false) echo json_last_error_msg(); else echo $encodedJSON;

      sqlsrv_free_stmt( $stmt);

  break;

  case 'deletar':

    $id = $_POST['id'];
    $sql = "DELETE FROM Renegociacao WHERE id=$id";
    $stmt = sqlsrv_query($conn, $sql);

  break;

}if( $stmt === false ) {
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

function convert_to_utf8_recursively($dat){
  if( is_string($dat) ){
    return mb_convert_encoding($dat, 'UTF-8', 'UTF-8');
  }
  elseif( is_array($dat) ){
    $ret = [];
    foreach($dat as $i => $d){
      $ret[$i] = convert_to_utf8_recursively($d);
    }
    return $ret;
  }
  else{
    return $dat;
  }
}

?>