<?php

// Credenciais de conexão
$host = 'localhost'; // Host do banco de dados
$user = 'root'; // Nome de usuário do banco de dados
$pass = ''; // Senha do banco de dados
$db_name = 'db_kidopi_covid19'; // Nome do banco de dados

$conn = new mysqli($host, $user, $pass, $db_name);

$sql = "SELECT * FROM ultimas_consultas ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
          
    while($row = $result->fetch_assoc()) {
      echo json_encode($row);
    }
  } else {
    echo json_encode("Não existe consultas registradas no momento.");
  }

  $conn->close();
?>