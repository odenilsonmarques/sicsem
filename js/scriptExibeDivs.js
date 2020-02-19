
function mostrardivinformacoes(valor_informacoes) {
    if (valor_informacoes === "SIM") {
        document.getElementById("NUMNOTANTERIOR").style.display = "block";
        document.getElementById("NUMANOANTERIOR").style.display = "block";
        document.getElementById("NUMPROANTERIOR").style.display = "block";
        document.getElementById("NUMANOPROANTERIOR").style.display = "block";
        document.getElementById("LICENCAANTERIOR").style.display = "block";
    } else if (valor_informacoes === "NAO") {
        document.getElementById("NUMNOTANTERIOR").style.display = "none";
        document.getElementById("NUMANOANTERIOR").style.display = "none";
        document.getElementById("NUMPROANTERIOR").style.display = "none";
        document.getElementById("NUMANOPROANTERIOR").style.display = "none";
        document.getElementById("LICENCAANTERIOR").style.display = "none";
    }
}

function mostrarDivNotificados(valor_notificado) {

    if (valor_notificado === "SIM") {
        document.getElementById("NOMENOTIFICADO").style.display = "block";
        document.getElementById("CPFNOTIFICADO").style.display = "block";
        document.getElementById("LOGRADOURONOTIFICADO").style.display = "block";
        document.getElementById("NUMERONOTIFICADO").style.display = "block";
        document.getElementById("BAIRRONOTIFICADO").style.display = "block";
        document.getElementById("TESTEMUNHANOTIFICADO").style.display = "block";
    } else if (valor_notificado === "NAO") {
        document.getElementById("NOMENOTIFICADO").style.display = "none";
        document.getElementById("CPFNOTIFICADO").style.display = "none";
        document.getElementById("LOGRADOURONOTIFICADO").style.display = "none";
        document.getElementById("NUMERONOTIFICADO").style.display = "none";
        document.getElementById("BAIRRONOTIFICADO").style.display = "none";
        document.getElementById("TESTEMUNHANOTIFICADO").style.display = "none";
    }
}
 function mostrarDivLicencas(valor) {

        if (valor === "SIM") {
            document.getElementById("NUMLICENCA").style.display = "block";
            document.getElementById("NUMANOLICENCA").style.display = "block";
            document.getElementById("ORGAOEMISSOR").style.display = "block";
            document.getElementById("DATAVALIDADE").style.display = "block";
        } else if (valor === "NAO") {
            document.getElementById("NUMLICENCA").style.display = "none";
            document.getElementById("NUMANOLICENCA").style.display = "none";
            document.getElementById("ORGAOEMISSOR").style.display = "none";
            document.getElementById("DATAVALIDADE").style.display = "none";
        }
    }
