<?php

// Nome do Arquivo
$filename = $_FILES['file']['name'];

// Localização
$caminho = (string)$_POST['idcontrato'];
mkdir("upload/".$caminho,0777,true);

$location = 'upload/'.$caminho.'/'.$filename;

// Extensão
$file_extension = pathinfo($location, PATHINFO_EXTENSION);
$file_extension = strtolower($file_extension);

//Extensões válidas
$image_ext = array("pdf","zip");

$response = 0;
if(in_array($file_extension,$image_ext)){
  // Upload de Arquivo
  if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
    $response = $location;
  }
}

$serverName = "DESKTOP-GKMDHDU";
$connectionInfo = array( "Database"=>"EsteiraPJ", "UID"=>"", "PWD"=>"");

$conn = sqlsrv_connect($serverName,$connectionInfo);

if($conn){
  $contrato = $_POST["idcontrato"];
  $entrada = (float)$_POST["entrada"];
  $cpd_pgto = (float)$_POST["cpd_pgto"];
  $email = $_POST["email"];
  $telefone = $_POST["telefone"];
  $data = date('Y-m-d');
  $acionamento = 'N';

  $sql ="INSERT INTO Renegociacao VALUES ('$contrato','$entrada','$cpd_pgto','$email','$telefone','$data','$acionamento','$location')";
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

echo $response;