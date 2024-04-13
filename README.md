# Kidopi-teste_tecnico

O exercício consistirá na construção de um sistema (interface web) que possibilite ao usuário obter informações sobre os casos de mortes por Covid. Estes dados serão obtidos por meio da API-Covid-19 que está disponível no servidor da Kidopi. É possível obter dados do número de casos confirmados e mortes de vários países afetados pela COVID-19. Também é possivel escolher dois países diferentes, entre os listados pela API-Países-Disponíveis, e calcular a diferença da taxa de morte entre esses países selecionados.

<h2> Como rodar o projeto </h2>

Antes de tudo, clone o repositório em sua máquina no diretório `C:\xampp\htdocs\`.

Crie um banco de dados mySQL com o nome que preferir, ex: `db_kidopi_covid19` e execute o script abaixo no banco de dados criado para criação da tabela de registro de últimas consultas.

O script também pode ser encontrado no projeto em `\sql\script.sql`
```
CREATE TABLE `ultimas_consultas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(100) NOT NULL,
  `access_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
)
```

Altere as informações de conexão com o banco de dados mySQL com as suas informações nos arquivos `consultCountryData.php` e `lastConsultations.php` de acordo com o exemplo a seguir:
```
# Credenciais de conexão  
$HOST="localhost"; // Host do banco de dados  
$USER="root"; // Nome de usuário do banco de dados  
$PASS=""; // Senha do banco de dados  
$DB_NAME="db_kidopi_covid19"; // Nome do banco de dados 
```

<h3>Parabéns, o seu projeto está pronto para ser executado! :)<h3>

<p>O projeto está rodando no seguinte localhost: http://localhost/Kidopi-teste_tecnico/index.php</p>
