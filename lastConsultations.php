<?php

# Credenciais de conexão  
$HOST="localhost"; // Host do banco de dados  
$USER="root"; // Nome de usuário do banco de dados  
$PASS=""; // Senha do banco de dados  
$DB_NAME="db_kidopi_covid19"; // Nome do banco de dados 

$conn = new mysqli($HOST, $USER, $PASS, $DB_NAME);

if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
};

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