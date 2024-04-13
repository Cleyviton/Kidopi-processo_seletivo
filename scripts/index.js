const formatNumber = (n) => {
    return new Intl.NumberFormat("pt-BR").format(n);
};

const formatDate = (date) => {
    const newDate = new Date(date);

    const BrFormat = new Intl.DateTimeFormat("pt-BR");
    const Formated = BrFormat.format(newDate);

    return Formated;
};

const listCountries = () => {
    const countrySelect1 = document.querySelector("#countrySelect-1");
    const countrySelect2 = document.querySelector("#countrySelect-2");
    const xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const json = JSON.parse(this.responseText);
            const countriesList = Object.values(json);

            countriesList.forEach((country) => {
                countrySelect1.innerHTML += `<option value="${country}">${country}</option>`;
                countrySelect2.innerHTML += `<option value="${country}">${country}</option>`;
            });
        }
    };

    xmlhttp.open("GET", "listCountries.php", true);
    xmlhttp.send();
};

listCountries();

const totalCasesByCountry = (covidDataByCountry) => {
    let totalConfirmed = 0;
    let totalDeaths = 0;

    covidDataByCountry.forEach((state) => {
        totalConfirmed += state.Confirmados;
        totalDeaths += state.Mortos;
    });

    return { totalConfirmed, totalDeaths };
};

const loadFooter = () => {
    const lastConsultationCountry = document.querySelector(
        "#lastConsultationCountry"
    );
    const lastConsultationDate = document.querySelector(
        "#lastConsultationDate"
    );

    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const json = JSON.parse(this.responseText);

            if (typeof json != "string") {
                lastConsultationCountry.innerHTML = json.country;
                lastConsultationDate.innerHTML = formatDate(json.access_time);
            }
        }
    };

    xmlhttp.open("GET", "lastConsultations.php", true);

    xmlhttp.send();
};

loadFooter();

const getData = () => {
    const country = document.querySelector("#countrySelect").value;
    const countryInfoName = document.querySelector("#countryInfoName");
    const countryInfoCases = document.querySelector("#countryInfoCases");
    const countryInfoDeaths = document.querySelector("#countryInfoDeaths");
    const statesList = document.querySelector("#statesList");
    const lastConsultationCountry = document.querySelector(
        "#lastConsultationCountry"
    );
    const lastConsultationDate = document.querySelector(
        "#lastConsultationDate"
    );

    statesList.innerHTML = "";
    countryInfoName.innerHTML = "Carregando...";
    countryInfoCases.innerHTML = "Carregando...";
    countryInfoDeaths.innerHTML = "Carregando...";
    statesList.innerHTML = "<p>Carregando...</p>";

    const xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const json = JSON.parse(this.responseText);
            const covidDataByCountry = Object.values(json);

            const { totalConfirmed, totalDeaths } =
                totalCasesByCountry(covidDataByCountry);

            countryInfoName.innerHTML = country;
            countryInfoCases.innerHTML = formatNumber(totalConfirmed);
            countryInfoDeaths.innerHTML = formatNumber(totalDeaths);
            lastConsultationCountry.innerHTML = country;
            lastConsultationDate.innerHTML = formatDate(new Date());

            statesList.innerHTML = "";
            covidDataByCountry.forEach((state) => {
                statesList.innerHTML += `<li>
                        <h2>${state.ProvinciaEstado}</h2>
                        <div>
                             <p>Casos: <span>${formatNumber(
                                 state.Confirmados
                             )}</span></p>
                             <p>Mortes: <span>${formatNumber(
                                 state.Mortos
                             )}</span></p>
                        </div>
                    </li>`;
            });
        }
    };

    xmlhttp.open("GET", "consultCountryData.php?country=" + country, true);
    xmlhttp.send();
};

const rateCalculate = (country) => {
    return new Promise((resolve, reject) => {
        const xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const json = JSON.parse(this.responseText);
                const covidDataByCountry = Object.values(json);

                const { totalConfirmed, totalDeaths } =
                    totalCasesByCountry(covidDataByCountry);

                const rateCountry = (totalDeaths / totalConfirmed) * 100;
                resolve(rateCountry);
            }
        };

        xmlhttp.open("GET", "consultCountryData.php?country=" + country, true);
        xmlhttp.send();
    });
};

const handleRate = () => {
    const countrySelected1 = document.querySelector("#countrySelect-1").value;
    const countrySelected2 = document.querySelector("#countrySelect-2").value;
    const result = document.querySelector("#result");

    result.innerHTML = "Carregando...";

    Promise.all([
        rateCalculate(countrySelected1),
        rateCalculate(countrySelected2),
    ]).then(([rate1, rate2]) => {
        result.innerHTML = `${Math.abs((rate1 - rate2).toFixed(2))}%`;
    });
};

const btnSerach = document.querySelector("#get-data");

btnSerach.addEventListener("click", (event) => {
    event.preventDefault();

    getData();
});

const btnCalcRate = document.querySelector("#btnCalcRate");

btnCalcRate.addEventListener("click", (event) => {
    event.preventDefault();

    handleRate();
});
