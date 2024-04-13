<?php

# Credenciais de conexão  
$HOST="localhost"; // Host do banco de dados  
$USER="root"; // Nome de usuário do banco de dados  
$PASS=""; // Senha do banco de dados  
$DB_NAME="db_kidopi_covid19"; // Nome do banco de dados 

$country = $_REQUEST["country"];
if ($country == "") {
  echo '';
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://dev.kidopilabs.com.br/exercicio/covid.php?pais=$country",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

$conn = new mysqli($HOST, $USER, $PASS, $DB_NAME);

if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
};

$sql = "INSERT INTO ultimas_consultas (country, access_time) VALUES ('$country', NOW())";

$stmt = $conn->prepare($sql);
$stmt->execute();

echo $response;

curl_close($curl);
$stmt->close();
$conn->close();
?>
