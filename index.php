<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kidopi - Teste técnico</title>

    <!-- CSS -->
    <link rel="stylesheet" href="./styles/index.css" />
</head>

<body>
    <header class="header__container">
        <div>
            <div>
                <img src="./public/images/logo_kidopi.png" alt="Logo da Kidopi" />
            </div>
            <div>
                <button>Contato</button>
            </div>
        </div>
    </header>
    <main class="main__container">
        <div class="div__search">
            <h2>Dados da Covid-19</h2>
            <div>
                <select id="countrySelect">
                    <option value="Brazil">Brazil</option>
                    <option value="Canada">Canada</option>
                    <option value="Australia">Australia</option>
                </select>
                <button type="button" id="get-data">Buscar</button>
            </div>
        </div>
        <div class="div__results">
            <h2>Pais selecionado: <span id="countryInfoName"></span></h2>
            <div>
                <p>Total de casos: <span id="countryInfoCases"></span></p>
                <p>Mortes: <span id="countryInfoDeaths"></span></p>
            </div>
        </div>

        <h2>Dados sobre os Estados:</h2>
        <ul class="ul__container" id="statesList">
            <p id="text_center">Selecione um país para buscar informações</p>
            <!--             <li>
                <h2>Bahia</h2>
                <div>
                    <p>Casos: <span>1000</span></p>
                    <p>Mortes: <span>1</span></p>
                </div>
            </li> -->
        </ul>
    </main>
    <footer class="footer__container">
        <div>
            <div>
                <img src="./public/images/logo_kidopi.png" alt="Logo da Kidopi" />
            </div>
            <div class="footer__container--div-datails">
                <p>Última consulta: <span id="lastConsultationCountry"></span></p>
                <p>Data: <span id="lastConsultationDate"></span></p>
            </div>
        </div>
    </footer>

    <script src="./scripts/index.js"></script>
</body>

</html>