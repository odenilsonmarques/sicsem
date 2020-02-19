//OS DADOS ABAIXO TEM COMO OBJETIVO COMPARAR AS DATAS DE EMISSÃO E VALIDADE
function comparadatas()
{
    var data_notificacao = document.getElementById("data_notificacao");
    var data_comparecimento = document.getElementById("data_comparecimento");

    if (data_notificacao.value > data_comparecimento.value) {
        alert("ERRO! A DATA DE NOTIFICAÇÃO NÃO PODE SER MAIOR OU IGUAL A DATA DE COMPARECIMENTO");
        data_notificacao = document.getElementById('data_notificacao').value = '';
        data_comparecimento = document.getElementById('data_comparecimento').value = '';

    }
}

function comparaAnoData()
{
    var ano = document.getElementById("ano_notificacao").value;
    var data_notificacao = document.getElementById("data_notificacao").value;
    var data = data_notificacao.substr(0, 4); // pega só o ano
    if (ano !== data) {
        alert("ERRO! O ANO INFORMADO, NÃO ESTÁ COM O MESMO ANO DA DATA DA NOTIFICAÇÃO");
        var ano = document.getElementById("ano_notificacao").value = '';
        var data_notificacao = document.getElementById("data_notificacao").value = '';
    }
}