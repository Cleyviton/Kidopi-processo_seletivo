<?php

// Credenciais de conexão
$host = 'localhost'; // Host do banco de dados
$user = 'root'; // Nome de usuário do banco de dados
$pass = ''; // Senha do banco de dados
$db_name = 'db_kidopi_covid19'; // Nome do banco de dados

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

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
};

$dataLocal = date('Y-m-d H:i:s');
$sql = "INSERT INTO ultimas_consultas (country, access_time) VALUES ('$country', NOW())";

$stmt = $conn->prepare($sql);
$stmt->execute();


echo $response;


curl_close($curl);
$stmt->close();
$conn->close();
?>